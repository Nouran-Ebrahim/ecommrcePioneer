<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;

class CategoryRepository
{
    public function getAllCategories()
    {
        $categories = Category::all();
        return $categories;

    }
    public function getCategoryById($id)
    {
        $category = Category::find($id);
        return $category;
    }
}
