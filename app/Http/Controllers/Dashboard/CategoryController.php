<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Dashboard\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

    }
    public function index()
    {
        return view('dashboard.categories.index');
    }

    public function getAll()
    {
        return $this->categoryService->getAllCategories();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getCategoriesParent();
        return view('dashboard.categories.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->only(['name', 'parent', 'status']);
        if (!$this->categoryService->store($data)) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.created_successfully'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $categories = $this->categoryService->getCategoriesExceptChildren($id);
        return view('dashboard.categories.edit', compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->only(['name', 'parent', 'status', 'id']);
        if (!$this->categoryService->update($data)) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.updated_successfully'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryService->delete($id);
        if (!$category) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.deleted_successfully'));
        return redirect()->back();
    }
    public function changeStatus($category_id)
    {
        $country = $this->categoryService->changeStatus($category_id);
        if (!$country) {
            return response()->json([
                'status' => false,
                'message' => __('messages.general_error')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('messages.updateed_successfully')

        ], 200);
    }
}
