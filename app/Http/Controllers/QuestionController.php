<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|min:5',
        'email' => ['required', 'email'],
        'pertanyaan' => 'required|min:10|max:300',
    ]);

    $data['nama'] = $request->nama;
    $data['email'] = $request->email;
    $data['pertanyaan'] = $request->pertanyaan;

    return view('home-question-respon', $data);
}

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
