@extends('layouts.app')

@section('content')

<div class="address-container">

    <h2>住所の変更</h2>

    <form action="/purchase/address/{{ $item->id }}" method="POST">
        @csrf

        <div class="form-group">
            <label>郵便番号</label>
            <input type="text" name="postcode"
                value="{{ old('postcode', $user->postcode) }}">
            @error('postcode')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>住所</label>
            <input type="text" name="address"
                value="{{ old('address', $user->address) }}">
            @error('address')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>建物名</label>
            <input type="text" name="building"
                value="{{ old('building', $user->building) }}">

        </div>


        <button type="submit" class="update-btn">
            更新する
        </button>
    </form>

    @endsection