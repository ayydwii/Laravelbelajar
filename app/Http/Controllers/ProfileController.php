<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Kalau ada file foto baru
    if ($request->hasFile('photo')) {
        // Hapus foto lama
        if ($user->photo && \Storage::exists('public/photos/' . $user->photo)) {
            \Storage::delete('public/photos/' . $user->photo);
        }

        // Simpan foto baru
        $path = $request->file('photo')->store('photos', 'public');
        $user->photo = basename($path);
    }

    // Update data lainnya
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
}
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
