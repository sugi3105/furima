<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
   public function store(Request $request, $itemId)
   {
     $request->validate([
        'content' => 'required'
    ]);

    Comment::create([
        'user_id' => auth()->id(),
        'item_id' => $itemId,
        'content' => $request->content,
    ]);

    return back();
}
}