{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', '店舗編集 - ラーメンresearch')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Shop_Edit') }}</div>

                    <div class="card-body">
                        <form action="{{ url('/member/shop/check') }}" class="h-adr" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- 店ID（表示しない） --}}
                            <div class="form-group row">                                
                                <div class="col-md-6">
                                    <input id="shop_id" type="hidden" class="form-control" name="shop_id" value="{{ $shop_id }}">
                                </div>
                            </div>

                            {{-- 店名フォーム --}}
                            <div class="form-group row">
                                <label for="shop_name" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name') }}</label>

                                <div class="col-md-6">
                                    @if (isset($form['shop_name']))
                                        <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ $form['shop_name'] }}" autofocus>
                                    @else
                                        <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ $shop_detail->shop_name }}" autofocus>
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
                                    @if (isset($form['shop_name_kana']))
                                        <input id="shop_name_kana" type="text" class="form-control @error('shop_name_kana') is-invalid @enderror" name="shop_name_kana" value="{{ $form['shop_name_kana'] }}">
                                    @else
                                        <input id="shop_name_kana" type="text" class="form-control @error('shop_name_kana') is-invalid @enderror" name="shop_name_kana" value="{{ $shop_detail->shop_name_kana }}">
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
                                    @if (isset($form['branch']))
                                        <input id="branch" type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" value="{{ $form['branch'] }}">
                                    @else
                                        <input id="branch" type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" value="{{ $shop_detail->branch }}">
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
                                    @if (isset($form['postcode']))
                                        <input id="postcode" type="text" class="form-control p-postal-code @error('postcode') is-invalid @enderror" name="postcode" value="{{ $form['postcode'] }}" maxlength="7">
                                    @else
                                        <input id="postcode" type="text" class="form-control p-postal-code @error('postcode') is-invalid @enderror" name="postcode" value="{{ $shop_detail->postcode }}" maxlength="7">
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
                                    @if (isset($form['address1']))
                                        <input id="address1" type="text" class="form-control p-region @error('address1') is-invalid @enderror" name="address1" value="{{ $form['address1'] }}" placeholder="{{ __('messages.Prefecture') }}">
                                    @else
                                        <input id="address1" type="text" class="form-control p-region @error('address1') is-invalid @enderror" name="address1" value="{{ $shop_detail->address1 }}" placeholder="{{ __('messages.Prefecture') }}">
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
                                    @if (isset($form['address2']))
                                        <input id="address2" type="text" class="form-control p-locality @error('address2') is-invalid @enderror" name="address2" value="{{ $form['address2'] }}" placeholder="{{ __('messages.Municipalities') }}">
                                    @else
                                        <input id="address2" type="text" class="form-control p-locality @error('address2') is-invalid @enderror" name="address2" value="{{ $shop_detail->address2 }}" placeholder="{{ __('messages.Municipalities') }}">
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
                                    @if (isset($form['address3']))
                                        <input id="address3" type="text" class="form-control p-street-address @error('address3') is-invalid @enderror" name="address3" value="{{ $form['address3'] }}" placeholder="{{ __('messages.After_Address1') }}">
                                    @else
                                        <input id="address3" type="text" class="form-control p-street-address @error('address3') is-invalid @enderror" name="address3" value="{{ $shop_detail->address3 }}" placeholder="{{ __('messages.After_Address1') }}">
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
                                    @if (isset($form['address4']))
                                        <input id="address4" type="text" onblur="initMap()" class="form-control p-extended-address @error('address4') is-invalid @enderror" name="address4" value="{{ $form['address4'] }}" placeholder="{{ __('messages.After_Address2') }}">
                                    @else
                                        <input id="address4" type="text" onblur="initMap()" class="form-control p-extended-address @error('address4') is-invalid @enderror" name="address4" value="{{ $shop_detail->address4 }}" placeholder="{{ __('messages.After_Address2') }}">
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
                                    @if (isset($form['map_lat']))
                                        <input id="map_lat" type="hidden" class="form-control" name="map_lat" value="{{ $form['map_lat'] }}">
                                    @else
                                        <input id="map_lat" type="hidden" class="form-control" name="map_lat" value="{{ $shop_detail->map_lat }}">
                                    @endif
                                </div>
                            </div>

                            {{-- 地図の経度フォーム（表示しない） --}}
                            <div class="form-group row">
                                <div class="col-md-6">
                                    @if (isset($form['map_long']))
                                        <input id="map_long" type="hidden" class="form-control" name="map_long" value="{{ $form['map_long'] }}">
                                    @else
                                        <input id="map_long" type="hidden" class="form-control" name="map_long" value="{{ $shop_detail->map_long }}">
                                    @endif
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
                                    @if (isset($form['phone_number1']))
                                        <input id="phone_number1" type="text" class="form-control @error('phone_number1') is-invalid @enderror" name="phone_number1" value="{{ $form['phone_number1'] }}" maxlength="11">
                                    @else
                                        <input id="phone_number1" type="text" class="form-control @error('phone_number1') is-invalid @enderror" name="phone_number1" value="{{ $shop_detail->phone_number1 }}" maxlength="11">
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
                                    @if (isset($form['phone_number2']))
                                        <input id="phone_number2" type="text" class="form-control @error('phone_number2') is-invalid @enderror" name="phone_number2" value="{{ $form['phone_number2'] }}" maxlength="11">
                                    @else
                                        <input id="phone_number2" type="text" class="form-control @error('phone_number2') is-invalid @enderror" name="phone_number2" value="{{ $shop_detail->phone_number2 }}" maxlength="11">
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
                                    @if (isset($form['opening_hour1']))
                                        <input id="opening_hour1" type="text" class="form-control @error('opening_hour1') is-invalid @enderror" name="opening_hour1" value="{{ $form['opening_hour1'] }}">
                                    @else
                                        <input id="opening_hour1" type="text" class="form-control @error('opening_hour1') is-invalid @enderror" name="opening_hour1" value="{{ $shop_detail->opening_hour1 }}">
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
                                    @if (isset($form['opening_hour2']))
                                        <input id="opening_hour2" type="text" class="form-control @error('opening_hour2') is-invalid @enderror" name="opening_hour2" value="{{ $form['opening_hour2'] }}">
                                    @else
                                        <input id="opening_hour2" type="text" class="form-control @error('opening_hour2') is-invalid @enderror" name="opening_hour2" value="{{ $shop_detail->opening_hour2 }}">
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
                                    @if (isset($form['holiday']))
                                        <input id="holiday" type="text" class="form-control @error('holiday') is-invalid @enderror" name="holiday" value="{{ $form['holiday'] }}">
                                    @else
                                        <input id="holiday" type="text" class="form-control @error('holiday') is-invalid @enderror" name="holiday" value="{{ $shop_detail->holiday }}">
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
                                    @if (isset($form['seats']))
                                        <input id="seats" type="text" class="form-control @error('seats') is-invalid @enderror" name="seats" value="{{ $form['seats'] }}">
                                    @else
                                        <input id="seats" type="text" class="form-control @error('seats') is-invalid @enderror" name="seats" value="{{ $shop_detail->seats }}">
                                    @endif
                                
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
                                    @if (isset($form['access']))
                                        {{ Form::textarea('access', $form['access'], ['class' => 'form-control', 'id' => 'access']) }}
                                    @else
                                        {{ Form::textarea('access', $shop_detail->access, ['class' => 'form-control', 'id' => 'access']) }}
                                    @endif
                                    
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
                                    @if (isset($form['parking']))
                                        <input id="parking" type="text" class="form-control @error('parking') is-invalid @enderror" name="parking" value="{{ $form['parking'] }}">
                                    @else
                                        <input id="parking" type="text" class="form-control @error('parking') is-invalid @enderror" name="parking" value="{{ $shop_detail->parking }}">
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
                                    @if (isset($form['official_site']))
                                        <input id="official_site" type="text" class="form-control @error('official_site') is-invalid @enderror" name="official_site" value="{{ $form['official_site'] }}">
                                    @else
                                        <input id="official_site" type="text" class="form-control @error('official_site') is-invalid @enderror" name="official_site" value="{{ $shop_detail->official_site }}">
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
                                    @if (isset($form['official_blog']))
                                        <input id="official_blog" type="text" class="form-control @error('official_blog') is-invalid @enderror" name="official_blog" value="{{ $form['official_blog'] }}">
                                    @else
                                        <input id="official_blog" type="text" class="form-control @error('official_blog') is-invalid @enderror" name="official_blog" value="{{ $shop_detail->official_blog }}">
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
                                    @if (isset($form['facebook']))
                                        <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $form['facebook'] }}">
                                    @else
                                        <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $shop_detail->facebook }}">
                                    @endif
                                
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
                                    @if (isset($form['twitter']))
                                        <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ $form['twitter'] }}">
                                    @else
                                        <input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ $shop_detail->twitter }}">
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
                                    @foreach ($shop_types as $shop_type)
                                        @if (isset($form['shop_type']))
                                            @if ($shop_type == $form['shop_type'])
                                                {{ Form::radio('shop_type', $shop_type, true) }}
                                            @else
                                                {{ Form::radio('shop_type', $shop_type, false) }}
                                            @endif
                                        @else
                                            @if ($shop_type == $shop_detail->shop_type)
                                                {{ Form::radio('shop_type', $shop_type, true) }}
                                            @else
                                                {{ Form::radio('shop_type', $shop_type, false) }}
                                            @endif
                                        @endif
                                        {{ Form::label($shop_type, $shop_type) }}
                                    @endforeach
                                </div>
                            </div>

                            {{-- 開店日フォーム --}}
                            <div class="form-group row">
                                <label for="opening_date" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Date') }}</label>
                                
                                <div class="col-md-3">
                                    @if (isset($form['opening_date']))
                                        <input id="opening_date" type="text" class="form-control @error('opening_date') is-invalid @enderror" name="opening_date" value="{{ $form['opening_date'] }}">
                                    @else
                                        <input id="opening_date" type="text" class="form-control @error('opening_date') is-invalid @enderror" name="opening_date" value="{{ $shop_detail->opening_date }}">
                                    @endif
                                
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
                                    @if (isset($form['menu']))
                                        {{ Form::textarea('menu', $form['menu'], ['class' => 'form-control', 'id' => 'menu']) }}
                                    @else
                                        {{ Form::textarea('menu', $shop_detail->menu, ['class' => 'form-control', 'id' => 'menu']) }}
                                    @endif

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
                                    @if (isset($form['notes']))
                                        {{ Form::textarea('notes', $form['notes'], ['class' => 'form-control', 'id' => 'notes']) }}
                                    @else
                                        {{ Form::textarea('notes', $shop_detail->notes, ['class' => 'form-control', 'id' => 'notes']) }}
                                    @endif

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
                                    @foreach ($tags_category as $key => $tag_category)
                                        @php
                                            $tag_flag = false;
                                        @endphp
                                        @if (isset($form['tags']))
                                            @if (in_array((String)$key, $form['tags'], true))
                                                @php
                                                    $tag_flag = true;
                                                @endphp
                                            @endif
                                        @else
                                            @if (in_array($key, $tags_id, true))
                                                @php
                                                    $tag_flag = true;
                                                @endphp
                                            @endif
                                        @endif
                                        {{ Form::checkbox('tags[]', $key, $tag_flag, ['id' => 'tags-' . $key]) }}    

                                    {{-- @foreach ($shop_tags as $key => $shop_tag) --}}
                                        {{-- @foreach ($shop_tags as $shop_tag)
                                            @if ($key === $shop_tag->tag_id)
                                                {{ Form::checkbox('tags[]', $key, true, ['id' => 'tags-' . $key]) }}
                                                @php
                                                    $tag_flag = 1;
                                                @endphp
                                            @endif
                                        @endforeach --}}
                                        {{-- @if ($tag_flag === 0)
                                            {{ Form::checkbox('tags[]', $key, false, ['id' => 'tags-' . $key]) }}
                                        @endif --}}
                                        {{ Form::label('tags-' . $key, $tag_category) }}
                                    @endforeach
                                </div>
                            </div>

                            {{-- お店イメージフォーム --}}
                            <div class="form-group row">
                                <label for="image_file" class="col-md-3 col-form-label text-md-right">{{ __('messages.Image_Name') }}</label>

                                <div class="col-md-9">
                                    <input id="image_file" type="file" class="form-control-file" name="image_file" value="{{ old('image_file') }}">

                                    @if (isset($form['image_path']))
                                        @if ($form['image_path'] !== '')
                                            <p>選択済みは{{ $form['image_path'] }}</p>
                                            <img class="img-thumbnail" src="{{ asset('storage/image/' . $form['image_path']) }}">     
                                            <input id="image_path" type="hidden" class="form-control" name="image_path" value="{{ $form['image_path'] }}">
                                            
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
                                    @else
                                        @if ($shop_detail->image_path !== '')
                                            <p>選択済みは{{ $shop_detail->image_path }}</p>
                                            <img class="img-thumbnail" src="{{ asset('storage/image/' . $shop_detail->image_path) }}">                                                    
                                            <input id="image_path" type="hidden" class="form-control" name="image_path" value="{{ $shop_detail->image_path }}">
                                            
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
                                    @endif

                                </div>
                            </div>

                            {{-- 次へボタン（確認画面へ） --}}
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="fedit" value="true">
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
