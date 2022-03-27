{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'レビュー - ラーメンresearch'を埋め込む --}}
@section('title', 'レビュー - ラーメンresearch')


@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.Title') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('shop.detail', ['shop_id' => $shop_id]) }}">{{ $shop_name . ' ' . $branch }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Review_List') }}</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="{{ __('messages.Keyword') }}">
                                </div>
                                <div class="col-md-2">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-primary" value="{{ __('messages.Shop_Search') }}">
                                </div>
                            </div>
                        </form>
                    </div>
        
                    <div class="card-body">
                        <div class="meet">
                            レビュー件数: {{ $review_list -> total() }}件
                        </div>
                        <form class="mx-auto" action="{{ route('shop.review_list', ['shop_id' => $shop_id]) }}" method="GET">
                            @csrf

                            @foreach ($review_list as $review)
                                <div class="row">
                                    <div class="reviews col-md-8 mx-auto mt-2">
                                        <form action="{{ route('shop.review_list', ['shop_id' => $review->shop_id, 'user_id' => $review->user_id]) }}" method="GET">
                                            <div class="left-contents float-left mr-3 mt-2">
                                                @if ($review->image_path)
                                                    <img class="img-thumbnail" src="{{ asset('storage/image/' . $review->image_path) }}">
                                                @else
                                                    <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                                @endif
                                            </div>

                                            <div class="right-contents mt-2">
                                                <div>
                                                    <span class="points lead font-weight-bold">{{ $review->points }}点</span>
                                                    <span class="menu_title lead font-weight-bold">{{ $review->menu_title }}</span>
                                                </div>
                                                <div>
                                                    {{-- <span class="postcode">〒{{ $shop->postcode }}</span> --}}
                                                    <span class="shop_name font-weight-bold">{{ $shop_name }}</span>
                                                    <span class="branch font-weight-bold">{{ $branch }}</span>
                                                </div>
                                                <div>
                                                    <span class="comment">
                                                        @if (mb_strlen($review->comment) > 180)
                                                            {{ Str::limit($review->comment, 180, '…')}}
                                                            <a class="text-decoration-none" href="{{ route('shop.review_detail', ['shop_id' => $review->shop_id, 'review_id' => $review->id]) }}?">
                                                                続きを見る
                                                            </a>
                                                        @else
                                                            {{ $review->comment }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="bottom-contents d-flex align-items-end justify-content-end">
                                                <div>
                                                    <span class="updated_at">{{ $review->updated_at->format('Y/m/d H:i:s') }}&nbsp 投稿</span>&nbsp&nbsp
                                                    <span class="text-right">投稿者 &nbsp{{ $review->name }}</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex align-items-center justify-content-center mt-3">
                                {{-- ペジネーション結果の表示 --}}
                                {{ $review_list -> appends(['disp' => $disp]) -> links() }}
                            </div>

                            <div class="meet">
                                表示件数：
                                {{ Form::open(['url' => route('shop.review_list', ['shop_id' => $shop_id]), 'method' => 'get']) }}
                                    {{ Form::select('disp', ['10' => '10', '20' => '20', '50' => '50', '100' => '100'], $disp, ['class' => 'disp', 'id' => 'disp', 'onchange' => 'submit();']) }} 
                                {{ Form::close() }}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
