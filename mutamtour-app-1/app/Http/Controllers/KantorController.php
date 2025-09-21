<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Http\Requests\KantorRequest;
use Illuminate\Http\Request;

class KantorController extends Controller
{
    public function index()
    {
        $kantors = Kantor::all();
        return view('kantor.index', compact('kantors'));
    }

    public function create()
    {
        return view('kantor.create');
    }

    public function store(KantorRequest $request)
    {
        Kantor::create($request->validated());
        return redirect()->route('kantor.index')->with('success', 'Kantor created successfully.');
    }

    public function show(Kantor $kantor)
    {
        return view('kantor.show', compact('kantor'));
    }

    public function edit(Kantor $kantor)
    {
        return view('kantor.edit', compact('kantor'));
    }

    public function update(KantorRequest $request, Kantor $kantor)
    {
        $kantor->update($request->validated());
        return redirect()->route('kantor.index')->with('success', 'Kantor updated successfully.');
    }

    public function destroy(Kantor $kantor)
    {
        $kantor->delete();
        return redirect()->route('kantor.index')->with('success', 'Kantor deleted successfully.');
    }
}