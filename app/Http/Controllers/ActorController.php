<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::all();
        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        return view('actors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'biografi' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $actor = new Actor($request->except('foto'));

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_aktor', 'public');
            $actor->foto = $fotoPath;
        }

        $actor->save();

        return redirect()->route('actors.index')->with('success', 'Aktor berhasil ditambahkan.');
    }

    public function edit(Actor $actor)
    {
        return view('actors.edit', compact('actor'));
    }

    public function update(Request $request, Actor $actor)
    {
        $request->validate([
            'nama' => 'required',
            'biografi' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $actor->fill($request->except('foto'));

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_aktor', 'public');
            $actor->foto = $fotoPath;
        }

        $actor->save();

        return redirect()->route('actors.index')->with('success', 'Aktor berhasil diperbarui.');
    }

    public function destroy(Actor $actor)
    {
        $actor->delete();
        return redirect()->route('actors.index')->with('success', 'Aktor berhasil dihapus.');
    }
}
