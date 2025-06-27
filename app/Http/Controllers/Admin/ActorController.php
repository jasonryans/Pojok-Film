<?php

namespace App\Http\Controllers\Admin;

use App\Models\Actor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::all();
        return view('admin.actors.index', compact('actors'));
    }

    public function create()
    {
        return view('admin.actors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'born_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->only(['name', 'born_date', 'gender', 'description']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('actors', 'public');
        }

        $data['gender'] = match($data['gender']) {
            "Laki-laki" => true,
            "Perempuan" => false
        };

        Actor::create($data);

        return redirect()->route('admin.actors.index')->with('success', 'Aktor berhasil ditambahkan.');
    }

    public function edit(Actor $actor)
    {
        return view('admin.actors.edit', compact('actor'));
    }

    public function update(Request $request, Actor $actor)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'born_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->only(['name', 'born_date', 'gender', 'description']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('actors', 'public');
        }

        $data['gender'] = match($data['gender']) {
            "Laki-laki" => true,
            "Perempuan" => false
        };

        $actor->update($data);

        return redirect()->route('admin.actors.index')->with('success', 'Aktor berhasil diupdate.');
    }

    public function destroy(Actor $actor)
    {
        $actor->delete();
        return redirect()->route('admin.actors.index')->with('success', 'Aktor berhasil dihapus.');
    }

    public function show(Actor $actor)
    {
        return view('admin.actors.show', compact('actor'));
    }

}
