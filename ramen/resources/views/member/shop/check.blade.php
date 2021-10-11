{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '店舗登録確認 - ラーメンresearch')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.Shop_Entry_Check') }}</div>

                <div class="card-body">
                    <form action="{{ url('/member/shop/create') }}" method="POST">
                        @csrf

                        {{-- 店名 --}}
                        <div class="form-group row">
                            <label for="shop_name" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name') }}</label>

                            <div class="col-md-6">
                                <span>{{ $shop_name }}</span>
                            </div>
                        </div>

                        {{-- 店名（ふりがな） --}}
                        <div class="form-group row">
                            <label for="shop_name_kana" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name_Kana') }}</label>

                            <div class="col-md-6">
                                <span>{{ $shop_name_kana }}</span>
                            </div>
                        </div>

                        {{-- 支店名フォーム --}}                        
                        <div class="form-group row">
                            <label for="branch" class="col-md-3 col-form-label text-md-right">{{ __('messages.Branch') }}</label>

                            <div class="col-md-6">
                                <span>{{ $branch }}</span>
                            </div>
                        </div>

                        {{-- 郵便番号フォーム --}}
                        <div class="form-group row">
                            <label for="postcode" class="col-md-3 col-form-label text-md-right">{{ __('messages.Post_Code') }}</label>

                            <div class="col-md-2">
                                <span>{{ $address1 }}</span>
                            </div>
                        </div>

                        {{-- 住所１フォーム --}}
                        <div class="form-group row">
                            <label for="address1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address1') }}</label>
                            
                            <div class="col-md-6">
                                <span>{{ $address2 }}</span>
                            </div>
                        </div>

                        {{-- 住所２フォーム --}}
                        <div class="form-group row">
                            <label for="address2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address2') }}</label>
                            
                            <div class="col-md-6">
                                <span>{{ $address3}}</span>
                            </div>
                        </div>

                        {{-- 住所３フォーム --}}
                        <div class="form-group row">
                            <label for="address3" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address3') }}</label>
                            
                            <div class="col-md-6">
                                <span>{{ $address4 }}</span>
                            </div>
                        </div>

                        {{-- 地図表示 --}}
                        <div class="map-container">
                            <div class="map_wrapper">
                                <div id="map" class="map" style="width: 600px; height: 500px;"></div>
                            </div>
                        </div>

                        <script>
                            function initMap() {
                                var target = document.getElementById('map'); //マップを表示する要素を指定
                                var address = '東京都新宿区西新宿2-8-1'; //住所を指定
                                var geocoder = new google.maps.Geocoder();  
                            
                                geocoder.geocode({ address: address }, function(results, status){
                                  
                                    if (status === 'OK' && results[0]){
                            
                                        console.log(results[0].geometry.location);
                                        var latlng = results[0].geometry.location;
                                
                                        var map = new google.maps.Map(target, {  
                                            center: results[0].geometry.location,
                                            zoom: 18
                                        });
                            
                                        var marker = new google.maps.Marker({
                                            position: results[0].geometry.location,
                                            map: map,
                                            animation: google.maps.Animation.DROP
                                        });

                                    }else{ 
                                        //住所が存在しない場合の処理
                                        alert('住所が正しくないか存在しません。');
                                        target.style.display='none';
                                    }
                                });
                            }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'default') }}&callback=initMap" async defer></script>

                        {{-- 電話番号１フォーム --}}
                        <div class="form-group row">
                            <label for="phone_number1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number1') }}</label>
                            
                            <div class="col-md-3">
                                <span>{{ $phone_number1 }}</span>
                            </div>
                        </div>

                        {{-- 電話番号２フォーム --}}
                        <div class="form-group row">
                            <label for="phone_number2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number2') }}</label>
                            
                            <div class="col-md-3">
                                <span>{{ $phone_number2 }}</span>
                            </div>
                        </div>

                        {{-- 営業時間１フォーム --}}
                        <div class="form-group row">
                            <label for="opening_hour1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour1') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $opening_hour1 }}</span>
                            </div>
                        </div>

                        {{-- 営業時間２フォーム --}}
                        <div class="form-group row">
                            <label for="opening_hour2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour2') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $opening_hour2 }}</span>
                            </div>
                        </div>

                        {{-- 定休日フォーム --}}
                        <div class="form-group row">
                            <label for="holiday" class="col-md-3 col-form-label text-md-right">{{ __('messages.Holiday') }}</label>
                            
                            <div class="col-md-4">
                                <span>{{ $holiday }}</span>
                            </div>
                        </div>

                        {{-- 座席数フォーム --}}
                        <div class="form-group row">
                            <label for="seats" class="col-md-3 col-form-label text-md-right">{{ __('messages.Seats') }}</label>
                            
                            <div class="col-md-4">
                                <span>{{ $seats }}</span>
                            </div>
                        </div>

                        {{-- アクセスフォーム --}}
                        <div class="form-group row">
                            <label for="access" class="col-md-3 col-form-label text-md-right">{{ __('messages.Access') }}</label>
                            
                            <div class="col-md-9">
                                <span>{{ $access }}</span>
                            </div>
                        </div>

                        {{-- 駐車場フォーム --}}
                        <div class="form-group row">
                            <label for="parking" class="col-md-3 col-form-label text-md-right">{{ __('messages.Parking') }}</label>
                            
                            <div class="col-md-4">
                                <span>{{ $parking }}</span>
                            </div>
                        </div>

                        {{-- 公式サイトフォーム --}}
                        <div class="form-group row">
                            <label for="official_site" class="col-md-3 col-form-label text-md-right">{{ __('messages.Official_Site') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $official_site }}</span>
                            </div>
                        </div>

                        {{-- 公式ブログフォーム --}}
                        <div class="form-group row">
                            <label for="official_blog" class="col-md-3 col-form-label text-md-right">{{ __('messages.Official_Blog') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $official_blog }}</span>
                            </div>
                        </div>

                        {{-- Facebooページフォーム --}}
                        <div class="form-group row">
                            <label for="facebook" class="col-md-3 col-form-label text-md-right">{{ __('messages.Facebook') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $facebook }}</span>
                            </div>
                        </div>

                        {{-- Twitter IDフォーム --}}
                        <div class="form-group row">
                            <label for="twitter" class="col-md-3 col-form-label text-md-right">{{ __('messages.Twitter') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $twitter }}</span>
                            </div>
                        </div>

                        {{-- お店のタイプフォーム --}}
                        <div class="form-group row">
                            <label for="shop_type" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Type') }}</label>
                            
                            <div class="col-md-9">
                                <span>{{ $shop_type }}</span>
                            </div>
                        </div>

                        {{-- 開店日フォーム --}}
                        <div class="form-group row">
                            <label for="opening_date" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Date') }}</label>
                            
                            <div class="col-md-3">
                                <span>{{ $opening_date }}</span>
                            </div>
                        </div>

                        {{-- メニューフォーム --}}
                        <div class="form-group row">
                            <label for="menu" class="col-md-3 col-form-label text-md-right">{{ __('messages.Menu') }}</label>
                            
                            <div class="col-md-9">
                                <span>{{ $menu }}</span>
                            </div>
                        </div>

                        {{-- 備考フォーム --}}
                        <div class="form-group row">
                            <label for="notes" class="col-md-3 col-form-label text-md-right">{{ __('messages.Notes') }}</label>
                            
                            <div class="col-md-9">
                                <span>{{ $notes }}</span>
                            </div>
                        </div>

                        {{-- タグフォーム --}}
                        <div class="form-group row">
                            <label for="tags" class="col-md-3 col-form-label text-md-right">{{ __('messages.Tags') }}</label>
                            
                            <div class="col-md-6">
                                <span>{{ $tags }}</span>
                            </div>
                        </div>

                        {{-- 登録ボタン --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.Entry') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">                   
                    <form action="{{ url('/member/shop/entry') }}" method="GET">
                        {{-- 修正ボタン --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('messages.Fix') }}
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
