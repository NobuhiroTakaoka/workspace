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
        @foreach ($posts as $shop)
            <div class="row">
                <div class="posts col-md-8 mx-auto mt-3">
                    <div class="shop_name">{{ $shop->shop_name }}</div>
                    <div class="address">
                        @if ($shop->address1)
                            <span>〒</span>
                        @endif
                        {{ $shop->address1 }}
                        {{ $shop->address2 }}
                        {{ $shop->address3 }}
                        {{ $shop->address4 }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
