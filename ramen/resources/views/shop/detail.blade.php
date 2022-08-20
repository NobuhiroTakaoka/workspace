{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に'検索 - ラーメンresearch'を埋め込む --}}
@section('title', '検索 - ラーメンresearch')


@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.Title') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('search') }}">{{ __('messages.Shop_Search') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Shop_Detail') }}</li>
            </ol>
        </nav>

        {{-- 店名 --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="shop_name" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Shop_Name_D') }}</label>

            <div class="col-md-6 d-flex align-items-center">
                <span>{{ $shop_detail->shop_name }}</span>
            </div>
        </div>

        {{-- 支店名 --}}                        
        <div class="form-group row rounded border border-warning mx-5">
            <label for="branch" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Branch') }}</label>

            <div class="col-md-6 d-flex align-items-center">
                <span>{{ $shop_detail->branch }}</span>
            </div>
        </div>

        {{-- 郵便番号 --}}
        {{-- <div class="form-group row">
            <label for="postcode" class="col-md-3 col-form-label text-md-right">{{ __('messages.Post_Code') }}</label>

            <div class="col-md-2 d-flex align-items-center">
                <span>{{ $shop_detail->postcode }}</span>
            </div>
        </div> --}}

        {{-- 住所 --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="address" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Address') }}</label>
            
            <div class="col-md-6 d-flex align-items-center">
                <span>
                    {{ $shop_detail->address1 }}&nbsp
                    {{ $shop_detail->address2 }}&nbsp
                    {{ $shop_detail->address3 }}&nbsp
                    {{ $shop_detail->address4 }}
                </span>
            </div>
        </div>

        {{-- 住所２ --}}
        {{-- <div class="form-group row">
            <label for="address2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address2') }}</label>
            
            <div class="col-md-6 d-flex align-items-center">
                <span>{{ $shop_detail->address2 }}</span>
            </div>
        </div> --}}

        {{-- 住所３ --}}
        {{-- <div class="form-group row">
            <label for="address3" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address3') }}</label>
            
            <div class="col-md-6 d-flex align-items-center">
                <span>{{ $shop_detail->address3 }}</span>
            </div>
        </div> --}}

        {{-- 住所４ --}}
        {{-- <div class="form-group row">
            <label for="address4" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address4') }}</label>
            
            <div class="col-md-6 d-flex align-items-center">
                <span>{{ $shop_detail->address4 }}</span>
            </div>
        </div> --}}

        {{-- 地図の緯度（表示しない） --}}
        <div class="form-group row mx-5">                            
            <div class="col-md-6 d-flex align-items-center">
                <input id="map_lat" type="hidden" class="form-control" name="map_lat" value="{{ $shop_detail->map_lat }}">
            </div>
        </div>

        {{-- 地図の経度（表示しない） --}}
        <div class="form-group row mx-5">                            
            <div class="col-md-6 d-flex align-items-center">
                <input id="map_long" type="hidden" class="form-control" name="map_long" value="{{ $shop_detail->map_long }}">
            </div>
        </div>

        {{-- 地図表示（緯度・経度） --}}
        <div class="map-container form-group row rounded border border-warning mx-5">
            <label for="map" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Map') }}</label>

            <div class="map_wrapper col-md-9 d-flex align-items-center">
                <div id="map" class="map" style="width: 550px; height: 460px;"></div>
                <script>
                    function initMap() {
                        var target = document.getElementById('map');
                        var lat = document.getElementById('map_lat').value;
                        var long = document.getElementById('map_long').value;
                        var position = {lat: Number(lat), lng: Number(long)};
                        var map = new google.maps.Map(target, {
                            center: position,
                            zoom: 14
                        });

                        var marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            // animation: google.maps.Animation.DROP
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'default') }}&callback=initMap" async defer></script>            
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="phone_number" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Phone_Number') }}</label>
            
            <div class="col-md-3 d-flex align-items-center">
                <span>{{ $shop_detail->phone_number1 }}</span>&nbsp&nbsp
                <span>{{ $shop_detail->phone_number2 }}</span>
            </div>
        </div>

        {{-- 電話番号２ --}}
        {{-- <div class="form-group row">
            <label for="phone_number2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number2') }}</label>
            
            <div class="col-md-3 d-flex align-items-center">
                <span>{{ $shop_detail->phone_number2 }}</span>
            </div>
        </div> --}}

        {{-- 営業時間１ --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="opening_hour" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Opening_Hour') }}</label>
            
            <div class="col-md-5 d-flex align-items-center">
                <span>{{ $shop_detail->opening_hour1 }}</span>&nbsp&nbsp
                <span>{{ $shop_detail->opening_hour2 }}</span>
            </div>
        </div>

        {{-- 営業時間２ --}}
        {{-- <div class="form-group row">
            <label for="opening_hour2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour2') }}</label>
            
            <div class="col-md-5 d-flex align-items-center">
                <span>{{ $shop_detail->opening_hour2 }}</span>
            </div>
        </div> --}}

        {{-- 定休日 --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="holiday" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Holiday_D') }}</label>
            
            <div class="col-md-4 d-flex align-items-center">
                <span>{{ $shop_detail->holiday }}</span>
            </div>
        </div>

        {{-- 座席数 --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="seats" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Seats_D') }}</label>
            
            <div class="col-md-4 d-flex align-items-center">
                <span>{{ $shop_detail->seats }}</span>
            </div>
        </div>

        {{-- アクセス --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="access" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Access_D') }}</label>
            
            <div class="col-md-9 d-flex align-items-center">
                <span>{{ $shop_detail->access }}</span>
            </div>
        </div>

        {{-- 駐車場 --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="parking" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Parking_D') }}</label>
            
            <div class="col-md-4 d-flex align-items-center">
                <span>{{ $shop_detail->parking }}</span>
            </div>
        </div>

        {{-- 公式サイト --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="official_site" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Official_Site') }}</label>
            
            <div class="col-md-5 d-flex align-items-center">
                <span>{{ $shop_detail->official_site }}</span>
            </div>
        </div>

        {{-- 公式ブログ--}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="official_blog" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Official_Blog') }}</label>
            
            <div class="col-md-5 d-flex align-items-center">
                <span>{{ $shop_detail->official_blog }}</span>
            </div>
        </div>

        {{-- Facebooページ --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="facebook" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Facebook') }}</label>
            
            <div class="col-md-5 d-flex align-items-center">
                <span>{{ $shop_detail->facebook }}</span>
            </div>
        </div>

        {{-- Twitter ID --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="twitter" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Twitter') }}</label>
            
            <div class="col-md-5 d-flex align-items-center">
                <span>{{ $shop_detail->twitter }}</span>
            </div>
        </div>

        {{-- お店のタイプ --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="shop_type" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Shop_Type_D') }}</label>
            
            <div class="col-md-9 d-flex align-items-center">
                <span>{{ $shop_detail->shop_type }}</span>
            </div>
        </div>

        {{-- 開店日 --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="opening_date" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Opening_Date') }}</label>
            
            <div class="col-md-3 d-flex align-items-center">
                <span>{{ $shop_detail->opening_date }}</span>
            </div>
        </div>

        {{-- メニュー --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="menu" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Menu_D') }}</label>
            
            <div class="col-md-9 d-flex align-items-center">
                <span>{{ $shop_detail->menu }}</span>
            </div>
        </div>

        {{-- 備考 --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="notes" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Notes') }}</label>
            
            <div class="col-md-9 d-flex align-items-center">
                <span>{{ $shop_detail->notes }}</span>
            </div>
        </div>

        {{-- タグ --}}
        <div class="form-group row rounded border border-warning mx-5">
            <label for="tags" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Tags') }}</label>
            
            <div class="col-md-9 d-flex align-items-center row">
                @foreach ($shop_tags as $shop_tag)
                    @if (isset($tags_category[$shop_tag->tag_id]))                  
                        <div class="ml-3">
                            {{ $tags_category[$shop_tag->tag_id] }}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="review d-grid gap-2 col-8 mx-auto row">
            <form action="{{ route('shop.edit', ['shop_id' => $shop_id]) }}" method="GET">
                <div class="float-left m-3">
                    {{ csrf_field() }}
                    {{-- <input id="shop_id" type="hidden" class="form-control" name="shop_id" value="{{ $shop_id }}"> --}}
                    <button type="submit" class="btn btn-secondary" name="shop_edit">
                        {{ __('messages.Shop_Modify') }}
                    </button>
                </div>
            </form>
            <form action="{{ route('review_post', ['shop_id' => $shop_id]) }}" method="GET">
                <div class="float-left m-3">
                    {{ csrf_field() }}
                    <input id="shop_name" type="hidden" class="form-control" name="shop_name" value="{{ $shop_detail->shop_name }}">
                    <input id="branch" type="hidden" class="form-control" name="branch" value="{{ $shop_detail->branch }}">
                    <button type="submit" class="btn btn-success" name="review_post">
                        {{ __('messages.Review_Post') }}
                    </button>
                </div>
            </form>
            <form action="{{ route('shop.review_list', ['shop_id' => $shop_id]) }}" method="GET">
                <div class="float-left m-3">
                    {{ csrf_field() }}
                    <input id="shop_name" type="hidden" class="form-control" name="shop_name" value="{{ $shop_detail->shop_name }}">
                    <input id="branch" type="hidden" class="form-control" name="branch" value="{{ $shop_detail->branch }}">
                    <button type="submit" class="btn btn-primary" name="review_refer">
                        {{ __('messages.Review_Refer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
