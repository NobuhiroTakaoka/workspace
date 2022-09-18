{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'検索 - ラーメンresearch'を埋め込む --}}
@section('title', '検索 - ラーメンresearch')


@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('messages.Title') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('shop.detail', ['shop_id' => $review_detail[0]->shop_id]) }}">{{ $review_detail[0]->shop_name . ' ' . $review_detail[0]->branch }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('shop.review_list', ['shop_id' => $review_detail[0]->shop_id, 'shop_name' => $review_detail[0]->shop_name, 'branch' => $review_detail[0]->branch]) }}">{{ __('messages.Review_List') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Review_Detail') }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="head-title">{{ __('messages.Review_Detail') }}</span>
                        <span class="font-weight-bold pr-2">{{ $review_detail[0]->shop_name }}</span>
                        <span class="font-weight-bold">{{ $review_detail[0]->branch }}</span>
                    </div>

                    <div class="card-body">
                        <div class="reviews col-md-10 mx-auto pt-2">
                            <div class="top-contents ml-1 mt-2 row">
                                <div class="px-1 pt-2 pb-1 bg-warning rounded border border-danger text-right">
                                    <span class="h4 font-weight-bold">{{ $review_detail[0]->points }}</span>
                                    <span class="h6 font-weight-bold">点</span>
                                </div>
                                <span class="menu_title lead font-weight-bold pl-2 pt-2">{{ $review_detail[0]->menu_title }}</span>
                            </div>
                            <div class="left-contents d-flex align-items-start float-left pr-3 mt-2">
                                <div>
                                    @if ($review_detail[0]->image_path)
                                        <img src="{{ asset('storage/image/' . $review_detail[0]->image_path) }}" alt="review-image" class="img-thumbnail" data-toggle="modal" data-target="#image-modal" style="cursor:pointer">

                                        <div class="modal fade" id="image-modal">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-body">
                                                    <img src="{{ asset('storage/image/' . $review_detail[0]->image_path) }}" alt="review-image" class="img-thumbnail d-block mx-auto w-100">
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
                                    <a class="text-decoration-none text-danger" href="{{ route('shop.detail', ['shop_id' => $review_detail[0]->shop_id]) }}">
                                        <span class="shop_name font-weight-bold pr-2">{{ $review_detail[0]->shop_name }}</span>
                                        <span class="branch font-weight-bold">{{ $review_detail[0]->branch }}</span>
                                    </a>
                                </div>
                                <div>
                                    <span class="comment">
                                        {!! nl2br(e($review_detail[0]->comment)) !!}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 bottom-contents col-md-10 mx-auto d-flex align-items-end justify-content-end">
                            <div>
                                <div class="histories">
                                    <span>{{ $review_detail[0]->created_at->format('Y/m/d H:i') }}</span>
                                    <span>投稿</span>
                                </div>
                                <div class="histories">
                                    <span>{{ $review_detail[0]->updated_at->format('Y/m/d H:i') }}</span>
                                    <span>更新</span>
                                </div>
                                <div class="histories">
                                    <a class="text-decoration-none" href="{{ route('profile_refer', ['user_id' => $review_detail[0]->user_id]) }}">
                                        <span>投稿者</span>
                                        <span>{{ $review_detail[0]->name }}</span>
                                    </a>
                                </div>
                            </div>

                            @if ($review_detail[0]->user_id == $user_id)
                                <div class="ml-4">
                                    <div class="pb-2">
                                        <a href="{{ route('review_edit', ['shop_id' => $review_detail[0]->shop_id, 'review_id' => $review_detail[0]->id]) }}">
                                            <button class="btn btn-primary">{{ __('messages.Review_Edit') }}</button>
                                        </a>
                                    </div>
                                    <div class="pb-2">                                  
                                        <form name="deleteform" action="{{ route('review_delete', ['shop_id' => $review_detail[0]->shop_id, 'review_id' => $review_detail[0]->id]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{-- 削除ボタンをクリックしたら、呼び出される確認ダイアログ --}}
                                            {{ Form::submit(__('messages.Review_Delete'), ['class' => 'btn btn-secondary', 'onclick' => 'return confirm(\'このレビューを本当に削除しますか？\');']) }}
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
