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
                                <span>{{ $form["shop_name"] }}</span>
                                <input id="shop_name" type="hidden" class="form-control" name="shop_name" required value="{{ $form["shop_name"] }}">
                            </div>
                        </div>

                        {{-- 店名（ふりがな） --}}
                        <div class="form-group row">
                            <label for="shop_name_kana" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name_Kana') }}</label>

                            <div class="col-md-6">
                                <span>{{ $form["shop_name_kana"] }}</span>
                                <input id="shop_name_kana" type="hidden" class="form-control" name="shop_name_kana" required value="{{ $form["shop_name_kana"] }}">
                            </div>
                        </div>

                        {{-- 支店名 --}}                        
                        <div class="form-group row">
                            <label for="branch" class="col-md-3 col-form-label text-md-right">{{ __('messages.Branch') }}</label>

                            <div class="col-md-6">
                                <span>{{ $form["branch"] }}</span>
                                <input id="branch" type="hidden" class="form-control" name="branch" required value="{{ $form["branch"] }}">
                            </div>
                        </div>

                        {{-- 郵便番号 --}}
                        <div class="form-group row">
                            <label for="postcode" class="col-md-3 col-form-label text-md-right">{{ __('messages.Post_Code') }}</label>

                            <div class="col-md-2">
                                <span>{{ $form["address1"] }}</span>
                                <input id="address1" type="hidden" class="form-control" name="address1" required value="{{ $form["address1"] }}">
                            </div>
                        </div>

                        {{-- 住所１ --}}
                        <div class="form-group row">
                            <label for="address1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address1') }}</label>
                            
                            <div class="col-md-6">
                                <span id="address2">{{ $form["address2"] }}</span>
                                <input id="address2" type="hidden" class="form-control" name="address2" required value="{{ $form["address2"] }}">
                            </div>
                        </div>

                        {{-- 住所２ --}}
                        <div class="form-group row">
                            <label for="address2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address2') }}</label>
                            
                            <div class="col-md-6">
                                <span>{{ $form["address3"] }}</span>
                                <input id="address3" type="hidden" class="form-control" name="address3" required value="{{ $form["address3"] }}">
                            </div>
                        </div>

                        {{-- 住所３ --}}
                        <div class="form-group row">
                            <label for="address3" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address3') }}</label>
                            
                            <div class="col-md-6">
                                <span>{{ $form["address4"] }}</span>
                                <input id="address4" type="hidden" class="form-control" name="address4" required value="{{ $form["address4"] }}">
                            </div>
                        </div>

                        {{-- 地図の緯度（表示しない） --}}
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <input id="map_lat" type="hidden" class="form-control" name="map_lat" required value="{{ $form["map_lat"] }}">
                            </div>
                        </div>

                        {{-- 地図の経度（表示しない） --}}
                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <input id="map_long" type="hidden" class="form-control" name="map_long" required value="{{ $form["map_long"] }}">
                            </div>
                        </div>

                        {{-- 地図表示（緯度・経度） --}}
                        <div class="map-container">
                            <div class="map_wrapper">
                                <div id="map" class="map" style="width: 600px; height: 500px;"></div>
                                {{-- <input id="lat" type="hidden" class="form-control" name="lat" required value="{{ $form["lat"] }}">
                                <input id="long" type="hidden" class="form-control" name="long" required value="{{ $form["long"] }}"> --}}
                            </div>
                        </div>

                        {{-- 地図表示 --}}
                        <script>
                            function initMap() {
                                var target = document.getElementById('map'); //マップを表示する要素を指定
                                // var address = '東京都新宿区西新宿2-8-1'; //住所を指定
                                var address = document.getElementById('address2').innerHTML; //住所１の内容を取得

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
                                <span>{{ $form["phone_number1"] }}</span>
                                <input id="phone_number1" type="hidden" class="form-control" name="phone_number1" required value="{{ $form["phone_number1"] }}">
                            </div>
                        </div>

                        {{-- 電話番号２フォーム --}}
                        <div class="form-group row">
                            <label for="phone_number2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number2') }}</label>
                            
                            <div class="col-md-3">
                                <span>{{ $form["phone_number2"] }}</span>
                                <input id="phone_number2" type="hidden" class="form-control" name="phone_number2" required value="{{ $form["phone_number2"] }}">
                            </div>
                        </div>

                        {{-- 営業時間１フォーム --}}
                        <div class="form-group row">
                            <label for="opening_hour1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour1') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $form["opening_hour1"] }}</span>
                                <input id="opening_hour1" type="hidden" class="form-control" name="opening_hour1" required value="{{ $form["opening_hour1"] }}">
                            </div>
                        </div>

                        {{-- 営業時間２フォーム --}}
                        <div class="form-group row">
                            <label for="opening_hour2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour2') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $form["opening_hour2"] }}</span>
                                <input id="opening_hour2" type="hidden" class="form-control" name="opening_hour2" required value="{{ $form["opening_hour2"] }}">
                            </div>
                        </div>

                        {{-- 定休日フォーム --}}
                        <div class="form-group row">
                            <label for="holiday" class="col-md-3 col-form-label text-md-right">{{ __('messages.Holiday') }}</label>
                            
                            <div class="col-md-4">
                                <span>{{ $form["holiday"] }}</span>
                                <input id="holiday" type="hidden" class="form-control" name="holiday" required value="{{ $form["holiday"] }}">
                            </div>
                        </div>

                        {{-- 座席数フォーム --}}
                        <div class="form-group row">
                            <label for="seats" class="col-md-3 col-form-label text-md-right">{{ __('messages.Seats') }}</label>
                            
                            <div class="col-md-4">
                                <span>{{ $form["seats"] }}</span>
                                <input id="seats" type="hidden" class="form-control" name="seats" required value="{{ $form["seats"] }}">
                            </div>
                        </div>

                        {{-- アクセスフォーム --}}
                        <div class="form-group row">
                            <label for="access" class="col-md-3 col-form-label text-md-right">{{ __('messages.Access') }}</label>
                            
                            <div class="col-md-9">
                                <span>{{ $form["access"] }}</span>
                                <input id="access" type="hidden" class="form-control" name="access" required value="{{ $form["access"] }}">
                            </div>
                        </div>

                        {{-- 駐車場フォーム --}}
                        <div class="form-group row">
                            <label for="parking" class="col-md-3 col-form-label text-md-right">{{ __('messages.Parking') }}</label>
                            
                            <div class="col-md-4">
                                <span>{{ $form["parking"] }}</span>
                                <input id="parking" type="hidden" class="form-control" name="parking" required value="{{ $form["parking"] }}">
                            </div>
                        </div>

                        {{-- 公式サイトフォーム --}}
                        <div class="form-group row">
                            <label for="official_site" class="col-md-3 col-form-label text-md-right">{{ __('messages.Official_Site') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $form["official_site"] }}</span>
                                <input id="official_site" type="hidden" class="form-control" name="official_site" required value="{{ $form["official_site"] }}">
                            </div>
                        </div>

                        {{-- 公式ブログフォーム --}}
                        <div class="form-group row">
                            <label for="official_blog" class="col-md-3 col-form-label text-md-right">{{ __('messages.Official_Blog') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $form["official_blog"] }}</span>
                                <input id="official_blog" type="hidden" class="form-control" name="official_blog" required value="{{ $form["official_blog"] }}">
                            </div>
                        </div>

                        {{-- Facebooページフォーム --}}
                        <div class="form-group row">
                            <label for="facebook" class="col-md-3 col-form-label text-md-right">{{ __('messages.Facebook') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $form["facebook"] }}</span>
                                <input id="facebook" type="hidden" class="form-control" name="facebook" required value="{{ $form["facebook"] }}">
                            </div>
                        </div>

                        {{-- Twitter IDフォーム --}}
                        <div class="form-group row">
                            <label for="twitter" class="col-md-3 col-form-label text-md-right">{{ __('messages.Twitter') }}</label>
                            
                            <div class="col-md-5">
                                <span>{{ $form["twitter"] }}</span>
                                <input id="twitter" type="hidden" class="form-control" name="twitter" required value="{{ $form["twitter"] }}">
                            </div>
                        </div>

                        {{-- お店のタイプフォーム --}}
                        <div class="form-group row">
                            <label for="shop_type" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Type') }}</label>
                            
                            <div class="col-md-9">
                                <span>{{ $form["shop_type"] }}</span>
                                <input id="shop_type" type="hidden" class="form-control" name="shop_type" required value="{{ $form["shop_type"] }}">
                            </div>
                        </div>

                        {{-- 開店日フォーム --}}
                        <div class="form-group row">
                            <label for="opening_date" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Date') }}</label>
                            
                            <div class="col-md-3">
                                <span>{{ $form["opening_date"] }}</span>
                                <input id="opening_date" type="hidden" class="form-control" name="opening_date" required value="{{ $form["opening_date"] }}">
                            </div>
                        </div>

                        {{-- メニューフォーム --}}
                        <div class="form-group row">
                            <label for="menu" class="col-md-3 col-form-label text-md-right">{{ __('messages.Menu') }}</label>
                            
                            <div class="col-md-9">
                                <span>{{ $form["menu"] }}</span>
                                <input id="menu" type="hidden" class="form-control" name="menu" required value="{{ $form["menu"] }}">
                            </div>
                        </div>

                        {{-- 備考フォーム --}}
                        <div class="form-group row">
                            <label for="notes" class="col-md-3 col-form-label text-md-right">{{ __('messages.Notes') }}</label>
                            
                            <div class="col-md-9">
                                <span>{{ $form["notes"] }}</span>
                                <input id="notes" type="hidden" class="form-control" name="notes" required value="{{ $form["notes"] }}">
                            </div>
                        </div>

                        {{-- タグフォーム --}}
                        <div class="form-group row">
                            <label for="tags" class="col-md-3 col-form-label text-md-right">{{ __('messages.Tags') }}</label>
                            
                            <div class="col-md-6">
                                <span>{{ $form["tags"] }}</span>
                                <input id="tags" type="hidden" class="form-control" name="tags" required value="{{ $form["tags"] }}">
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
                    <form action="{{ url('/member/shop/entry') }}" method="POST">
                        @csrf

                        {{-- <input id="shop_name" type="hidden" value="{{ $form["shop_name"] }}">
                        <input id="shop_name_kana" type="hidden" value="{{ $form["shop_name_kana"] }}">
                        <input id="branch" type="hidden" value="{{ $form["branch"] }}">
                        <input id="address1" type="hidden" value="{{ $form["address1"] }}">
                        <input id="address2" type="hidden" value="{{ $form["address2"] }}">
                        <input id="address3" type="hidden" value="{{ $form["address3"] }}">
                        <input id="address4" type="hidden" value="{{ $form["address4"] }}">
                        <input id="phone_number1" type="hidden" value="{{ $form["phone_number1"] }}">
                        <input id="phone_number2" type="hidden" value="{{ $form["phone_number2"] }}">
                        <input id="opening_hour1" type="hidden" value="{{ $form["opening_hour1"] }}">
                        <input id="opening_hour2" type="hidden" value="{{ $form["opening_hour2"] }}">
                        <input id="holiday" type="hidden" value="{{ $form["holiday"] }}">
                        <input id="seats" type="hidden" value="{{ $form["seats"] }}">
                        <input id="access" type="hidden" value="{{ $form["access"] }}">
                        <input id="parking" type="hidden" value="{{ $form["parking"] }}">
                        <input id="official_site" type="hidden" value="{{ $form["official_site"] }}">
                        <input id="official_blog" type="hidden" value="{{ $form["official_blog"] }}">
                        <input id="facebook" type="hidden" value="{{ $form["facebook"] }}">
                        <input id="twitter" type="hidden" value="{{ $form["twitter"] }}">
                        <input id="opening_date" type="hidden" value="{{ $form["opening_date"] }}">
                        <input id="menu" type="hidden" value="{{ $form["menu"] }}">
                        <input id="notes" type="hidden" value="{{ $form["notes"] }}">
                        <input id="tags" type="hidden" value="{{ $form["tags"] }}"> --}}

                        {{-- 修正ボタン --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success" value="fix">
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
