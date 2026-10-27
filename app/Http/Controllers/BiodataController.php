<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function index()
    {
        $biodata = Biodata::all();
        return view('biodata.index', compact('biodata'));
    }

    public function create()
    {
        return view('biodata.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:30',
            'alamat' => 'nullable|string',
            'pendidikan' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('foto-cv', 'public');
        }

        Biodata::create($data);

        return redirect()->route('biodata.index')
            ->with('success', 'CV berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $data = Biodata::findOrFail($id);
        return view('biodata.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Biodata::findOrFail($id);

        $input = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:30',
            'alamat' => 'nullable|string',
            'pendidikan' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hapus_foto' => 'nullable|boolean',
        ]);

        unset($input['hapus_foto']);

        if ($request->boolean('hapus_foto')) {
            if ($data->foto) {
                Storage::disk('public')->delete($data->foto);
            }

            $input['foto'] = null;
        }

        if ($request->hasFile('foto')) {
            if ($data->foto) {
                Storage::disk('public')->delete($data->foto);
            }

            $input['foto'] = $request->file('foto')
                ->store('foto-cv', 'public');
        }

        $data->update($input);

        return redirect()->route('biodata.index')
            ->with('success', 'CV berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $data = Biodata::findOrFail($id);

        if ($data->foto) {
            Storage::disk('public')->delete($data->foto);
        }

        $data->delete();

        return redirect()->route('biodata.index')
            ->with('success', 'CV dan foto berhasil dihapus!');
    }
}
