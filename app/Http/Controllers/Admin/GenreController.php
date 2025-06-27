<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genres.index', compact('genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ], [
            'name.required' => 'Nama genre wajib diisi.',
            'name.unique' => 'Genre dengan nama ini sudah ada.',
            'name.max' => 'Nama genre maksimal 255 karakter.',
        ]);

        try {
            Genre::create($validated);
            return redirect()->back()->with('success', 'Genre berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan genre. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
        ], [
            'name.required' => 'Nama genre wajib diisi.',
            'name.unique' => 'Genre dengan nama ini sudah ada.',
            'name.max' => 'Nama genre maksimal 255 karakter.',
        ]);

        try {
            $genre->update($validated);
            return redirect()->back()->with('success', 'Genre berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui genre. Silakan coba lagi.');
        }
    }


    public function destroy($id)
    {
        try {
            $genre = Genre::findOrFail($id);
            $genre->delete();
            return redirect()->back()->with('success', 'Genre berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus genre. Silakan coba lagi.');
        }
    }

}