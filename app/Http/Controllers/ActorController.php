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
            'name' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->only(['name', 'tanggal_lahir', 'jenis_kelamin', 'deskripsi']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('actors', 'public');
        }

        Actor::create($data);

        return redirect()->route('actors.index')->with('success', 'Aktor berhasil ditambahkan.');
    }

    public function edit(Actor $actor)
    {
        return view('actors.edit', compact('actor'));
    }

    public function update(Request $request, Actor $actor)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->only(['name', 'tanggal_lahir', 'jenis_kelamin', 'deskripsi']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('actors', 'public');
        }

        $actor->update($data);

        return redirect()->route('actors.index')->with('success', 'Aktor berhasil diupdate.');
    }

    public function destroy(Actor $actor)
    {
        $actor->delete();
        return redirect()->route('actors.index')->with('success', 'Aktor berhasil dihapus.');
    }

    public function show(Actor $actor)
    {
        return view('actors.show', compact('actor'));
    }

}
