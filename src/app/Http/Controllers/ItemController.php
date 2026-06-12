<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use App\Models\Category;
use App\Http\Requests\ItemRequest;


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
        $categories = Category::all();
          
        return view('items.create', compact('categories'));
    }
    public function store(ItemRequest $request)
    {
        $path = $request->file('img_url')
                        ->store('items', 'public');

        $item = Item::create([
          'name' => $request->name,
          'price' => $request->price,
          'brand' => $request->brand,
          'description' => $request->description,
          'img_url' => $path,
          'condition' => $request->condition,
          'user_id' => auth()->id(),
        ]);
        

        $item->categories()->sync($request->categories);

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

        if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

        $items = $query->get();

        return view('mylist', compact('items'));
    }

    public function mypage()
    {
          $user = auth()->user();

          $sellItems = Item::where(
                      'user_id',
                       auth()->id()
                       )->get();

          $purchasedItems = Item::where(
                       'purchaser_id',
                       auth()->id()
                        )->get();

        return view('mypage', compact(
                    'user',
                    'sellItems',
                    'purchasedItems'
    ));
 }}

