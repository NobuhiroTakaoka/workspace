{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'トップ - ラーメンresearch')


@section('content')
    <div class="container">
        <form action="{{ route('search') }}" method="GET">
            <div class="form-group row">
                <div class="col-md-2">
                   <input type="text" class="form-control" name="keyword" placeholder="キーワード">
                </div>
                <div class="col-md-2">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="検索">
                </div>
            </div>
        </form>
        <hr color="#c0c0c0">

        <hr color="#c0c0c0">
        

    </div>
@endsection
