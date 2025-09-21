<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use App\Http\Requests\JamaahRequest;
use Illuminate\Http\Request;

class JamaahController extends Controller
{
    public function index()
    {
        $jamaahs = Jamaah::all();
        return view('jamaah.index', compact('jamaahs'));
    }

    public function create()
    {
        return view('jamaah.create');
    }

    public function store(JamaahRequest $request)
    {
        Jamaah::create($request->validated());
        return redirect()->route('jamaah.index')->with('success', 'Jamaah created successfully.');
    }

    public function show(Jamaah $jamaah)
    {
        return view('jamaah.show', compact('jamaah'));
    }

    public function edit(Jamaah $jamaah)
    {
        return view('jamaah.edit', compact('jamaah'));
    }

    public function update(JamaahRequest $request, Jamaah $jamaah)
    {
        $jamaah->update($request->validated());
        return redirect()->route('jamaah.index')->with('success', 'Jamaah updated successfully.');
    }

    public function destroy(Jamaah $jamaah)
    {
        $jamaah->delete();
        return redirect()->route('jamaah.index')->with('success', 'Jamaah deleted successfully.');
    }
}