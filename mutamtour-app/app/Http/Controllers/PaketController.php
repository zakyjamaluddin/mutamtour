<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Http\Requests\PaketRequest;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(PaketRequest $request)
    {
        Paket::create($request->validated());
        return redirect()->route('paket.index')->with('success', 'Paket created successfully.');
    }

    public function show(Paket $paket)
    {
        return view('paket.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        return view('paket.edit', compact('paket'));
    }

    public function update(PaketRequest $request, Paket $paket)
    {
        $paket->update($request->validated());
        return redirect()->route('paket.index')->with('success', 'Paket updated successfully.');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('paket.index')->with('success', 'Paket deleted successfully.');
    }
}