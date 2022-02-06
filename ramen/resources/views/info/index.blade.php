{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'トップ - ラーメンresearch')


@section('content')
    <div class="container">
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
                        <span class="latest_review lead font-weight-bold">{{ __('messages.Latest_Review') }}</span>
                        <div class="meet">
                            該当件数: {{ $reviews -> total() }}件
                        </div>
                        <form class="mx-auto" action="{{ route('search') }}" method="GET">
                            @csrf

                            @foreach ($reviews as $review)
                                <div class="row">
                                    <div class="reviews col-md-8 mx-auto mt-2">
                                        <form action="{{ route('shop.review_refer', ['shop_id' => $review->shop_id, 'user_id' => $review->user_id]) }}" method="GET">
                                            <a class="text-decoration-none text-dark" href="{{ route('shop.review_refer', ['shop_id' => $review->shop_id, 'user_id' => $review->user_id]) }}?">
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
                                                        <span class="category">{{ $review->category }}</span>
                                                        <span class="soup">{{ $review->soup }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex align-items-center justify-content-center mt-3">
                                {{-- ペジネーション結果の表示 --}}
                                {{-- {{ $shops->links() }} --}}
                                {{ $reviews -> appends(['disp' => $disp]) -> links() }}
                            </div>

                            <div class="meet">
                                表示件数：
                                {{ Form::open(['url' => '/search', 'method' => 'get']) }}
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
