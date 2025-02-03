<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;

class CategoryRepository
{
    public function getAllCategories()
    {
        $categories = Category::withCount('products')->latest()->get();        return $categories;

    }
    public function getAll()
    {
        $categories = Category::latest()->get();
        return $categories;
    }
    public function getCategoryById($id)
    {
        $category = Category::find($id);
        return $category;
    }
    public function store($data)
    {
        $category = Category::create($data);
        return $category;
    }
    public function update($category, $data)
    {
        $category = $category->update($data);

        return $category;
    }
    public function delete($category)
    {
        return $category->delete();

    }
    public function getCategoriesExceptChildren($id)
    {
        $categories = Category::where('id', '!=', $id)
            ->whereNull('parent')
            ->get();
        return $categories;
    }
    public function getCategoriesParent()
    {
        $categories = Category::
            whereNull('parent')
            ->get();
        return $categories;
    }
    public function changeStatus($model)
    {
        $model = $model->update([
            'status' => $model->status == 1 ? 0 : 1,
        ]);

        return $model; //return true or false in update

    }

}
