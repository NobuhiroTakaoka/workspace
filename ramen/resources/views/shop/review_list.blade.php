{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'レビュー - ラーメンresearch'を埋め込む --}}
@section('title', 'レビュー - ラーメンresearch')


@section('content')
    <div class="container">
        {{-- <hr color="#c0c0c0"> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('messages.Title') }}</a></li>
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
                                <div class="pr-3 pb-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="{{ __('messages.Keyword') }}">
                                </div>
                                <div class="pr-3 pb-2">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-primary" value="{{ __('messages.Shop_Search') }}">
                                </div>
                            </div>
                        </form>
                    </div>
        
                    <div class="card-body">
                        <div class="meet lead font-weight-bold">
                            <span>{{ $shop_name }}</span>
                            <span>{{ $branch }}</span>
                        </div>
                        <div class="meet">
                            レビュー件数: {{ $review_list -> total() }}件
                        </div>
                        <form class="mx-auto" action="{{ route('shop.review_list', ['shop_id' => $shop_id]) }}" method="GET">
                            @csrf

                            @foreach ($review_list as $review)
                                <div class="row">
                                    <div class="reviews col-md-10 mx-auto mt-2">
                                        {{-- <form action="{{ route('shop.review_list', ['shop_id' => $review->shop_id, 'user_id' => $review->user_id]) }}" method="GET"> --}}
                                        <div class="top-contents ml-1 mt-2 row">
                                            <div class="px-1 pt-2 pb-1 bg-warning rounded border border-danger text-right">
                                                <span class="h4 font-weight-bold">{{ $review->points }}</span>
                                                <span class="h6 font-weight-bold">点</span>
                                            </div>
                                            <a class="text-dark pl-2 pt-2" href="{{ route('shop.review_detail', ['shop_id' => $review->shop_id, 'review_id' => $review->id]) }}">
                                                <span class="menu_title lead font-weight-bold pl-1">{{ $review->menu_title }}</span>
                                            </a>
                                        </div>

                                        <div class="left-contents d-flex align-items-start float-left pr-3 mt-2">
                                            <div>
                                                {{-- <a class="review-img" href="{{ route('shop.review_detail', ['shop_id' => $review->shop_id, 'review_id' => $review->id]) }}">
                                                    @if ($review->image_path)
                                                        <img class="img-thumbnail" src="{{ asset('storage/image/' . $review->image_path) }}">
                                                    @else
                                                        <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                                    @endif
                                                </a> --}}

                                                @if ($review->image_path)
                                                    <img src="{{ asset('storage/image/' . $review->image_path) }}" alt="review-image" class="img-thumbnail" data-toggle="modal" data-target="#image-modal" style="cursor:pointer">

                                                    <div class="modal fade" id="image-modal">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-body">
                                                                <img src="{{ asset('storage/image/' . $review->image_path) }}" alt="review-image" class="img-thumbnail d-block mx-auto w-100">
                                                            </div>
                                                            <div class="modal-img_footer">
                                                                <button type="button" class="btn btn-primary mx-auto d-block" data-dismiss="modal">閉じる</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                                @endif
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
                                                    @if (mb_strlen($review->comment) > 120)
                                                        {!! nl2br(e(Str::limit($review->comment, 100, '…'))) !!}
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
                                    <div class="pt-3 bottom-contents col-md-10 mx-auto d-flex align-items-end justify-content-end">
                                        <div class="row">
                                            <div class="histories">
                                                <span>{{ $review->created_at->format('Y/m/d H:i') }}</span>
                                                <span class="mr-3">投稿</span><br class="d-sm-none" />
                                                <span>{{ $review->updated_at->format('Y/m/d H:i') }}</span>
                                                <span class="mr-3">更新</span><br class="d-sm-none" />
                                                <a class="text-decoration-none" href="{{ route('profile_refer', ['user_id' => $review->user_id]) }}">
                                                    <span>投稿者</span>
                                                    <span class="mr-3">{{ $review->name }}</span>
                                                </a>
                                            </div>
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
                                {{ Form::open([
                                    'route' => ['shop.review_list',
                                    'shop_id' => $shop_id],
                                    'method' => 'get'
                                    ]) }}
                                    {{ Form::select('disp', [
                                        '10' => '10',
                                        '20' => '20',
                                        '50' => '50',
                                        '100' => '100'
                                        ], $disp, [
                                            'class' => 'disp',
                                            'id' => 'disp',
                                            'onchange' => 'submit();'
                                            ]) }}
                                    {{ Form::hidden('shop_name', $shop_name) }}
                                    {{ Form::hidden('branch', $branch) }}
                                {{ Form::close() }}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
