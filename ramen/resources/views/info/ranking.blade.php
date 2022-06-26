{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'ランキング - ラーメンresearch')


@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.Title') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Ranking') }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Ranking_Filter') }}
                        {{ Form::open(['url' => '/ranking', 'method' => 'get']) }}
                        <div class="d-flex flex-row">
                            <div class="col-md-3">
                                {{-- 都道府県のプルダウンメニュー --}}
                                {{ Form::select('preflist', App\Models\Prefectures::prefList(), $pref_id, ['placeholder' => '▼都道府県', 'class' => 'form-control preflist', 'id' => 'preflist']) }}
                            </div>
                            <div class="col-md-3">
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
                            <div class="shop_types font-weight-bold col-md-3">
                                ラーメン店のタイプ
                            </div>
                            <div class="col-md-9 row">
                            @foreach ($shop_types as $key => $shop_type)
                                <div style="white-space: nowrap;" class="ml-2 form-check">
                                    {{ Form::checkbox('types[]', $key, in_array((String)$key, $params['types'], true), ['id' => 'types-' . $key, 'class' => 'form-check-input']) }}
                                    {{ Form::label('types-' . $key, $shop_type, ['for' => 'types-' . $key, 'class' => 'form-check-label']) }}
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="mt-3">
                            {{ Form::submit(__('messages.Ranking_Disp'), ['class' => 'btn btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                    </div>

                    <div class="card-body">
                        <div class="meet">
                            <span>
                                ランキング条件:
                            </span>
                            @if (!empty($pref_name) || !empty($types_item))
                                <span style="white-space: nowrap;" class="ml-2">
                                    {{ $pref_name }}
                                </span>
                                <span style="white-space: nowrap;" class="ml-2">
                                    {{ $city }}
                                </span>
                                @foreach ($types_item as $key => $type_item)
                                    <span style="white-space: nowrap;" class="ml-2">
                                        {{ $type_item }}
                                    </span>
                                @endforeach
                            @else
                                なし
                            @endif
                        </div>
                        @csrf

                        @foreach ($shops as $key => $shop)
                            <div class="row">
                                <div class="ranks col-md-10 mx-auto mt-2">
                                    <form action="{{ route('shop.detail', ['shop_id' => $shop->id]) }}" method="GET">
                                        <div class="left-contents float-left lead font-weight-bold pr-3">
                                        @if ($counter < 10)
                                            <span>&nbsp {{ $counter }}位</span>
                                        @else
                                            <span>{{ $counter }}位</span>
                                        @endif
                                        </div>
                                        <div class="left-contents float-left mr-3 mt-2 mb-2">
                                            <a class="text-decoration-none text-danger" href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}?">
                                                @if ($shop->image_path)
                                                    <img class="img-thumbnail" src="{{ asset('storage/image/' . $shop->image_path) }}">
                                                @else
                                                    <img class="img-thumbnail" src="{{ asset('storage/' . 'no_image.jpg') }}">                                                    
                                                @endif
                                            </a>
                                        </div>

                                        <div class="right-contents clearfix mt-2">
                                            <div>
                                                @if ($shop->avg_points)
                                                    <span class="points lead font-weight-bold">{{ $shop->avg_points }}点</span>
                                                @else
                                                    <span class="points lead font-weight-bold">-------点</span>
                                                @endif
                                            </div>
                                            <div>
                                                <a class="text-decoration-none text-danger" href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}?">
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{ Form::hidden('counter', $counter++) }}
                        @endforeach
                        <div class="d-flex align-items-center justify-content-center mt-3">
                            {{-- ペジネーション結果の表示 --}}
                            {{-- {{ $shops->links() }} --}}
                            {{ $shops -> appends(['disp' => $disp, 'preflist' => $pref_id, 'city' => $city, 'types' => $params['types']]) -> links() }}
                        </div>

                        <div class="meet">
                            表示件数：
                            {{ Form::open(['url' => '/ranking', 'method' => 'get']) }}
                                {{ Form::select('disp', ['10' => '10', '20' => '20', '50' => '50', '100' => '100'], $disp, ['class' => 'disp', 'id' => 'disp', 'onchange' => 'submit();']) }}
                                {{ Form::hidden('preflist', $pref_id) }}
                                {{ Form::hidden('city', $city, ['id' => 'city_id']) }}
                                {{-- {{ Form::hidden('counter', $counter) }} --}}
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
