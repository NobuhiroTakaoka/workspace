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
                        <div class="meet lead font-weight-bold">
                            {{ $shop_name . ' ' . $branch }}
                        </div>
                        <div class="meet">
                            レビュー件数: {{ $review_list -> total() }}件
                        </div>
                        <form class="mx-auto" action="{{ route('shop.review_list', ['shop_id' => $shop_id]) }}" method="GET">
                            @csrf

                            @foreach ($review_list as $review)
                                <div class="row">
                                    <div class="reviews col-md-8 mx-auto mt-2">
                                        {{-- <form action="{{ route('shop.review_list', ['shop_id' => $review->shop_id, 'user_id' => $review->user_id]) }}" method="GET"> --}}
                                        <div class="top-contents mt-2">
                                            <a class="text-decoration-none text-dark" href="{{ route('shop.review_detail', ['shop_id' => $review->shop_id, 'review_id' => $review->id]) }}">
                                                <span class="points h4 font-weight-bold pr-2">{{ $review->points }}点</span>
                                                <span class="menu_title lead font-weight-bold text-muted">{{ $review->menu_title }}</span>
                                            </a>
                                        </div>

                                        <div class="left-contents d-flex align-items-start float-left pr-3 mt-2">
                                            <div>
                                                <a class="review-img" href="{{ route('shop.review_detail', ['shop_id' => $review->shop_id, 'review_id' => $review->id]) }}">
                                                    @if ($review->image_path)
                                                        <img class="img-thumbnail" src="{{ asset('storage/image/' . $review->image_path) }}">
                                                    @else
                                                        <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="right-contents clearfix pr-3 mt-2">
                                            <div>
                                                <a class="text-decoration-none text-danger" href="{{ route('shop.detail', ['shop_id' => $review->shop_id]) }}">
                                                    {{-- <span class="postcode">〒{{ $shop->postcode }}</span> --}}
                                                    <span class="shop_name font-weight-bold pr-2">{{ $shop_name }}</span>
                                                    <span class="branch font-weight-bold">{{ $branch }}</span>
                                                </a>
                                            </div>
                                            <div>
                                                <span class="comment">
                                                    @if (mb_strlen($review->comment) > 40)
                                                        {!! nl2br(e(Str::limit($review->comment, 30, '…'))) !!}
                                                        <a class="text-decoration-none" href="{{ route('shop.review_detail', ['shop_id' => $review->shop_id, 'review_id' => $review->id]) }}">
                                                            続きを見る
                                                        </a>
                                                    @else
                                                        {!! nl2br(e($review->comment)) !!}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        {{-- </form> --}}
                                    </div>
                                    <div class="bottom-contents col-md-8 mx-auto d-flex align-items-end justify-content-end">
                                        <div>
                                            <span class="created">{{ $review->created_at->format('Y/m/d H:i') }}&nbsp 投稿</span>&nbsp&nbsp
                                            <span class="updated">{{ $review->updated_at->format('Y/m/d H:i') }}&nbsp 更新</span>&nbsp&nbsp
                                            <a class="text-decoration-none" href="{{ route('profile_refer', ['user_id' => $review->user_id]) }}">
                                                <span class="text-right">投稿者 &nbsp{{ $review->name }}</span>
                                            </a>
                                        </div>
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
