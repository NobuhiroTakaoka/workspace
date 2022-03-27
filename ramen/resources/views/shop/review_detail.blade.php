{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'検索 - ラーメンresearch'を埋め込む --}}
@section('title', '検索 - ラーメンresearch')


@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.Title') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('shop.detail', ['shop_id' => $review_detail[0]->shop_id]) }}">{{ $review_detail[0]->shop_name . ' ' . $review_detail[0]->branch }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('shop.review_list', ['shop_id' => $review_detail[0]->shop_id, 'shop_name' => $review_detail[0]->shop_name]) }}">{{ __('messages.Review_List') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Review_Detail') }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('messages.Review_Detail') }}&nbsp&nbsp&nbsp&nbsp
                        {{ $review_detail[0]->shop_name }}
                        {{ $review_detail[0]->branch }}
                    </div>

                    <div class="card-body">
                        <div class="reviews col-md-10 mx-auto mt-2">
                            <div class="left-contents float-left mr-3 mt-2">
                                @if ($review_detail[0]->image_path)
                                    <img class="img-thumbnail" src="{{ asset('storage/image/' . $review_detail[0]->image_path) }}">
                                @else
                                    <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                @endif
                            </div>

                            <div class="right-contents mt-2">
                                <div>
                                    <span class="points lead font-weight-bold">{{ $review_detail[0]->points }}点</span>
                                    <span class="menu_title lead font-weight-bold">{{ $review_detail[0]->menu_title }}</span>
                                </div>
                                <div>
                                    <span class="comment">
                                        {{ $review_detail[0]->comment }}
                                    </span>
                                </div>
                            </div>

                            <div class="bottom-contents d-flex align-items-end justify-content-end">
                                <div>
                                    <span class="updated_at">{{ $review_detail[0]->updated_at->format('Y/m/d H:i:s') }}&nbsp 投稿</span>&nbsp&nbsp
                                    <span class="text-right">投稿者 &nbsp{{ $review_detail[0]->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
