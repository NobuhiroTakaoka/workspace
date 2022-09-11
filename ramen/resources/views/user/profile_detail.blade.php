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
                        <div class="form-group row rounded border border-warning mx-5">
                            <label for="nickname" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Nickname') }}</label>

                            <div class="col-md-9 d-flex align-items-center">
                                @if (isset($profile[0]))
                                    <span>{{ $profile[0]->nickname }}</span>
                                @else
                                    <span>非公開</span>
                                @endif
                            </div>
                        </div>

                        {{-- 性別 --}}
                        <div class="form-group row rounded border border-warning mx-5">
                            <label for="gender" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Gender') }}</label>
                            
                            <div class="col-md-9 d-flex align-items-center">
                                @if (isset($profile[0]))
                                    <span>{{ $profile[0]->gender }}</span>
                                @else
                                    <span>非公開</span>
                                @endif
                            </div>
                        </div>

                        {{-- 誕生年 --}}
                        <div class="form-group row rounded border border-warning mx-5">
                            <label for="birth_year" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Birth_Year') }}</label>
                            
                            <div class="col-md-3 d-flex align-items-center">
                                @if (isset($profile[0]))
                                    <span>{{ $profile[0]->birth_year }}年</span>
                                @else
                                    <span>非公開</span>
                                @endif
                            </div>
                        </div>

                        {{-- 出身地 --}}
                        <div class="form-group row rounded border border-warning mx-5">
                            <label for="base" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Base') }}</label>
                            
                            <div class="col-md-3 d-flex align-items-center">
                                @if (isset($profile[0]))
                                    <span>{{ $profile[0]->base }}</span>
                                @else
                                    <span>非公開</span>
                                @endif
                            </div>
                        </div>

                        {{-- プロフィール画像 --}}
                        <div class="form-group row rounded border border-warning mx-5">
                            <label for="image_file" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Profile_Image') }}</label>

                            <div class="col-md-9 d-flex align-items-center">
                                @if (isset($profile[0]))
                                    @if (!empty($profile[0]->image_path))
                                        <img class="img-thumbnail" src="{{ asset('storage/image/' . $profile[0]->image_path) }}">
                                    @else
                                        <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">
                                    @endif
                                @else
                                    <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">
                                @endif
                            </div>
                        </div>

                        {{-- 自己紹介 --}}
                        <div class="form-group row rounded border border-warning mx-5">
                            <label for="introduction" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Introduction') }}</label>
                            
                            <div class="col-md-9 d-flex align-items-center">
                                @if (isset($profile[0]))
                                    <span>
                                        {!! nl2br(e($profile[0]->introduction)) !!}
                                    </span>
                                @else
                                    <span>非公開</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
