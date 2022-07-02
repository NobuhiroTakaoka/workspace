{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'ユーザプロフィール - ラーメンresearch')


@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.Title') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="head-title">{{ __('messages.User_Profile') }}</span>
                        <span class="font-weight-bold">
                            {{ $user->name }}
                        </span>
                    </div>

                    <div class="card-body users">
                        {{-- ニックネーム --}}
                        <div class="form-group row">
                            <label for="nickname" class="col-md-3 col-form-label text-md-right">{{ __('messages.Nickname') }}</label>

                            <div class="col-md-9 d-flex align-items-center">
                                <span>{{ $profile[0]->nickname }}</span>
                            </div>
                        </div>

                        {{-- 性別 --}}
                        <div class="form-group row">
                            <label for="gender" class="col-md-3 col-form-label text-md-right">{{ __('messages.Gender') }}</label>
                            
                            <div class="col-md-9 d-flex align-items-center">
                                <span>{{ $profile[0]->gender }}</span>
                            </div>
                        </div>

                        {{-- 誕生年 --}}
                        <div class="form-group row">
                            <label for="birth_year" class="col-md-3 col-form-label text-md-right">{{ __('messages.Birth_Year') }}</label>
                            
                            <div class="col-md-3 d-flex align-items-center">
                                <span>{{ $profile[0]->birth_year }}年</span>
                            </div>
                        </div>

                        {{-- 出身地 --}}
                        <div class="form-group row">
                            <label for="base" class="col-md-3 col-form-label text-md-right">{{ __('messages.Base') }}</label>
                            
                            <div class="col-md-3 d-flex align-items-center">
                                <span>{{ $profile[0]->base }}</span>
                            </div>
                        </div>

                        {{-- プロフィール画像 --}}
                        <div class="form-group row">
                            <label for="image_file" class="col-md-3 col-form-label text-md-right">{{ __('messages.Profile_Image') }}</label>

                            <div class="col-md-9 d-flex align-items-center">
                                @if (!empty($profile[0]->image_path))
                                    <img class="img-thumbnail" src="{{ asset('storage/image/' . $profile[0]->image_path) }}">
                                @else
                                    <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">
                                @endif
                            </div>
                        </div>

                        {{-- 自己紹介 --}}
                        <div class="form-group row d-flex align-items-center">
                            <label for="introduction" class="col-md-3 col-form-label text-md-right">{{ __('messages.Introduction') }}</label>
                            
                            <div class="col-md-9 d-flex align-items-center">
                                <span>{{ $profile[0]->introduction }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
