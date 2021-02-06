<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class OrganizationsController extends Controller
{
    public function index()
    {
        return Inertia::render('Organizations/Index', [
            'filters' => Request::all('search', 'trashed'),
            'organizations' => Auth::user()->account->organizations()
                ->orderBy('name')
                ->filter(Request::only('search', 'trashed'))
                ->paginate()
                ->transform(function ($organization) {
                    return [
                        'id' => $organization->id,
                        'name' => $organization->name,
                        'email' => $organization->email,
                        'phone' => $organization->phone,
                        'address' => $organization->address,
                        'city' => $organization->city,
                        'region' => $organization->region,
                        'country' => $organization->country,
                        'postal_code' => $organization->postal_code,
                        'image' => $organization->imageUrl(['w' => 100, 'h' => 100, 'fit' => 'crop']),
                        'marketing_image' => $organization->marketingImageUrl(['w' => 100, 'h' => 100, 'fit' => 'crop']),
                        'enable_marketing' => $organization->enable_marketing,
                        'deleted_at' => $organization->deleted_at,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Organizations/Create');
    }

    public function store()
    {
        Request::validate([
            'name' => ['required', 'max:100'],
                'name' => ['nullable', 'max:50'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
                'image' => ['nullable', 'image'],
                'marketing_image' => ['nullable', 'image'],
        ]);

        Auth::user()->account->organizations()->create([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'phone' => Request::get('phone'),
            'address' => Request::get('address'),
            'city' => Request::get('city'),
            'region' => Request::get('region'),
            'country' => Request::get('country'),
            'postal_code' => Request::get('postal_code'),
            'image' => Request::file('image') ? Request::file('image')->store('organizations') : null,
            'marketing_image' => Request::file('marketing_image') ? Request::file('marketing_image')->store('organizations') : null,
            'enable_marketing' => Request::get('enable_marketing') ? true : false,
        ]);

        return Redirect::route('organizations')->with('success', 'Organization created.');
    }

    public function edit(Organization $organization)
    {
        // dd($organization);
        return Inertia::render('Organizations/Edit', [
            'organization' => [
                'id' => $organization->id,
                'name' => $organization->name,
                'email' => $organization->email,
                'phone' => $organization->phone,
                'address' => $organization->address,
                'city' => $organization->city,
                'region' => $organization->region,
                'country' => $organization->country,
                'postal_code' => $organization->postal_code,
                'image' => $organization->imageUrl(['w' => 100, 'h' => 100, 'fit' => 'crop']),
                'marketing_image' => $organization->marketingImageUrl(['w' => 100, 'h' => 100, 'fit' => 'crop']),
                'enable_marketing' => $organization->enable_marketing,
                'deleted_at' => $organization->deleted_at,
                'contacts' => $organization->contacts()->orderByName()->get()->map->only('id', 'name', 'city', 'phone'),
            ],
        ]);
    }

    public function update(Organization $organization)
    {
        Request::validate([
            'name' => ['required', 'max:100'],
            'email' => ['nullable', 'max:50', 'email'],
            'phone' => ['nullable', 'max:50'],
            'address' => ['nullable', 'max:150'],
            'city' => ['nullable', 'max:50'],
            'region' => ['nullable', 'max:50'],
            'country' => ['nullable', 'max:2'],
            'postal_code' => ['nullable', 'max:25'],
            'image' => ['nullable', 'image'],
            'marketing_image' => ['nullable', 'image'],
            'enable_marketing' => ['required', 'boolean'],
        ]);

        $organization->update(Request::only('name', 'email', 'phone', 'address' , 'city', 'region', 'country', 'postal_code', 'enable_marketing'));

        if (Request::file('image')) {
            $organization->update(['image' => Request::file('image')->store('organizations')]);
        }

        if (Request::file('marketing_image')) {
            $organization->update(['marketing_image' => Request::file('marketing_image')->store('organizations')]);
        }

        return Redirect::back()->with('success', 'Organization updated.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return Redirect::back()->with('success', 'Organization deleted.');
    }

    public function restore(Organization $organization)
    {
        $organization->restore();

        return Redirect::back()->with('success', 'Organization restored.');
    }
}
