{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '検索 - ラーメンresearch')


@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.Title') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Shop_Search') }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Filter') }}
                        {{ Form::open(['url' => '/search', 'method' => 'get']) }}
                        <div class="form-group row">
                            <div class="pr-3 pb-2">
                                {{-- キーワード検索フォーム --}}
                                {{ Form::text('keyword', $keyword, ['class' => 'form-control', 'placeholder' => __('messages.Keyword')]) }}
                            </div>
                            <div class="pr-3 pb-2">
                                {{-- 都道府県のプルダウンメニュー --}}
                                {{ Form::select('preflist', App\Models\Prefectures::prefList(), $pref_id, ['placeholder' => '▼都道府県', 'class' => 'form-control', 'id' => 'preflist']) }}
                            </div>
                            <div class="pr-3 pb-2">
                                {{-- 市区町村のプルダウンメニュー --}}
                                <select name="city" id="city" class="form-control">
                                    @if ($city != '')
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @else
                                        <option value="">全域</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-3">
                            <div class="favorite font-weight-bold col-md-2">
                                <span>こだわり</span>
                            </div>
                            <div class="col-md-10 row">
                            @foreach ($tags_category as $key => $tag_category)
                                <div style="white-space: nowrap;" class="ml-2">
                                    {{ Form::checkbox('tags[]', $key, in_array((String)$key, $params['tags'], true), ['id' => 'tags-' . $key]) }}
                                    {{ Form::label('tags-' . $key, $tag_category) }}
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-1">
                            <div class="shop_types font-weight-bold col-md-3">
                                <span>ラーメン店のタイプ</span>
                            </div>
                            <div class="col-md-9 row">
                            @foreach ($shop_types as $key => $shop_type)
                                <div style="white-space: nowrap;" class="ml-2">
                                    {{ Form::checkbox('types[]', $key, in_array((String)$key, $params['types'], true), ['id' => 'types-' . $key]) }}
                                    {{ Form::label('types-' . $key, $shop_type) }}
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="mt-3">
                            {{ Form::submit(__('messages.Shop_Search'), ['class' => 'btn btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                        
                        {{ Form::open(['url' => route('shop.entry'), 'method' => 'get']) }}
                        <div class="float-right">
                            <div>
                                {{ Form::submit(__('messages.Shop_Enter'), ['class' => 'btn btn-success']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>

                    <div class="card-body">
                        <div class="meet">
                            該当件数: {{ $shops -> total() }}件
                        </div>
                        @csrf

                        @foreach ($shops as $shop)
                            <div class="row">
                                <div class="shops col-md-10 mx-auto mt-2">
                                    {{-- <form action="{{ route('shop.detail', ['shop_id' => $shop->id]) }}" method="GET"> --}}
                                    <div class="left-contents d-flex align-items-start float-left pr-3 mt-2 mb-2">
                                        @if ($shop->image_path)
                                            <img class="img-thumbnail" src="{{ asset('storage/image/' . $shop->image_path) }}" alt="shop-image" data-toggle="modal" data-target="#image-modal" style="cursor:pointer">

                                            <div class="modal fade" id="image-modal">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-body">
                                                        <img src="{{ asset('storage/image/' . $shop->image_path) }}" alt="shop-image" class="img-thumbnail d-block mx-auto w-100">
                                                    </div>
                                                    <div class="modal-img_footer">
                                                        <button type="button" class="btn btn-primary mx-auto d-block" data-dismiss="modal">閉じる</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                        @endif
                                        {{-- <a class="text-decoration-none text-dark" href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}">
                                            @if ($shop->image_path)
                                                <img class="img-thumbnail" src="{{ asset('storage/image/' . $shop->image_path) }}">
                                            @else
                                                <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                            @endif
                                        </a> --}}
                                    </div>

                                    <div class="right-contents clearfix mt-2">
                                        <div>
                                            <a class="text-decoration-none text-danger" href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}">
                                                <span class="shop_name lead font-weight-bold">{{ $shop->shop_name }}</span>
                                                <span class="branch lead font-weight-bold">{{ $shop->branch }}</span>
                                            </a>
                                        </div>
                                        <div>
                                            <span class="address1">{{ $shop->address1 }}</span>
                                            <span class="address2">{{ $shop->address2 }}</span>
                                            <span class="address3">{{ $shop->address3 }}</span>
                                            <span class="address4">{{ $shop->address4 }}</span>
                                        </div>
                                        <div>
                                            @if ($shop->avg_points)
                                                <span class="points lead font-weight-bold">{{ $shop->avg_points }}点</span>
                                            @else
                                                <span class="points lead font-weight-bold">-------点</span>
                                            @endif
                                        </div>
                                        {{-- <div class="links text-center float-left mt-2">
                                            @if ($shop->facebook || $shop->twitter)
                                                <span class="text-secondary font-weight-bold">外部リンク</span><br />
                                            @endif
                                            @if ($shop->facebook)
                                                <a href="{{ $shop->facebook }}">
                                                    <img class="m-1" src="{{ asset('storage/' . 'facebook_logo.png') }}">
                                                </a>
                                            @endif
                                            @if ($shop->twitter)
                                                <a href="{{ $shop->twitter }}">
                                                    <img class="m-1" src="{{ asset('storage/' . 'Twitter_logo.png') }}">
                                                </a>
                                            @endif
                                        </div> --}}
                                    </div>
                                    {{-- </form> --}}
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex align-items-center justify-content-center mt-3">
                            {{-- ペジネーション結果の表示 --}}
                            {{-- {{ $shops->links() }} --}}
                            {{ $shops -> appends(['disp' => $disp, 'keyword' => $keyword, 'preflist' => $pref_id, 'city' => $city, 'tags' => $params['tags'], 'types' => $params['types']]) -> links() }}
                        </div>

                        <div class="meet">
                            表示件数：
                            {{ Form::open(['url' => '/search', 'method' => 'get']) }}
                                {{ Form::select('disp', ['10' => '10', '20' => '20', '50' => '50', '100' => '100'], $disp, ['class' => 'disp', 'id' => 'disp', 'onchange' => 'submit();']) }}
                                {{ Form::hidden('keyword', $keyword) }}
                                {{ Form::hidden('preflist', $pref_id) }}
                                {{ Form::hidden('city', $city, ['id' => 'city_id']) }}
                                @foreach ($tags_category as $key => $tag_category)
                                    @if (in_array((String)$key, $params['tags'], true))
                                        {{ Form::hidden('tags[]', $key, ['id' => 'tags-' . $key]) }}
                                    @endif
                                @endforeach
                                @foreach ($shop_types as $key => $shop_type)
                                    @if (in_array((String)$key, $params['types'], true))
                                        {{ Form::hidden('types[]', $key, ['id' => 'types-' . $key]) }}
                                    @endif
                                @endforeach
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
