@extends('layouts.app')

@section('content')

<h2>住所変更画面</h2>

<form action="/purchase/address/{{ $item->id }}" method="POST">
    @csrf

    <input type="text" name="address" value="{{ $user->address }}">
    
    <button type="submit">
        更新する
    </button>
</form>

@endsection