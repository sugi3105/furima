<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%'. $request->keyword . '%');
        }

        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        $items = $query->get();

        return view('items.index', compact('items'));
    }

    public function show($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('items.show', compact('item'));
    }

    public function create()
    {
        return view('items.create');
    }
    public function store(ItemRequest $request)
    {
        Item::create($request->all());
        return redirect('/');
    }

    public function mylist(Request $request)
    {
        if (!auth()->check()) {
        $items = collect();
        return view('mylist', compact('items'));
    }
        $query = Item::whereHas('likes', function ($query) {
            $query->where('user_id' , auth()->id());
        });

        //if ($request->filled('keyword')) {
        //$query->where('name', 'like', '%' . $request->keyword . '%');
    //}

        $items = $query->get();

        return view('mylist', compact('items'));
        }
    }

