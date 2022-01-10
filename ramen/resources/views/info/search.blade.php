{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '検索 - ラーメンresearch')


@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.Title') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Shop_Search') }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Search') }}
                        {{ Form::open(['url' => '/search', 'method' => 'get']) }}
                        <div class="d-flex flex-row">
                            {{-- {{ Form::text('keyword', $form['keyword']) }} --}}
                            <div>{{ Form::text('keyword', $keyword, ['placeholder' => __('messages.Keyword')]) }}</div>
                            <div>
                                @foreach ($tags_category as $key => $tag_category)
                                    {{ Form::checkbox('tags[]', $key, in_array((String)$key, $params['tags'], true), ['id' => 'tags-' . $key]) }}
                                    {{ Form::label('tags-' . $key, $tag_category) }}
                                @endforeach
                            </div>
                            <div>{{ Form::submit(__('messages.Shop_Search'), ['class' => 'btn btn-primary']) }}</div>
                        </div>
                        {{ Form::close() }}
                        {{ Form::open(['url' => '/member/shop/entry', 'method' => 'get']) }}
                        <div class="float-right">
                            <div>{{ Form::submit(__('messages.Shop_Enter'), ['class' => 'btn btn-success']) }}</div>
                        </div>
                        {{ Form::close() }}
                    </div>

                    <div class="card-body">
                        <div class="meet">
                            該当件数: {{ $shops -> total() }}件
                        </div>
                        <form class="mx-auto" action="{{ route('search') }}" method="GET">
                            @csrf

                            @foreach ($shops as $shop)
                                <div class="row">
                                    <div class="shops col-md-8 mx-auto mt-2">
                                        <form action="{{ route('shop.detail', ['shop_id' => $shop->id]) }}" method="GET">
                                            <a class="text-decoration-none text-dark" href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}?">
                                                <div class="left-contents float-left mr-3 mt-2">
                                                    @if ($shop->image_path)
                                                        <img class="img-thumbnail" src="{{ asset('storage/image/' . $shop->image_path) }}">                                                    
                                                    @else
                                                        <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                                    @endif
                                                </div>

                                                <div class="right-contents mt-2">
                                                    <div>
                                                        <span class="shop_name lead font-weight-bold">{{ $shop->shop_name }}</span>
                                                        <span class="branch lead font-weight-bold">{{ $shop->branch }}</span>
                                                        
                                                    </div>
                                                    <div>
                                                        {{-- <span class="postcode">〒{{ $shop->postcode }}</span> --}}
                                                        <span class="address1">{{ $shop->address1 }}</span>
                                                        <span class="address2">{{ $shop->address2 }}</span>
                                                        <span class="address3">{{ $shop->address3 }}</span>
                                                        <span class="address4">{{ $shop->address4 }}</span>
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
                                {{ $shops -> appends(['disp' => $disp]) -> links() }}
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
