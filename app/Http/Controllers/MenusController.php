<?php

namespace App\Http\Controllers;

use App\Services\MenuSlug;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class MenusController extends Controller
{
    public function index()
    {
        return Inertia::render('Menus/Index', [
            'filters' => Request::all('search', 'trashed'),
            'menus' => Auth::user()->account->menus()
                ->orderBy('title')
                ->filter(Request::only('search', 'trashed'))
                ->paginate()
                ->transform(function ($menu) {
                    return [
                        'id' => $menu->id,
                        'title' => $menu->title,
                        'slug' => $menu->slug,
                        'description' => $menu->description,
                        'status' => $menu->status,
                        'image' => $menu->imageUrl(['w' => 100, 'h' => 100, 'fit' => 'crop']),
                        'image_file_size' => $menu->imageFileSize(),
                        'marketing_image' => $menu->marketingImageUrl(['w' => 100, 'h' => 100, 'fit' => 'crop']),
                        'marketing_image_file_size' => $menu->marketingImageFileSize(),
                        'deleted_at' => $menu->deleted_at,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Menus/Create');
    }

    public function store()
    {
        Request::validate([
            'title' => ['required', 'max:100'],
            'description' => ['required'],
            'image' => ['nullable', 'image'],
            'marketing_image' => ['nullable', 'image'],
        ]);

        $menuSlug = new MenuSlug;
        $slug = $menuSlug->createSlug(Request::get('title'));

        Auth::user()->account->menus()->create([
            'title' => Request::get('title'),
            'slug' => $slug,
            'description' => Request::get('description'),
            'status' => Request::get('status') ? true : false,
            'image' => Request::file('image') ? Request::file('image')->store('menus') : null,
            'marketing_image' => Request::file('marketing_image') ? Request::file('marketing_image')->store('menus') : null,
            'enable_marketing' => Request::get('enable_marketing') ? true : false,
        ]);

        return Redirect::route('menus')->with('success', 'Menu created.');
    }

    public function edit(Menu $menu)
    {
        return Inertia::render('Menus/Edit', [
            'menu' => [
                'id' => $menu->id,
                'title' => $menu->title,
                'description' => $menu->description,
                'status' => $menu->status,
                'image' => $menu->imageUrl(['w' => 100, 'h' => 100, 'fit' => 'crop']),
                'marketing_image' => $menu->marketingImageUrl(['w' => 100, 'h' => 100, 'fit' => 'crop']),
                'enable_marketing' => $menu->enable_marketing,
                'deleted_at' => $menu->deleted_at,
            ],
        ]);
    }

    public function update(Menu $menu)
    {
        Request::validate([
            'title' => ['required', 'max:100'],
            'description' => ['required'],
            'status' => ['required', 'boolean'],
            'image' => ['nullable', 'image'],
            'marketing_image' => ['nullable', 'image'],
            'enable_marketing' => ['required', 'boolean'],
        ]);

        $menu->update(Request::only('title', 'description', 'status', 'enable_marketing'));

        if (Request::file('image')) {
            $menu->update(['image' => Request::file('image')->store('menus')]);
        }

        if (Request::file('marketing_image')) {
            $menu->update(['marketing_image' => Request::file('marketing_image')->store('menus')]);
        }

        return Redirect::back()->with('success', 'Menu updated.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return Redirect::back()->with('success', 'Menu deleted.');
    }

    public function restore(Menu $menu)
    {
        $menu->restore();

        return Redirect::back()->with('success', 'Menu restored.');
    }
}