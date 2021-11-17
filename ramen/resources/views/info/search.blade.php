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

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Search') }}</div>

                    <div class="card-body">
                        <form action="{{ url('/member/shop/check') }}" method="GET">
                            @csrf



                            @foreach ($posts as $shop)
                                <div class="row">
                                    <div class="posts col-md-8 mx-auto mt-3">
                                        <div class="left-contents float-left mr-3">
                                            @if ($shop->image_path)
                                                <img class="img-thumbnail img-fluid" src="{{ asset('storage/image/' . $shop->image_path) }}">                                                    
                                            @else
                                                <img class="img-thumbnail img-fluid" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                            @endif
                                        </div>

                                        <div class="right-contents">
                                            <div>
                                                <span class="shop_name">{{ $shop->shop_name }}</span>
                                                <span class="branch">{{ $shop->branch }}</span>
                                            </div>
                                            <div>
                                                {{-- <span class="postcode">〒{{ $shop->postcode }}</span> --}}
                                                <span class="address1">{{ $shop->address1 }}</span>
                                                <span class="address2">{{ $shop->address2 }}</span>
                                                <span class="address3">{{ $shop->address3 }}</span>
                                                <span class="address4">{{ $shop->address4 }}</span>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            @endforeach
                

                        
                        </form>
                    </div>
                </div>
            </div>
        </div>






















    </div>
@endsection
