<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
         $user = Auth::user();

         $path = null;

         if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')
                            ->store('profiles', 'public');
    }

         $user->update([
           'name' => $request->name,
           'postcode' => $request->postcode,
           'address' => $request->address,
           'building' => $request->building,
           'profile_image' => $path,
    ]);

    return redirect('/mypage')->with('message', '更新しました');
        
}}

