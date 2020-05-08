<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = Title::take(100)->get();

        return [
            'success' => true,
            'data' => $titles,
            'data_count' => $titles->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title_info = $request->only([
            'title.emp_no',
            'title.title',
            'title.from_date',
            'title.to_date'
        ])['title'];

        $title = Title::create($title_info);

        return [
            'success' => true,
            'title' => $title
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        return [
            'success' => true,
            'title' => $title
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Title $title)
    {
        $title_info = $request->only([
            'title.emp_no',
            'title.title',
            'title.from_date',
            'title.to_date'
        ])['title'];

        $success = $title->update($title_info);

        return [
            'success' => $success,
            'title' => $title
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        //
    }
}
