<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);
        $user->fill($data);
        if ($user->isDirty('email')) $user->email_verified_at = null;
        $user->save();

        $user->anggota?->update(['nama' => $user->name, 'email' => $user->email]);
        return back()->with('status', 'Profil berhasil diperbarui.');
    }
}
