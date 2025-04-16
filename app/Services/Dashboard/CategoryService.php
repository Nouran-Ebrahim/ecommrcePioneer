<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CategoryRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;
use App\Utils\ImageManger;

class CategoryService
{
    protected $categoryRepository, $imageManger;
    public function __construct(CategoryRepository $categoryRepository, ImageManger $imageManger)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageManger = $imageManger;

    }
    public function getCategories()
    {
        return $this->categoryRepository->getAll();
    }
    public function getAllCategories()
    {
        $categories = $this->categoryRepository->getAllCategories();
        //make true to return data as object but false return as array
        //addColumn adding new cloumn but if the column name is same in the in database it will overide it with new modification
        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('name', function ($category) {
                return $category->getTranslation('name', app()->getLocale());
            })
            ->addColumn('products_count', function ($category) {
                return $category->products()->count() == 0 ? __('dashboard.not_found') : $category->products()->count();
            })
            ->addColumn('icon', function ($category) {
                return view('dashboard.categories.icon', compact('category'));
            })
            ->addColumn('action', function ($category) {
                return view('dashboard.categories.actions', compact('category'));
            })
            ->make(true);

    }
    public function getCategoryById($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
        return $category;
    }
    public function store($data)
    {
        if (array_key_exists('icon', $data) && $data['icon'] != null) {
            $file_name = $this->imageManger->uploadSingleImage('/', $data['icon'], 'categories');
            $data['icon'] = $file_name;
        }
        $this->categoryCache();
        return $this->categoryRepository->store($data);
    }
    public function update($data)
    {

        $category = $this->categoryRepository->getCategoryById($data['id']);
        if (!$category) {
            return false;
        }
        if (array_key_exists('icon', $data) && $data['icon'] != null) {
            // delete old icon
            $this->imageManger->deleteImageFromLocal($category->icon);

            $file_name = $this->imageManger->uploadSingleImage('/', $data['icon'], 'categories');
            $data['icon'] = $file_name;
        }
        // dd($data);
        return $this->categoryRepository->update($category, $data);
    }
    public function delete($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
        if ($category->icon != null) {
            $this->imageManger->deleteImageFromLocal($category->icon);
        }

        $category = $this->categoryRepository->delete($category);
        $this->categoryCache();
        return $category;

    }
    public function getCategoriesExceptChildren($id)
    {
        return $this->categoryRepository->getCategoriesExceptChildren($id);
    }
    public function getCategoriesParent()
    {

        return $this->categoryRepository->getCategoriesParent();
    }
    public function changeStatus($category_id)
    {
        $category = self::getCategoryById($category_id);
        $category = $this->categoryRepository->changeStatus($category);

        if (!$category) {
            return false;
        }
        return true;
    }
    public function categoryCache()
    {
        Cache::forget('categories_count');
    }
}
