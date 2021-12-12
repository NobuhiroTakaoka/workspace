{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '検索 - ラーメンresearch')


@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">ラーメンResearch</a></li>
              <li class="breadcrumb-item active" aria-current="page">検索</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Search') }}</div>

                    <div class="card-body">
                        <div>
                            該当件数: {{ $posts -> total() }}件
                        </div>
                        <form class="mx-auto" action="{{ route('search') }}" method="GET">
                            @csrf



                            @foreach ($posts as $shop)
                                <div class="row">
                                    <div class="posts col-md-8 mx-auto mt-2">
                                        <a class="text-decoration-none text-dark" href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}">
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
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex align-items-center justify-content-center mt-3">
                                {{-- ペジネーション結果の表示 --}}
                                {{-- {{ $posts->links() }} --}}
                                {{ $posts -> appends(['disp' => $disp]) -> links() }}
                            </div>

                            <div>
                                表示件数：
                                {{-- <select id="disp" name="disp" onchange="submit();">
                                    <option value="10" selected="selected">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> --}}
                                {{-- @if (isset($disp)) --}}
                                    {{ Form::select('disp', ['10' => '10', '20' => '20', '50' => '50', '100' => '100'], $disp, ['class' => 'disp', 'id' => 'disp', 'onchange' => 'submit();']) }}                                    
                                {{-- @else
                                    {{ Form::select('disp', ['10' => '10', '20' => '20', '50' => '50', '100' => '100'], '10', ['class' => 'disp', 'id' => 'disp', 'onchange' => 'submit();']) }}                                    
                                @endif --}}
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
