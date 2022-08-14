{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'レビュー投稿確認 - ラーメンresearch')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Entry_Check') }}</div>

                    <div class="card-body">
                        <form action="{{ route('review_create', ['shop_id' => $shop_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- メニュー（タイトル） --}}
                            <div class="form-group row rounded border border-warning mx-3">
                                <label for="menu_title" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Menu_Title') }}</label>

                                <div class="col-md-6 d-flex align-items-center">
                                    <span>{{ $form['menu_title'] }}</span>
                                    <input id="menu_title" type="hidden" class="form-control @error('menu_title') is-invalid @enderror" name="menu_title" value="{{ $form['menu_title'] }}" autofocus>

                                    @error('menu_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- カテゴリ --}}
                            <div class="form-group row rounded border border-warning mx-3">
                                <label for="category" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Category') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <span>{{ $form['category'] }}</span>
                                    <input id="category" type="hidden" class="form-control" name="category" value="{{ $form['category'] }}">
                                </div>
                            </div>

                            {{-- スープ --}}
                            <div class="form-group row rounded border border-warning mx-3">
                                <label for="soups" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Soups') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <span>{{ $form['soup'] }}</span>
                                    <input id="soup" type="hidden" class="form-control" name="soup" value="{{ $form['soup'] }}">
                                </div>
                            </div>

                            {{-- 点数 --}}
                            <div class="form-group row rounded border border-warning mx-3">
                                <label for="points" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Points') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <span>{{ $form['points'] }}点</span>
                                    <input id="points" type="hidden" class="form-control" name="points" value="{{ $form['points'] }}">                                    
                                </div>
                            </div>

                            {{-- メニュー画像 --}}
                            <div class="form-group row rounded border border-warning mx-3">
                                <label for="image_name" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Image_Name') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <div>{{ $form["image_name"] }}</div>
                                    <input id="image_name" type="hidden" class="form-control" name="image_name" value="{{ $form["image_name"] }}">
                                </div>
                            </div>

                            {{-- コメント --}}
                            <div class="form-group row rounded border border-warning mx-3">
                                <label for="comment" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Comment') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <span>{{ $form['comment'] }}</span>
                                    <input id="comment" type="hidden" class="form-control" name="comment" value="{{ $form['comment'] }}">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    {{ csrf_field() }}
                                    {{-- 投稿ボタン --}}
                                    <button type="submit" class="btn btn-primary" name="post">
                                    {{ __('messages.Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('review_post', ['shop_id' => $shop_id]) }}" method="GET">
                            @csrf
                            <input id="mode" type="hidden" class="form-control" name="mode" value="true">
                            <input id="shop_name" type="hidden" class="form-control" name="shop_name" value="{{ $form['shop_name'] }}">
                            <input id="branch" type="hidden" class="form-control" name="branch" value="{{ $form['branch'] }}">
                            {{-- 修正ボタン --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('messages.Fix') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
