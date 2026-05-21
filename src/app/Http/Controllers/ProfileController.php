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

        $user->update([
            'name' => $request->name,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect('/mypage')->with('message', '更新しました');
    }
}

