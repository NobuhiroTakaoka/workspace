{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '店舗登録 - ラーメンresearch')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Entry') }}</div>

                    <div class="card-body">
                        <form action="{{ url('/member/shop/check') }}" class="h-adr" method="GET">
                            @csrf

                            {{-- 店名フォーム --}}
                            <div class="form-group row">
                                <label for="shop_name" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name') }}</label>

                                <div class="col-md-6">
                                    {{-- <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" required value="{{ old('shop_name') }}" autofocus> --}}
                                    <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" required value="{{ $form["shop_name"] }}" autofocus>

                                    @error('shop_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 店名（ふりがな）フォーム --}}
                            <div class="form-group row">
                                <label for="shop_name_kana" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name_Kana') }}</label>

                                <div class="col-md-6">
                                    {{-- <input id="shop_name_kana" type="text" class="form-control @error('shop_name_kana') is-invalid @enderror" name="shop_name_kana" value="{{ old('shop_name_kana') }}"> --}}

                                    <input id="shop_name_kana" type="text" class="form-control @error('shop_name_kana') is-invalid @enderror" name="shop_name_kana" value="{{ $form["shop_name_kana"] }}">

                                    @error('shop_name_kana')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 支店名フォーム --}}                        
                            <div class="form-group row">
                                <label for="branch" class="col-md-3 col-form-label text-md-right">{{ __('messages.Branch') }}</label>

                                <div class="col-md-6">
                                    {{-- <input id="branch" type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" value="{{ old('branch') }}"> --}}
                                    <input id="branch" type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" value="{{ $form["branch"] }}">

                                    @error('branch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 郵便番号フォーム --}}
                            <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
                            <span class="p-country-name" style="display:none;">Japan</span>
                            <div class="form-group row">
                                <label for="postcode" class="col-md-3 col-form-label text-md-right">{{ __('messages.Post_Code') }}</label>

                                <div class="col-md-2 p-postal-code">
                                    {{-- <input id="postcode" type="text" class="form-control p-postal-code @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" maxlength="7"> --}}
                                    {{-- <input id="address1" type="text" class="form-control p-postal-code @error('address1') is-invalid @enderror" name="address1" value="{{ old('address1') }}" maxlength="7"> --}}
                                    <input id="postcode" type="text" class="form-control p-postal-code @error('postcode') is-invalid @enderror" name="postcode" value="{{ $form["postcode"] }}" maxlength="7">
    
                                    @error('postcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 住所１フォーム --}}
                            <div class="form-group row">
                                <label for="address1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address1') }}</label>
                                
                                <div class="col-md-6">
                                    {{-- <input id="address1" type="text" class="form-control p-region @error('address1') is-invalid @enderror" name="address1" value="{{ old('address1') }}"> --}}
                                    <input id="address1" type="text" class="form-control p-region @error('address1') is-invalid @enderror" name="address1" value="{{ $form["address1"] }}">

                                    @error('address1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 住所２フォーム --}}
                            <div class="form-group row">
                                <label for="address2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address2') }}</label>
                                
                                <div class="col-md-6">
                                    {{-- <input id="address2" type="text" class="form-control p-locality @error('address2') is-invalid @enderror" name="address2" value="{{ old('address2') }}"> --}}
                                    <input id="address2" type="text" class="form-control p-locality @error('address2') is-invalid @enderror" name="address2" value="{{ $form["address2"] }}">
    
                                    @error('address2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 住所３フォーム --}}
                            <div class="form-group row">
                                <label for="address3" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address3') }}</label>
                                
                                <div class="col-md-6">
                                    {{-- <input id="address3" type="text" class="form-control p-street-address @error('address3') is-invalid @enderror" name="address3" value="{{ old('address3') }}"> --}}
                                    <input id="address3" type="text" class="form-control p-street-address @error('address3') is-invalid @enderror" name="address3" value="{{ $form["address3"] }}">

                                    @error('address3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 住所４フォーム --}}
                            <div class="form-group row">
                                <label for="address4" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address4') }}</label>
                                
                                <div class="col-md-6">
                                    {{-- <input id="address4" type="text" class="form-control p-extended-address @error('address4') is-invalid @enderror" name="address4" value="{{ old('address4') }}"> --}}
                                    <input id="address4" type="text" class="form-control p-extended-address @error('address4') is-invalid @enderror" name="address4" value="{{ $form["address4"] }}">

                                    @error('address4')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 地図表示 --}}
                            {{-- <div class="map-container">
                                <div class="map_wrapper">
                                    <div id="map" class="map" style="width: 600px; height: 500px;"></div>
                                </div>
                            </div> --}}

                            {{-- 地図の緯度フォーム（表示しない） --}}
                            <div class="form-group row">
                                {{-- <label for="lat" class="col-md-3 col-form-label text-md-right">{{ __('messages.Lat') }}</label> --}}
                                
                                <div class="col-md-6">
                                    {{-- <input id="lat" type="hidden" class="form-control @error('lat') is-invalid @enderror" name="lat" value="{{ old('lat') }}"> --}}
                                    {{-- <input id="map_lat" type="hidden" class="form-control" name="map_lat" value="{{ old('map_lat') }}"> --}}
                                    {{-- <input id="map_lat" type="text" class="form-control" name="map_lat" value="{{ $form["map_lat"] }}"> --}}
                                    <input id="map_lat" type="hidden" class="form-control" name="map_lat" value="{{ $form["map_lat"] }}">

                                    {{-- @error('lat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>

                            {{-- 地図の経度フォーム（表示しない） --}}
                            <div class="form-group row">
                                <div class="col-md-6">
                                    {{-- <input id="map_long" type="hidden" class="form-control" name="map_long" value="{{ old('map_long') }}"> --}}
                                    <input id="map_long" type="hidden" class="form-control" name="map_long" value="{{ $form["map_long"] }}">
                                </div>
                            </div>

                            <script>
                                function initMap() {
                                    // var target = document.getElementById('map'); //マップを表示する要素を指定
                                    // var target = document.getElementById('map'); //マップを表示する要素を指定
                                    // var address = '東京都新宿区西新宿2-8-1'; //住所を指定
                                    var address1 = document.getElementById('address1').value; //住所１の入力内容を取得
                                    var address2 = document.getElementById('address2').value; //住所２の入力内容を取得
                                    var address3 = document.getElementById('address3').value; //住所３の入力内容を取得
                                    var address4 = document.getElementById('address4').value; //住所４の入力内容を取得
                                    var address = address1 + address2 + address3 + address4; //住所１～４を結合 

                                    var geocoder = new google.maps.Geocoder();  
                                
                                    geocoder.geocode({ address: address }, function(results, status){
                                    
                                        if (status === 'OK' && results[0]){
                                            
                                            console.log(results[0].geometry.location);
                                            var latlng = results[0].geometry.location; //LatLngインスタンスを変数に格納
                                            var lat = latlng.lat(); //メソッドで緯度を取得し、変数に格納
                                            var long = latlng.lng(); // メソッドで経度を取得し、変数に格納
                                            document.getElementById('map_lat').value = lat ;
                                            document.getElementById('map_long').value = long ;
                                            
                                            // var map = new google.maps.Map(target, {  
                                            //     center: results[0].geometry.location,
                                            //     zoom: 18
                                            // });
                                
                                            // var marker = new google.maps.Marker({
                                            //     position: results[0].geometry.location,
                                            //     map: map,
                                            //     animation: google.maps.Animation.DROP
                                            // });

                                        // }else{ 
                                            //住所が存在しない場合の処理
                                            // alert('住所が正しくないか存在しません。');
                                            // target.style.display='none';
                                        }
                                    });
                                }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'default') }}&callback=initMap" async defer></script>

                            {{-- 電話番号１フォーム --}}
                            <div class="form-group row">
                                <label for="phone_number1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number1') }}</label>
                                
                                <div class="col-md-3">
                                    {{-- <input id="phone_number1" type="text" class="form-control @error('phone_number1') is-invalid @enderror" name="phone_number1" value="{{ old('phone_number1') }}" maxlength="11"> --}}
                                    <input id="phone_number1" type="text" class="form-control @error('phone_number1') is-invalid @enderror" name="phone_number1" value="{{ $form["phone_number1"] }}" maxlength="11">
                                
                                    @error('phone_number1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 電話番号２フォーム --}}
                            <div class="form-group row">
                                <label for="phone_number2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number2') }}</label>
                                
                                <div class="col-md-3">
                                    {{-- <input id="phone_number2" type="text" class="form-control @error('phone_number2') is-invalid @enderror" name="phone_number2" value="{{ old('phone_number2') }}" maxlength="11"> --}}
                                    <input id="phone_number2" type="text" class="form-control @error('phone_number2') is-invalid @enderror" name="phone_number2" value="{{ $form["phone_number2"] }}" maxlength="11">
                            
                                    @error('phone_number2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 営業時間１フォーム --}}
                            <div class="form-group row">
                                <label for="opening_hour1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour1') }}</label>
                                
                                <div class="col-md-5">
                                    {{-- <input id="opening_hour1" type="text" class="form-control @error('opening_hour1') is-invalid @enderror" name="opening_hour1" value="{{ old('opening_hour1') }}"> --}}
                                    <input id="opening_hour1" type="text" class="form-control @error('opening_hour1') is-invalid @enderror" name="opening_hour1" value="{{ $form["opening_hour1"] }}">
                            
                                    @error('opening_hour1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 営業時間２フォーム --}}
                            <div class="form-group row">
                                <label for="opening_hour2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour2') }}</label>
                                
                                <div class="col-md-5">
                                    {{-- <input id="opening_hour2" type="text" class="form-control @error('opening_hour2') is-invalid @enderror" name="opening_hour2" value="{{ old('opening_hour2') }}"> --}}
                                    <input id="opening_hour2" type="text" class="form-control @error('opening_hour2') is-invalid @enderror" name="opening_hour2" value="{{ $form["opening_hour2"] }}">
                            
                                    @error('opening_hour2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 定休日フォーム --}}
                            <div class="form-group row">
                                <label for="holiday" class="col-md-3 col-form-label text-md-right">{{ __('messages.Holiday') }}</label>
                                
                                <div class="col-md-4">
                                    {{-- <input id="holiday" type="text" class="form-control @error('holiday') is-invalid @enderror" name="holiday" value="{{ old('holiday') }}"> --}}
                                    <input id="holiday" type="text" class="form-control @error('holiday') is-invalid @enderror" name="holiday" value="{{ $form["holiday"] }}">
                            
                                    @error('holiday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 座席数フォーム --}}
                            <div class="form-group row">
                                <label for="seats" class="col-md-3 col-form-label text-md-right">{{ __('messages.Seats') }}</label>
                                
                                <div class="col-md-4">
                                    {{-- <input id="seats" type="text" class="form-control @error('seats') is-invalid @enderror" name="seats" value="{{ old('seats') }}"> --}}
                                    <input id="seats" type="text" class="form-control @error('seats') is-invalid @enderror" name="seats" value="{{ $form["seats"] }}">
                                
                                    @error('seats')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- アクセスフォーム --}}
                            <div class="form-group row">
                                <label for="access" class="col-md-3 col-form-label text-md-right">{{ __('messages.Access') }}</label>
                                
                                <div class="col-md-9">
                                    {{-- <input id="access" type="text" class="form-control @error('access') is-invalid @enderror" name="access" value="{{ old('access') }}"> --}}
                                    <input id="access" type="text" class="form-control @error('access') is-invalid @enderror" name="access" value="{{ $form["access"] }}">
                                    
                                    @error('access')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 駐車場フォーム --}}
                            <div class="form-group row">
                                <label for="parking" class="col-md-3 col-form-label text-md-right">{{ __('messages.Parking') }}</label>
                                
                                <div class="col-md-4">
                                    {{-- <input id="parking" type="text" class="form-control @error('parking') is-invalid @enderror" name="parking" value="{{ old('parking') }}"> --}}
                                    <input id="parking" type="text" class="form-control @error('parking') is-invalid @enderror" name="parking" value="{{ $form["parking"] }}">
                                
                                    @error('parking')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 公式サイトフォーム --}}
                            <div class="form-group row">
                                <label for="official_site" class="col-md-3 col-form-label text-md-right">{{ __('messages.Official_Site') }}</label>
                                
                                <div class="col-md-5">
                                    {{-- <input id="official_site" type="text" class="form-control @error('official_site') is-invalid @enderror" name="official_site" value="{{ old('official_site') }}"> --}}
                                    <input id="official_site" type="text" class="form-control @error('official_site') is-invalid @enderror" name="official_site" value="{{ $form["official_site"] }}">
                                
                                    @error('official_site')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 公式ブログフォーム --}}
                            <div class="form-group row">
                                <label for="official_blog" class="col-md-3 col-form-label text-md-right">{{ __('messages.Official_Blog') }}</label>
                                
                                <div class="col-md-5">
                                    {{-- <input id="official_blog" type="text" class="form-control @error('official_blog') is-invalid @enderror" name="official_blog" value="{{ old('official_blog') }}"> --}}
                                    <input id="official_blog" type="text" class="form-control @error('official_blog') is-invalid @enderror" name="official_blog" value="{{ $form["official_blog"] }}">
                                
                                    @error('official_blog')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Facebooページフォーム --}}
                            <div class="form-group row">
                                <label for="facebook" class="col-md-3 col-form-label text-md-right">{{ __('messages.Facebook') }}</label>
                                
                                <div class="col-md-5">
                                    {{-- <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook') }}"> --}}
                                    <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $form["facebook"] }}">
                                
                                    @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Twitter IDフォーム --}}
                            <div class="form-group row">
                                <label for="twitter" class="col-md-3 col-form-label text-md-right">{{ __('messages.Twitter') }}</label>
                                
                                <div class="col-md-5">
                                    {{-- <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ old('twitter') }}"> --}}
                                    <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ $form["twitter"] }}">
                                
                                    @error('twitter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- お店のタイプフォーム --}}
                            <div class="form-group row">
                                <label for="shop_type" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Type') }}</label>
                                
                                <div class="col-md-9">
                                    {{-- Laravel CollectiveのFormファサード使用 --}}
                                    @foreach ($shop_types as $shop_type)
                                        {{-- {{ Form::radio('shop_type', $shop_type, false, ['value'=>old('shop_type')]) }} --}}
                                        {{-- @if ($key == $form["shop_type"]) --}}
                                        @if ($shop_type == $form["shop_type"])
                                            {{-- {{ Form::radio('shop_type', $shop_type, true, ['value'=>$form["shop_type"]]) }} --}} 
                                            {{-- {{ Form::radio('shop_type', $shop_type, true, ['id'=>'shop_type','class'=>'form-control @error('shop_type') is-invalid @enderror']) }} --}}
                                            {{ Form::radio('shop_type', $shop_type, true) }}
                                        @else
                                            {{-- {{ Form::radio('shop_type', $shop_type, false, ['value'=>$form["shop_type"]]) }} --}}
                                            {{-- {{ Form::radio('shop_type', $shop_type, false, ['id'=>'shop_type','class'=>'form-control @error('shop_type') is-invalid @enderror']) }} --}}
                                            {{ Form::radio('shop_type', $shop_type, false) }}
                                        @endif

                                        {{-- @error('shop_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}

                                        {{ Form::label($shop_type, $shop_type) }}
                                    @endforeach

                                    {{-- @error('shop_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>

                            {{-- 開店日フォーム --}}
                            <div class="form-group row">
                                <label for="opening_date" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Date') }}</label>
                                
                                <div class="col-md-3">
                                    {{-- <input id="opening_date" type="text" class="form-control @error('opening_date') is-invalid @enderror" name="opening_date" value="{{ old('opening_date') }}"> --}}
                                    <input id="opening_date" type="text" class="form-control @error('opening_date') is-invalid @enderror" name="opening_date" value="{{ $form["opening_date"] }}">
                                
                                    @error('opening_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- メニューフォーム --}}
                            <div class="form-group row">
                                <label for="menu" class="col-md-3 col-form-label text-md-right">{{ __('messages.Menu') }}</label>
                                
                                <div class="col-md-9">
                                    {{-- <input id="menu" type="text" class="form-control @error('menu') is-invalid @enderror" name="menu" value="{{ old('menu') }}"> --}}
                                    <input id="menu" type="text" class="form-control @error('menu') is-invalid @enderror" name="menu" value="{{ $form["menu"] }}">
                                    
                                    @error('menu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 備考フォーム --}}
                            <div class="form-group row">
                                <label for="notes" class="col-md-3 col-form-label text-md-right">{{ __('messages.Notes') }}</label>
                                
                                <div class="col-md-9">
                                    {{-- <input id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}"> --}}
                                    <input id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ $form["notes"] }}">
                            
                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- タグフォーム --}}
                            <div class="form-group row">
                                <label for="tags" class="col-md-3 col-form-label text-md-right">{{ __('messages.Tags') }}</label>
                                
                                <div class="col-md-6">
                                    {{-- <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags') }}"> --}}
                                    <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ $form["tags"] }}">
                            
                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 次へボタン（確認画面へ） --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" onClick="initMap()" name="finput">
                                        {{ __('messages.Next') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
