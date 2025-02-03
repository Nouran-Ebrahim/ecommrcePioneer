<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CategoryRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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
        $this->categoryCache();
        return $this->categoryRepository->store($data);
    }
    public function update($data)
    {
        // dd($data);
        $category = $this->categoryRepository->getCategoryById($data['id']);
        if (!$category) {
            return false;
        }
        return $this->categoryRepository->update($category, $data);
    }
    public function delete($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
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
