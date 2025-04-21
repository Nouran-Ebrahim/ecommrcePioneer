<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\PageRepository;
use Nette\Utils\Image;
use App\Utils\ImageManger;
use Illuminate\Support\Facades\Cache;
use Str;
use Yajra\DataTables\Facades\DataTables;

class PageService
{

    protected $pageRepository, $imageManger;

    public function __construct(PageRepository $pageRepository, ImageManger $imageManger)
    {
        $this->pageRepository = $pageRepository;
        $this->imageManger = $imageManger;
    }
    public function getPages() // new
    {
        return $this->pageRepository->getPages();
    }
    public function getPage($id)
    {
        $page = $this->pageRepository->getPage($id);
        if (!$page) {
            abort(404);
        }
        return $page;
    }
    public function getBySlug($slug)
    {
        $page = $this->pageRepository->getBySlug($slug);

        return $page;
    }
    public function getPagesForDatatables()
    {

        $pages = $this->getPages();
        return DataTables::of($pages)
            ->addIndexColumn()

            ->addColumn('title', function ($page) {
                return $page->getTranslation('title', app()->getLocale());
            })
            ->addColumn('content', function ($page) {
                return view('dashboard.pages.datatables.content', compact('page'));
            })
            ->addColumn('image', function ($page) {
                return $page->image != null ? view('dashboard.pages.datatables.image', compact('page')) : __('dashboard.no');
            })
            ->addColumn('action', function ($page) {
                return view('dashboard.pages.datatables.actions', compact('page'));
            })
            ->rawColumns(['action', 'image']) // for render html content
            ->make(true);
    }

    public function createPage($data)
    {
        if (array_key_exists('image', $data) && $data['image'] != null) {
            $file_name = $this->imageManger->uploadSingleimage('/', $data['image'], 'pages');
            $data['image'] = $file_name;
        }
        $data['slug'] = Str::slug($data['title']['en']);
        return $this->pageRepository->createPage($data);
    }


    public function updatePage($id, $data)
    {
        $page = $this->getPage($id);
        // dd($data);
        if (array_key_exists('image', $data) && $data['image'] != null) {
            // delete old image
            $this->imageManger->deleteimageFromLocal('uploads/pages/' . $page->image);

            $file_name = $this->imageManger->uploadSingleimage('/', $data['image'], 'pages');
            $data['image'] = $file_name;
        }
        $data['slug'] = Str::slug($data['title']['en']);

        return $this->pageRepository->updatePage($page, $data);
    }
    public function deletePage($id)
    {
        if (!$page = $this->getPage($id)) {
            abort(404);
        }
        // ckeck if has image?
        if ($page->image != null) {
            $this->imageManger->deleteimageFromLocal('uploads/pages/' . $page->image);
        }

        return $this->pageRepository->deletePage($page);
    }


}
