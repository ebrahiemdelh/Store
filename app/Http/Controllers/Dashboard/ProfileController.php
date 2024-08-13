<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'in:male,female',
            'country' => 'required|string|size:2',
        ]);
        $user = $request->user();
        $user->profile->fill($request->all())->save();
        return redirect()->route('dashboard.profile.edit')->with('success', 'Profile updated successfully');
        // $profile = $user->profile;
        // if ($profile->user_id) {
        //     $user->profile->update($request->all());
        //     return redirect()->route('dashboard.profile.edit')->with('success', 'Profile updated successfully');
        // } else {
        //     $user->profile()->create($request->all());
        //     return redirect()->route('dashboard.profile.edit')->with('success', 'Profile created successfully');
        // }
    }
}
