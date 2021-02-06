<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $menu = Menu::where('status', 1)->first();
        dd($menu);exit;
        
        return Inertia::render('Home/Index', [
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION .'a1',
        ]);   
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $menu = Menu::where('slug', $slug)->first();
        return Inertia::render('Home/Index', [
            'menu' => [
                'id' => $menu->id,
                'title' => $menu->title,
                'slug' => $menu->slug,
                'description' => $menu->description,
                'status' => $menu->status,
                'enable_marketing' => $menu->enable_marketing,
                'image' => $menu->imageUrl([]),
                'marketing_image' => $menu->marketingImageUrl([]),
                'deleted_at' => $menu->deleted_at,
            ]
        ]);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
