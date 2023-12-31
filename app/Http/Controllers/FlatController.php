<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlatRequest;
use App\Models\Flat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FlatController extends Controller
{
    public function index(): View
    {
        return view('pages.flats.index', [
            'flats' => Flat::latest()->filter(request(['search']))->simplePaginate(6)
        ]);
    }

    public function userFlats(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        $flats = $user->flats()->filter(request(['search']))->withQueryString()->simplePaginate(6);

        return view('pages.flats.userFlats', [
            'flats' => $flats,
        ]);
    }

    public function view(Flat $flat): View
    {
        $comments = $flat->comments;
        $images = ['https://plus.unsplash.com/premium_photo-1680100256112-2e1231d9d0df?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'];

        return view('pages.flats.detail', compact('flat', 'comments', 'images'));
    }

    public function delete(Flat $flat): RedirectResponse
    {
        $flat->delete();

        return redirect('/')->with('success', 'The item was successfully deleted.');
    }

    public function create(): View
    {
        return view('pages.flats.create');
    }

    public function store(StoreFlatRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['user_id'] = $request->user()->id;

        $flat = Flat::create($attributes);

        if ($flat) {
            return redirect('/')->with('success', 'New flat created');
        } else {
            return redirect('/')->with('error', 'Failed to create a new flat');
        }
    }

    public function edit(Flat $flat): View
    {
       // $this->authorize('update-flat', $flat);

        return view('pages.flats.edit', [
            'flat' => $flat,
        ]);
    }

    public function update(Flat $flat, StoreFlatRequest $request): RedirectResponse
    {
       // $this->authorize('update-flat', $flat);

        $flat->update($request->validated());

        return redirect('/')->with('success', 'Flat updated successfully!');
    }

}
