<?php
namespace App\Http\Controllers;

use App\Manual;
use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    public function create(Manual $manual)
    {
        return view('manuals.pages.create', ['manual' => $manual]);
    }

    public function store(Request $request, Manual $manual)
    {
        $page = $manual->pages()->create(
            [
                'title' => $request->title,
                'content' => $request->content
            ]
            );
        session()->flash('notice',"「{$page->title}」を追加しました");
        return redirect()->route('manuals.show', $manual);
    }

    public function show(Manual $manual, Page $page)
    {
        return view('manuals.pages.show',['page' => $page]);
    }

    public function edit(Manual $manual, Page $page)
    {
        return view('manuals.pages.edit', ['manual' => $manual, 'page' => $page]);
    }

    public function update(Request $request, Manual $manual, Page $page)
    {
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();
        session()->flash('notice',"「{$page->title}」を更新しました");
        return redirect()->route('manuals.show', $manual);
    }

    public function destroy(Manual $manual)
    {
        $manual->delete();
        session()->flash('alert',"「{$manual->name}」を削除しました");
        return redirect("pages");
    }

}