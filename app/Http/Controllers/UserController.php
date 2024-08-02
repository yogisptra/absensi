<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.contents.guru.index', [
            'title' => 'Data Guru',
            'gurus' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.contents.guru.create', [
            'title' => 'Tambah Data Guru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:users|digits:16',
            'phone' => 'max:255|unique:users',
            'email' => 'max:255|unique:users',
            'password' => 'required|max:255',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'jns_kelamin' => '',
            'alamat' => '',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData, [
            'remember_token' => Str::random(16),
        ]);

        return redirect('/guru')->with('success', 'Guru baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('home.contents.guru.show', [
            'title' => 'Edit Data Guru',
            'gurus' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('home.contents.guru.edit', [
            'title' => 'Edit Data Guru',
            'gurus' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik' => [
                'required',
                'digits:16',
                // Abaikan validasi unique untuk ID pengguna yang sedang diperbarui
                'unique:users,nik,' . $id,
            ],
            'phone' => [
                'nullable',
                'max:255',
                'unique:users,phone,' . $id,
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                // Abaikan validasi unique untuk ID pengguna yang sedang diperbarui
                'unique:users,email,' . $id,
            ],
            'password' => 'required|max:255',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'jns_kelamin' => '',
            'alamat' => '',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id', $id)->update($validatedData);

        return redirect('/guru')->with('success', 'Data Guru telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/guru')->with('success', 'Data guru telah dihapus!');
    }
}
