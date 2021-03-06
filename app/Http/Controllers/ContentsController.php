<?php

namespace Impress\Http\Controllers;

use Impress\Content;
use Impress\Type;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $drafts    = Content::with('author', 'type')->drafts()->orderBy('updated_at', 'desc')->get();
        $published = Content::with('author', 'type')->published()->orderBy('published_at', 'desc')->get();

        return view('contents.index', compact('drafts', 'published'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('contents.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required|unique:contents,title',
            'slug'        => 'required|alpha_dash|unique:contents,slug',
            'type_id'     => 'required|exists:types,id',
            'category_id' => 'exists:categories,id',
        ]);

        $content = new Content($request->all());

        auth()->user()->contents()->save($content);

        if ($request->has('tags'))
            $content->tags()->sync($request->get('tags'));

        return redirect()->route('i.contents.edit', ['contents' => $content->slug]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Content $content
     * @return Response
     */
    public function edit(Content $content)
    {
        return view('contents.edit', compact('content'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Content $content
     * @return Response
     */
    public function update(Request $request, Content $content)
    {
        $this->validate($request, [
            'id'          => 'required|exists:contents,id',
            'title'       => 'required|unique:contents,title,' . $request->get('id'),
            'slug'        => 'required|alpha_dash|unique:contents,slug,' . $request->get('id'),
            'type_id'     => 'required|exists:types,id',
            'category_id' => 'exists:categories,id',
        ]);

        $content->fill($request->all())->save();

        // The last editor relationship is saved via a model event in AppServiceProvider.

        if ($request->has('tags'))
            $content->tags()->sync($request->get('tags'));

        return redirect()->route('i.contents.edit', [$content->slug]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
