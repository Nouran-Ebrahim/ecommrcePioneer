<?php

namespace App\Repositories\Dashboard;

use App\Models\Page;

class PageRepository
{

    public function getPages()
    {
       $Pages = Page::latest()->get();
       return $Pages;
    }
    public function getPage($id)
    {
        $Page = Page::find($id);
        return $Page;
    }
    public function createPage($data)
    {
        $Page = Page::create($data);
        return $Page;
    }
    public function updatePage($Page, $data)
    {
       return $Page->update($data);
    }
    public function deletePage($Page)
    {
       return $Page->delete();
    }


}
