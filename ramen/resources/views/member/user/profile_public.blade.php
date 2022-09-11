{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'プロフィール編集 - ラーメンresearch')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Mypage_Public_Profile') }}</div>

                    <div class="card-body">
                        {{-- 各種メニュー --}}
                        <div class="float-right row mb-4 col-7">
                            {{-- {{ Form::open(['url' => route('mypage'), 'method' => 'get']) }} --}}
                            <div class="pr-3 pb-2">
                                {{-- {{ Form::submit(__('messages.Top'), ['class' => 'btn btn-success']) }} --}}
                                <a href="{{ route('mypage') }}" class="btn btn-success">{{ __('messages.Top') }}</a>
                            </div>
                            {{-- {{ Form::close() }} --}}
                            {{-- {{ Form::open(['url' => route('profile_public'), 'method' => 'get']) }} --}}
                            <div class="pr-3 pb-2">
                                {{-- {{ Form::submit(__('messages.Public_Profile'), ['class' => 'btn btn-success']) }} --}}
                                <a href="{{ route('profile_public') }}" class="btn btn-success">{{ __('messages.Public_Profile') }}</a>
                            </div>
                            {{-- {{ Form::close() }} --}}
                            {{-- {{ Form::open(['url' => route('profile_edit'), 'method' => 'get']) }} --}}
                            <div class="pr-3 pb-2">
                                {{-- {{ Form::submit(__('messages.Profile_Edit'), ['class' => 'btn btn-success']) }} --}}
                                <a href="{{ route('profile_edit') }}" class="btn btn-success">{{ __('messages.Profile_Edit') }}</a>
                            </div>
                            {{-- {{ Form::close() }} --}}
                        </div>

                        <div class="float-left col-md-12">
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
                                        @if ($profile[0]->birth_year == '非公開')
                                            <span>{{ $profile[0]->birth_year }}</span>
                                        @else
                                            <span>{{ $profile[0]->birth_year }}年</span>
                                        @endif
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
    </div>
@endsection
