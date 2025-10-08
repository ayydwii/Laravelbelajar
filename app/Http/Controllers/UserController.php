<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:1,2',
            'username' => 'required|string|max:100|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // dd($validated);
        // simpan foto
        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('photos'), $imageName);
            $validated['photo'] = $imageName;
        }

        // hash password
        $validated['password'] = Hash::make($validated['password']); // jangan lupa hash password

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'role' => 'required|in:1,2',
        'name' => 'required',
        'username' => 'required|unique:users,username,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // kalau ada foto baru
    if ($request->hasFile('photo')) {
        // hapus foto lama kalau ada
        if ($user->photo && file_exists(public_path('photos/'.$user->photo))) {
            unlink(public_path('photos/'.$user->photo));
        }

        // simpan foto baru
        $filename = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('photos'), $filename);
        $validated['photo'] = $filename;
    }

    // update password hanya kalau diisi
    if (!empty($request->password)) {
        $validated['password'] = bcrypt($request->password);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // hapus foto kalau ada
        if ($user->photo && File::exists(public_path('photos/'.$user->photo))) {
            File::delete(public_path('photos/'.$user->photo));
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
