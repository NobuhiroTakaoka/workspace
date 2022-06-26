{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '店舗登録 - ラーメンresearch')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Entry') }}</div>

                    <div class="card-body">
                        <form action="{{ url('/member/shop/check') }}" class="h-adr" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- 店名フォーム --}}
                            <div class="form-group row">
                                <label for="shop_name" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name') }}</label>

                                <div class="col-md-6">
                                    @if ($form['shop_name'] != '')
                                        <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ $form['shop_name'] }}" autofocus>
                                    @else
                                        <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ old('shop_name') }}" autofocus>
                                    @endif

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
                                    @if ($form['shop_name_kana'] != '')
                                        <input id="shop_name_kana" type="text" class="form-control @error('shop_name_kana') is-invalid @enderror" name="shop_name_kana" value="{{ $form['shop_name_kana'] }}">
                                    @else
                                        <input id="shop_name_kana" type="text" class="form-control @error('shop_name_kana') is-invalid @enderror" name="shop_name_kana" value="{{ old('shop_name_kana') }}">
                                    @endif

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
                                    @if ($form['branch'] != '')
                                        <input id="branch" type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" value="{{ $form['branch'] }}">
                                    @else
                                        <input id="branch" type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" value="{{ old('branch') }}">
                                    @endif

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
                                    @if ($form['postcode'] != '')
                                        <input id="postcode" type="text" class="form-control p-postal-code @error('postcode') is-invalid @enderror" name="postcode" value="{{ $form['postcode'] }}" maxlength="7">
                                    @else
                                        <input id="postcode" type="text" class="form-control p-postal-code @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" maxlength="7">
                                    @endif
    
                                    @error('postcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span>ハイフン（-）なし</span>
                            </div>

                            {{-- 住所１フォーム --}}
                            <div class="form-group row">
                                <label for="address1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address1') }}</label>
                                
                                <div class="col-md-6">
                                    @if ($form['address1'] != '')
                                        <input id="address1" type="text" class="form-control p-region @error('address1') is-invalid @enderror" name="address1" value="{{ $form['address1'] }}" placeholder="{{ __('messages.Prefecture') }}">
                                    @else
                                        <input id="address1" type="text" class="form-control p-region @error('address1') is-invalid @enderror" name="address1" value="{{ old('address1') }}" placeholder="{{ __('messages.Prefecture') }}">
                                    @endif

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
                                    @if ($form['address2'] != '')
                                        <input id="address2" type="text" class="form-control p-locality @error('address2') is-invalid @enderror" name="address2" value="{{ $form['address2'] }}" placeholder="{{ __('messages.Municipalities') }}">
                                    @else
                                        <input id="address2" type="text" class="form-control p-locality @error('address2') is-invalid @enderror" name="address2" value="{{ old('address2') }}" placeholder="{{ __('messages.Municipalities') }}">
                                    @endif
    
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
                                    @if ($form['address3'] != '')
                                        <input id="address3" type="text" class="form-control p-street-address @error('address3') is-invalid @enderror" name="address3" value="{{ $form['address3'] }}" placeholder="{{ __('messages.After_Address1') }}">
                                    @else
                                        <input id="address3" type="text" class="form-control p-street-address @error('address3') is-invalid @enderror" name="address3" value="{{ old('address3') }}" placeholder="{{ __('messages.After_Address1') }}">
                                    @endif
                                    
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
                                    @if ($form['address4'] != '')
                                        <input id="address4" type="text" onblur="initMap()" class="form-control p-extended-address @error('address4') is-invalid @enderror" name="address4" value="{{ $form['address4'] }}" placeholder="{{ __('messages.After_Address2') }}">
                                    @else
                                        <input id="address4" type="text" onblur="initMap()" class="form-control p-extended-address @error('address4') is-invalid @enderror" name="address4" value="{{ old('address4') }}" placeholder="{{ __('messages.After_Address2') }}">
                                    @endif
                                    
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
                                <div class="col-md-6">
                                    {{-- <input id="map_lat" type="hidden" class="form-control" name="map_lat" value="{{ old('map_lat') }}"> --}}
                                    <input id="map_lat" type="hidden" class="form-control" name="map_lat" value="{{ $form['map_lat'] }}">
                                </div>
                            </div>

                            {{-- 地図の経度フォーム（表示しない） --}}
                            <div class="form-group row">
                                <div class="col-md-6">
                                    {{-- <input id="map_long" type="hidden" class="form-control" name="map_long" value="{{ old('map_long') }}"> --}}
                                    <input id="map_long" type="hidden" class="form-control" name="map_long" value="{{ $form['map_long'] }}">
                                </div>
                            </div>

                            <script>
                                function initMap() {
                                    console.log('initMap');
                                    var address1 = document.getElementById('address1').value;  //住所１の入力内容を取得
                                    var address2 = document.getElementById('address2').value;  //住所２の入力内容を取得
                                    var address3 = document.getElementById('address3').value;  //住所３の入力内容を取得
                                    var address4 = document.getElementById('address4').value;  //住所４の入力内容を取得
                                    var address = address1 + address2 + address3 + address4;  //住所１～４を結合 

                                    var geocoder = new google.maps.Geocoder();  
                                
                                    geocoder.geocode({ address: address }, function(results, status){
                                    
                                        if (status === 'OK' && results[0]){
                                            
                                            console.log(results[0].geometry.location);
                                            var latlng = results[0].geometry.location;  //LatLngインスタンスを変数に格納
                                            var lat = latlng.lat();  //メソッドで緯度を取得し、変数に格納
                                            var long = latlng.lng();  // メソッドで経度を取得し、変数に格納
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
                                        //     // 住所が存在しない場合の処理
                                        //     alert('住所が正しくないか存在しません。');
                                        //     target.style.display='none';
                                        }
                                    });
                                }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'default') }}&callback=initMap" async defer></script>

                            {{-- 電話番号１フォーム --}}
                            <div class="form-group row">
                                <label for="phone_number1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number1') }}</label>
                                
                                <div class="col-md-3">
                                    @if ($form['phone_number1'] != '')
                                        <input id="phone_number1" type="text" class="form-control @error('phone_number1') is-invalid @enderror" name="phone_number1" value="{{ $form['phone_number1'] }}" maxlength="11">
                                    @else
                                        <input id="phone_number1" type="text" class="form-control @error('phone_number1') is-invalid @enderror" name="phone_number1" value="{{ old('phone_number1') }}" maxlength="11">
                                    @endif
                                
                                    @error('phone_number1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span>ハイフン（-）なし</span>
                            </div>

                            {{-- 電話番号２フォーム --}}
                            <div class="form-group row">
                                <label for="phone_number2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number2') }}</label>
                                
                                <div class="col-md-3">
                                    @if ($form['phone_number2'] != '')
                                        <input id="phone_number2" type="text" class="form-control @error('phone_number2') is-invalid @enderror" name="phone_number2" value="{{ $form['phone_number2'] }}" maxlength="11">
                                    @else
                                        <input id="phone_number2" type="text" class="form-control @error('phone_number2') is-invalid @enderror" name="phone_number2" value="{{ old('phone_number2') }}" maxlength="11">
                                    @endif
                            
                                    @error('phone_number2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span>ハイフン（-）なし</span>
                            </div>

                            {{-- 営業時間１フォーム --}}
                            <div class="form-group row">
                                <label for="opening_hour1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour1') }}</label>
                                
                                <div class="col-md-5">
                                    @if ($form['opening_hour1'] != '')
                                        <input id="opening_hour1" type="text" class="form-control @error('opening_hour1') is-invalid @enderror" name="opening_hour1" value="{{ $form['opening_hour1'] }}">
                                    @else
                                        <input id="opening_hour1" type="text" class="form-control @error('opening_hour1') is-invalid @enderror" name="opening_hour1" value="{{ old('opening_hour1') }}">
                                    @endif
                            
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
                                    @if ($form['opening_hour2'] != '')
                                        <input id="opening_hour2" type="text" class="form-control @error('opening_hour2') is-invalid @enderror" name="opening_hour2" value="{{ $form['opening_hour2'] }}">
                                    @else
                                        <input id="opening_hour2" type="text" class="form-control @error('opening_hour2') is-invalid @enderror" name="opening_hour2" value="{{ old('opening_hour2') }}">
                                    @endif
                            
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
                                    @if ($form['holiday'] != '')
                                        <input id="holiday" type="text" class="form-control @error('holiday') is-invalid @enderror" name="holiday" value="{{ $form['holiday'] }}">
                                    @else
                                        <input id="holiday" type="text" class="form-control @error('holiday') is-invalid @enderror" name="holiday" value="{{ old('holiday') }}">
                                    @endif

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
                                    @if ($form['seats'] != '')
                                        <input id="seats" type="text" class="form-control @error('seats') is-invalid @enderror" name="seats" value="{{ $form['seats'] }}">
                                    @else
                                        <input id="seats" type="text" class="form-control @error('seats') is-invalid @enderror" name="seats" value="{{ old('seats') }}">
                                    @endif

                                    @error('seats')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- アクセスフォーム --}}
                            <div class="form-group row d-flex align-items-center">
                                <label for="access" class="col-md-3 col-form-label text-md-right">{{ __('messages.Access') }}</label>
                                
                                <div class="col-md-9">
                                    {{-- <input id="access" type="text" class="form-control @error('access') is-invalid @enderror" name="access" value="{{ old('access') }}"> --}}
                                    {{-- <input id="access" type="textarea" class="form-control @error('access') is-invalid @enderror" name="access" value="{{ $form['access'] }}"> --}}
                                    {{ Form::textarea('access', $form['access'],
                                        $errors->has('access') ? ['id' => 'access', 'class' => 'form-control is-invalid']
                                                               : ['id' => 'access', 'class' => 'form-control']
                                    ) }}
                                    
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
                                    @if ($form['parking'] != '')
                                        <input id="parking" type="text" class="form-control @error('parking') is-invalid @enderror" name="parking" value="{{ $form['parking'] }}">
                                    @else
                                        <input id="parking" type="text" class="form-control @error('parking') is-invalid @enderror" name="parking" value="{{ old('parking') }}">
                                    @endif

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
                                    @if ($form['official_site'] != '')
                                        <input id="official_site" type="text" class="form-control @error('official_site') is-invalid @enderror" name="official_site" value="{{ $form['official_site'] }}">
                                    @else
                                        <input id="official_site" type="text" class="form-control @error('official_site') is-invalid @enderror" name="official_site" value="{{ old('official_site') }}">
                                    @endif

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
                                    @if ($form['official_blog'] != '')
                                        <input id="official_blog" type="text" class="form-control @error('official_blog') is-invalid @enderror" name="official_blog" value="{{ $form['official_blog'] }}">
                                    @else
                                        <input id="official_blog" type="text" class="form-control @error('official_blog') is-invalid @enderror" name="official_blog" value="{{ old('official_blog') }}">
                                    @endif
                                
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
                                    @if ($form['facebook'] != '')
                                        <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $form['facebook'] }}">
                                    @else
                                        <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook') }}">
                                    @endif

                                    @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Twitterフォーム --}}
                            <div class="form-group row">
                                <label for="twitter" class="col-md-3 col-form-label text-md-right">{{ __('messages.Twitter') }}</label>
                                
                                <div class="col-md-5">
                                    @if ($form['twitter'] != '')
                                        <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ $form['twitter'] }}">
                                    @else
                                        <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ old('twitter') }}">
                                    @endif

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
                                        <span style="white-space: nowrap;" class="mr-2">
                                            {{-- {{ Form::radio('shop_type', $shop_type, false, ['value'=>old('shop_type')]) }} --}}
                                            @if ($shop_type == $form['shop_type'])
                                                {{-- {{ Form::radio('shop_type', $shop_type, true, ['value'=>$form["shop_type"]]) }} --}} 
                                                {{-- {{ Form::radio('shop_type', $shop_type, true, ['id'=>'shop_type','class'=>'form-control @error('shop_type') is-invalid @enderror']) }} --}}
                                                {{ Form::radio('shop_type', $shop_type, true) }}
                                            @else
                                                {{-- {{ Form::radio('shop_type', $shop_type, false, ['value'=>$form["shop_type"]]) }} --}}
                                                {{-- {{ Form::radio('shop_type', $shop_type, false, ['id'=>'shop_type','class'=>'form-control @error('shop_type') is-invalid @enderror']) }} --}}
                                                {{ Form::radio('shop_type', $shop_type, false) }}
                                            @endif

                                            {{ Form::label($shop_type, $shop_type) }}
                                        </span>
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
                                    @if ($form['opening_date'] != '')
                                        <input id="opening_date" type="text" class="form-control @error('opening_date') is-invalid @enderror" name="opening_date" value="{{ $form['opening_date'] }}">
                                    @else
                                        <input id="opening_date" type="text" class="form-control @error('opening_date') is-invalid @enderror" name="opening_date" value="{{ old('opening_date') }}">
                                    @endif

                                    @error('opening_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- メニューフォーム --}}
                            <div class="form-group row d-flex align-items-center">
                                <label for="menu" class="col-md-3 col-form-label text-md-right">{{ __('messages.Menu') }}</label>
                                
                                <div class="col-md-9">
                                    {{-- <input id="menu" type="text" class="form-control @error('menu') is-invalid @enderror" name="menu" value="{{ old('menu') }}"> --}}
                                    {{-- <input id="menu" type="text" class="form-control @error('menu') is-invalid @enderror" name="menu" value="{{ $form['menu'] }}"> --}}
                                    {{ Form::textarea('menu', $form['menu'],
                                    $errors->has('menu') ? ['id' => 'menu', 'class' => 'form-control is-invalid']
                                                         : ['id' => 'menu', 'class' => 'form-control']
                                    ) }}

                                    @error('menu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 備考フォーム --}}
                            <div class="form-group row d-flex align-items-center">
                                <label for="notes" class="col-md-3 col-form-label text-md-right">{{ __('messages.Notes') }}</label>
                                
                                <div class="col-md-9">
                                    {{-- <input id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}"> --}}
                                    {{-- <input id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ $form['notes'] }}"> --}}
                                    {{ Form::textarea('notes', $form['notes'],
                                    $errors->has('notes') ? ['id' => 'notes', 'class' => 'form-control is_invalid']
                                                          : ['id' => 'notes', 'class' => 'form-control']
                                    ) }}

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
                                
                                <div class="col-md-9">
                                    {{-- <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags') }}"> --}}
                                    {{-- <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ $form['tags'] }}"> --}}

                                    {{-- タグカテゴリを繰り返し取得 --}}
                                    @foreach ($tags_category as $key => $tag_category)
                                        <span style="white-space: nowrap;" class="mr-2">
                                            {{-- $form['tags']が存在する場合（タグが選択されている場合） --}}
                                            @if (isset($form['tags']))
                                                {{-- $form['tags']が配列であり、$keyの値が入っている場合 --}}
                                                {{-- @if (is_array($form['tags']) && in_array($key, $form['tags'], true)) --}}
                                                @if (is_array($form['tags']) && in_array((String)$key, $form['tags'], true))
                                                    {{ Form::checkbox('tags[]', $key, true, ['id' => 'tags-' . $key]) }}
                                                @else
                                                    {{ Form::checkbox('tags[]', $key, false, ['id' => 'tags-' . $key]) }}
                                                @endif
                                            @else
                                                {{ Form::checkbox('tags[]', $key, false, ['id' => 'tags-' . $key]) }}
                                            @endif

                                            {{ Form::label('tags-' . $key, $tag_category) }}
                                        </span>
                                    @endforeach
                            
                                    {{-- @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>

                            {{-- お店イメージフォーム --}}
                            <div class="form-group row d-flex align-items-center">
                                <label for="image_file" class="col-md-3 col-form-label text-md-right">{{ __('messages.Image_Name') }}</label>

                                <div class="col-md-4">
                                    <input id="image_file" type="file" class="form-control-file" name="image_file" value="{{ old('image_file') }}">

                                    @if ($form['image_name'] !== '')
                                        <p>選択済みは{{ $form['image_name'] }}</p>
                                        <input id="image_name" type="hidden" class="form-control" name="image_name" value="{{ $form['image_name'] }}">
                                        
                                        <div>
                                            <input type="radio" name="image_name_mode" value="1">削除する場合はチェック
                                        </div>
                                        <div>
                                            <input type="radio" name="image_name_mode" value="2">変更する場合はチェック
                                        </div>
                                        <div>
                                            <input type="radio" name="image_name_mode" value="3" checked>何もしない場合はチェック
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- 次へボタン（確認画面へ） --}}
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="finput" value="true">
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
