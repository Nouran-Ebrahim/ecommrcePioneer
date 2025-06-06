<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PageRequest;
use App\Services\Dashboard\PageService;
class PageController extends Controller
{
    protected $PageService, $imageManger;
    public function __construct(PageService $PageService, ImageManger $imageManger)
    {
        $this->PageService = $PageService;
        $this->imageManger = $imageManger;
    }

    public function index()
    {
        return view('dashboard.Pages.index');
    }

    public function getAll()
    {
        return $this->PageService->getPagesForDatatables();
    }
    public function create()
    {
        return view('dashboard.Pages.create');
    }

    public function store(PageRequest $request)
    {
        // dd($request->all());
        $data = $request->only(['image', 'title', 'content']);
        $Page = $this->PageService->createPage($data);

        if (!$Page) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.added_successfully'));
        return redirect()->back();

    }

    public function edit(string $id)
    {
        $page = $this->PageService->getPage($id) ?? abort(404);
        return view('dashboard.Pages.edit', compact('page'));

    }
    public function update(PageRequest $request, string $id)
    {
        $data = $request->only(['image', 'title', 'content']);
        // dd($data);
        $Page = $this->PageService->updatePage($id, $data);
        if (!$Page) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.updateed_successfully'));
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        if (!$this->PageService->deletePage($id)) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.deleted_successfully'));
        return redirect()->back();
    }
    public function deleteImage(Request $request)
    {
        $page = $this->PageService->getPage($request->key);
        $this->imageManger->deleteimageFromLocal('uploads/pages/' . $page->image);
        $page->update(['image' => null]);
        return response()->json([
            'status' => 200,
            "msg" => "Image Deleted"
        ]);

    }



}
