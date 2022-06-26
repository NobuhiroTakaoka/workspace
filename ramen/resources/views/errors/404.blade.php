{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', __('404 Not Found - ラーメンresearch'))


@section('content')
    <div>
        <p class="h1 text-center">404 Not Found</p>
        <p class="h2 text-center">該当のページは削除された可能性があります。</p>
    </div>
@endsection
