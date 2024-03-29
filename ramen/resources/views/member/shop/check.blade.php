{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '店舗登録確認 - ラーメンresearch')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Entry_Check') }}</div>

                    <div class="card-body">
                    {{-- 更新の場合 --}}
                    @if ($chk_mode === 'edit')
                        <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
                    @endif
                            @csrf

                            {{-- 店名 --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="shop_name" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Shop_Name') }}</label>

                                <div class="col-md-6 d-flex align-items-center">
                                    <span>{{ $form["shop_name"] }}</span>
                                    <input id="shop_name" type="hidden" class="form-control" name="shop_name" value="{{ $form["shop_name"] }}">
                                </div>
                            </div>

                            {{-- 店名（ふりがな） --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="shop_name_kana" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Shop_Name_Kana') }}</label>

                                <div class="col-md-6 d-flex align-items-center">
                                    <span>{{ $form["shop_name_kana"] }}</span>
                                    <input id="shop_name_kana" type="hidden" class="form-control" name="shop_name_kana" value="{{ $form["shop_name_kana"] }}">
                                </div>
                            </div>

                            {{-- 支店名 --}}                        
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="branch" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Branch') }}</label>

                                <div class="col-md-6 d-flex align-items-center">
                                    <span>{{ $form["branch"] }}</span>
                                    <input id="branch" type="hidden" class="form-control" name="branch" value="{{ $form["branch"] }}">
                                </div>
                            </div>

                            {{-- 郵便番号 --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="postcode" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Post_Code') }}</label>

                                <div class="col-md-2 d-flex align-items-center">
                                    <span>{{ $form["postcode"] }}</span>
                                    <input id="postcode" type="hidden" class="form-control" name="postcode" value="{{ $form["postcode"] }}">
                                </div>
                            </div>

                            {{-- 住所１ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="address1" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Address1') }}</label>
                                
                                <div class="col-md-6 d-flex align-items-center">
                                    <span>{{ $form["address1"] }}</span>
                                    <input id="address1" type="hidden" class="form-control" name="address1" value="{{ $form["address1"] }}">
                                </div>
                            </div>

                            {{-- 住所２ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="address2" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Address2') }}</label>
                                
                                <div class="col-md-6 d-flex align-items-center">
                                    <span>{{ $form["address2"] }}</span>
                                    <input id="address2" type="hidden" class="form-control" name="address2" value="{{ $form["address2"] }}">
                                </div>
                            </div>

                            {{-- 住所３ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="address3" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Address3') }}</label>
                                
                                <div class="col-md-6 d-flex align-items-center">
                                    <span>{{ $form["address3"] }}</span>
                                    <input id="address3" type="hidden" class="form-control" name="address3" value="{{ $form["address3"] }}">
                                </div>
                            </div>

                            {{-- 住所４ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="address4" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Address4') }}</label>
                                
                                <div class="col-md-6 d-flex align-items-center">
                                    <span>{{ $form["address4"] }}</span>
                                    <input id="address4" type="hidden" class="form-control" name="address4" value="{{ $form["address4"] }}">
                                </div>
                            </div>

                            {{-- 地図の緯度（表示しない） --}}
                            <div class="form-group row mx-5">                            
                                <div class="col-md-6 d-flex align-items-center">
                                    <input id="map_lat" type="hidden" class="form-control" name="map_lat" value="{{ $form["map_lat"] }}">
                                </div>
                            </div>

                            {{-- 地図の経度（表示しない） --}}
                            <div class="form-group row mx-5">                            
                                <div class="col-md-6 d-flex align-items-center">
                                    <input id="map_long" type="hidden" class="form-control" name="map_long" value="{{ $form["map_long"] }}">
                                </div>
                            </div>

                            {{-- 地図表示（緯度・経度） --}}
                            <div class="map-container form-group row rounded border border-warning mx-5">
                                <label for="map" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Map') }}</label>

                                <div class="map_wrapper col-md-9 d-flex align-items-center">
                                    <div id="map" class="map" style="width: 550px; height: 460px;"></div>

                                    <script>
                                        function initMap() {
                                            var target = document.getElementById('map'); //マップを表示する要素を指定
                                            // var address = '東京都新宿区西新宿2-8-1'; //住所を指定
                                            var address1 = document.getElementById('address1').value; //住所１の内容を取得
                                            var address2 = document.getElementById('address2').value; //住所２の内容を取得
                                            var address3 = document.getElementById('address3').value; //住所３の内容を取得
                                            var address4 = document.getElementById('address4').value; //住所４の内容を取得
                                            var address = address1 + address2 + address3 + address4; //住所１～４を結合 
            
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
            
                                                } else { 
                                                    //住所が存在しない場合の処理
                                                    alert('住所が正しくないか存在しません。');
                                                    target.style.display='none';
                                                }
                                            });
                                        }
                                    </script>
                                    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'default') }}&callback=initMap" defer></script>            
                                </div>
                            </div>

                            {{-- 電話番号１ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="phone_number1" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Phone_Number1') }}</label>
                                
                                <div class="col-md-3 d-flex align-items-center">
                                    <span>{{ $form["phone_number1"] }}</span>
                                    <input id="phone_number1" type="hidden" class="form-control" name="phone_number1" value="{{ $form["phone_number1"] }}">
                                </div>
                            </div>

                            {{-- 電話番号２ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="phone_number2" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Phone_Number2') }}</label>
                                
                                <div class="col-md-3 d-flex align-items-center">
                                    <span>{{ $form["phone_number2"] }}</span>
                                    <input id="phone_number2" type="hidden" class="form-control" name="phone_number2" value="{{ $form["phone_number2"] }}">
                                </div>
                            </div>

                            {{-- 営業時間１ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="opening_hour1" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Opening_Hour1') }}</label>
                                
                                <div class="col-md-5 d-flex align-items-center">
                                    <span>{{ $form["opening_hour1"] }}</span>
                                    <input id="opening_hour1" type="hidden" class="form-control" name="opening_hour1" value="{{ $form["opening_hour1"] }}">
                                </div>
                            </div>

                            {{-- 営業時間２ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="opening_hour2" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Opening_Hour2') }}</label>
                                
                                <div class="col-md-5 d-flex align-items-center">
                                    <span>{{ $form["opening_hour2"] }}</span>
                                    <input id="opening_hour2" type="hidden" class="form-control" name="opening_hour2" value="{{ $form["opening_hour2"] }}">
                                </div>
                            </div>

                            {{-- 定休日 --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="holiday" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Holiday') }}</label>
                                
                                <div class="col-md-4 d-flex align-items-center">
                                    <span>{{ $form["holiday"] }}</span>
                                    <input id="holiday" type="hidden" class="form-control" name="holiday" value="{{ $form["holiday"] }}">
                                </div>
                            </div>

                            {{-- 座席数 --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="seats" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Seats') }}</label>
                                
                                <div class="col-md-4 d-flex align-items-center">
                                    <span>{{ $form["seats"] }}</span>
                                    <input id="seats" type="hidden" class="form-control" name="seats" value="{{ $form["seats"] }}">
                                </div>
                            </div>

                            {{-- アクセス --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="access" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Access') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <span>{{ $form["access"] }}</span>
                                    <input id="access" type="hidden" class="form-control" name="access" value="{{ $form["access"] }}">
                                </div>
                            </div>

                            {{-- 駐車場 --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="parking" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Parking') }}</label>
                                
                                <div class="col-md-4 d-flex align-items-center">
                                    <span>{{ $form["parking"] }}</span>
                                    <input id="parking" type="hidden" class="form-control" name="parking" value="{{ $form["parking"] }}">
                                </div>
                            </div>

                            {{-- 公式サイト --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="official_site" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Official_Site') }}</label>
                                
                                <div class="col-md-5 d-flex align-items-center">
                                    <span>{{ $form["official_site"] }}</span>
                                    <input id="official_site" type="hidden" class="form-control" name="official_site" value="{{ $form["official_site"] }}">
                                </div>
                            </div>

                            {{-- 公式ブログ--}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="official_blog" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Official_Blog') }}</label>
                                
                                <div class="col-md-5 d-flex align-items-center">
                                    <span>{{ $form["official_blog"] }}</span>
                                    <input id="official_blog" type="hidden" class="form-control" name="official_blog" value="{{ $form["official_blog"] }}">
                                </div>
                            </div>

                            {{-- Facebooページ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="facebook" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Facebook') }}</label>
                                
                                <div class="col-md-5 d-flex align-items-center">
                                    <span>{{ $form["facebook"] }}</span>
                                    <input id="facebook" type="hidden" class="form-control" name="facebook" value="{{ $form["facebook"] }}">
                                </div>
                            </div>

                            {{-- Twitter ID --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="twitter" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Twitter') }}</label>
                                
                                <div class="col-md-5 d-flex align-items-center">
                                    <span>{{ $form["twitter"] }}</span>
                                    <input id="twitter" type="hidden" class="form-control" name="twitter" value="{{ $form["twitter"] }}">
                                </div>
                            </div>

                            {{-- お店のタイプ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="shop_type" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Shop_Type') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <span>{{ $form["shop_type"] }}</span>
                                    <input id="shop_type" type="hidden" class="form-control" name="shop_type" value="{{ $form["shop_type"] }}">
                                </div>
                            </div>

                            {{-- 開店日 --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="opening_date" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Opening_Date') }}</label>
                                
                                <div class="col-md-3 d-flex align-items-center">
                                    <span>{{ $form["opening_date"] }}</span>
                                    <input id="opening_date" type="hidden" class="form-control" name="opening_date" value="{{ $form["opening_date"] }}">
                                </div>
                            </div>

                            {{-- メニュー --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="menu" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Menu') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <span>{{ $form["menu"] }}</span>
                                    <input id="menu" type="hidden" class="form-control" name="menu" value="{{ $form["menu"] }}">
                                </div>
                            </div>

                            {{-- 備考 --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="notes" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Notes') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    <span>{{ $form["notes"] }}</span>
                                    <input id="notes" type="hidden" class="form-control" name="notes" value="{{ $form["notes"] }}">
                                </div>
                            </div>

                            {{-- タグ --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="tags" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Tags') }}</label>
                                
                                <div class="col-md-6 d-flex align-items-center row">
                                    {{-- $form['tags']が存在する場合（タグが選択されている場合） --}}
                                    @if (isset($form['tags']))
                                        {{-- $form['tags']のタグIDを繰り返し取得 --}}
                                        @foreach ($form['tags'] as $tag)
                                            <div class="ml-3">
                                                {{-- タグIDがキーの値を表示 --}}
                                                {{ $tags_category[$tag] }}
                                                <input id="tags" type="hidden" class="form-control" name="tags" value="{{ $tag }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            {{-- お店イメージ画像 --}}
                            <div class="form-group row rounded border border-warning mx-5">
                                <label for="image_name" class="col-md-3 col-form-label text-md-right font-weight-bold">{{ __('messages.Image_Name') }}</label>
                                
                                <div class="col-md-9 d-flex align-items-center">
                                    {{-- 更新の場合 --}}
                                    @if ($chk_mode === 'edit')
                                        {{-- 元の画像から変更なしの場合 --}}
                                        @if ($chk_img_mode === '3')
                                            <img class="img-thumbnail" src="{{ asset('storage/image/' . $form['image_path']) }}">                                                    
                                        @else
                                            <div>{{ $form["image_name"] }}</div>
                                            <input id="image_name" type="hidden" class="form-control" name="image_name" value="{{ $form["image_name"] }}">
                                        @endif
                                    @else
                                        <div>{{ $form["image_name"] }}</div>
                                        <input id="image_name" type="hidden" class="form-control" name="image_name" value="{{ $form["image_name"] }}">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    {{ csrf_field() }}
                                    @if ($chk_mode === 'edit')
                                        {{-- 更新ボタン --}}
                                        <input id="update" type="hidden" class="form-control" name="update" value="{{ $shop_id }}">
                                        <button type="submit" class="btn btn-danger" name="edit">
                                        {{ __('messages.Edit') }}
                                        </button>
                                    @else
                                        {{-- 登録ボタン --}}
                                        <button type="submit" class="btn btn-primary" name="entry">
                                        {{ __('messages.Entry') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                    @if ($chk_mode === 'edit')
                        <form action="{{ route('shop.edit', ['shop_id' => $shop_id]) }}" method="GET">
                            @csrf
                            <input id="reedit" type="hidden" class="form-control" name="reedit" value="true">
                    @else
                        <form action="{{ route('shop.entry') }}" method="GET">
                            @csrf
                            <input id="mode" type="hidden" class="form-control" name="mode" value="true">
                    @endif
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
