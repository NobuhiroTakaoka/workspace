{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '検索 - ラーメンresearch')


@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">ラーメンResearch</a></li>
              <li class="breadcrumb-item active" aria-current="page">検索</li>
            </ol>
        </nav>
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
            </div>
        </div>
    </div>
@endsection
