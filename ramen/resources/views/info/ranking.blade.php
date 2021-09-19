{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'ランキング - ラーメンresearch')


@section('content')
    <div class="container">
        <p>ランキングページ</p>
        <hr color="#c0c0c0">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
            </div>
        </div>
    </div>
@endsection
