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
                    <form action="{{ url('/member/shop/entry') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="shop_name" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name') }}</label>

                            <div class="col-md-6">
                                <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ old('shop_name') }}" autofocus>

                                @error('shop_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_name_kana" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Name_Kana') }}</label>

                            <div class="col-md-6">
                                <input id="shop_name_kana" type="text" class="form-control @error('shop_name_kana') is-invalid @enderror" name="shop_name_kana" value="{{ old('shop_name_kana') }}">

                                @error('shop_name_kana')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="branch" class="col-md-3 col-form-label text-md-right">{{ __('messages.Branch') }}</label>

                            <div class="col-md-6">
                                <input id="branch" type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" value="{{ old('branch') }}">

                                @error('branch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-3 col-form-label text-md-right">{{ __('messages.Post_Code') }}</label>

                            <div class="col-md-2">
                                <input id="address1" type="text" class="form-control" name="address1" maxlength="7">
                                
                                @error('address1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address1') }}</label>
                            
                            <div class="col-md-6">
                                <input id="address2" type="text" class="form-control" name="address2">
                                
                                @error('address2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address2') }}</label>
                            
                            <div class="col-md-6">
                                <input id="address3" type="text" class="form-control" name="address3">
                                
                                @error('address3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address3" class="col-md-3 col-form-label text-md-right">{{ __('messages.Address3') }}</label>
                            
                            <div class="col-md-6">
                                <input id="address4" type="text" class="form-control" name="address4">
                                
                                @error('address4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div id="map" style="width: 600px; height: 500px;">
                        </div>

                        <script>
                            function initMap() {
                             
                              var target = document.getElementById('map'); //マップを表示する要素を指定
                              var address = '東京都新宿区西新宿2-8-1'; //住所を指定
                              var geocoder = new google.maps.Geocoder();  
                            
                              geocoder.geocode({ address: address }, function(results, status){alert(status);
                                if (status === 'OK' && results[0]){
                            
                                  console.log(results[0].geometry.location);
                            
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
                        <script src="//maps.google.com/maps/api/js?key={{ config('app.google_api_key') }}&callback=initMap"></script>




                        <div class="form-group row">
                            <label for="phone_number1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number1') }}</label>
                            
                            <div class="col-md-3">
                                <input id="phone_number1" type="text" class="form-control" name="phone_number1" maxlength="11">
                                
                                @error('phone_number1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Phone_Number2') }}</label>
                            
                            <div class="col-md-3">
                                <input id="phone_number2" type="text" class="form-control" name="phone_number2" maxlength="11">
                                
                                @error('phone_number2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="opening_hour1" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour1') }}</label>
                            
                            <div class="col-md-5">
                                <input id="opening_hour1" type="text" class="form-control" name="opening_hour1">
                                
                                @error('opening_hour1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="opening_hour2" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Hour2') }}</label>
                            
                            <div class="col-md-5">
                                <input id="opening_hour2" type="text" class="form-control" name="opening_hour2">
                                
                                @error('opening_hour2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="holiday" class="col-md-3 col-form-label text-md-right">{{ __('messages.Holiday') }}</label>
                            
                            <div class="col-md-4">
                                <input id="holiday" type="text" class="form-control" name="holiday">
                                
                                @error('holiday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="holiday" class="col-md-3 col-form-label text-md-right">{{ __('messages.Holiday') }}</label>
                            
                            <div class="col-md-4">
                                <input id="holiday" type="text" class="form-control" name="holiday">
                                
                                @error('holiday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seats" class="col-md-3 col-form-label text-md-right">{{ __('messages.Seats') }}</label>
                            
                            <div class="col-md-4">
                                <input id="seats" type="text" class="form-control" name="seats">
                                
                                @error('seats')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="access" class="col-md-3 col-form-label text-md-right">{{ __('messages.Access') }}</label>
                            
                            <div class="col-md-9">
                                <input id="access" type="text" class="form-control" name="access">
                                
                                @error('access')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="parking" class="col-md-3 col-form-label text-md-right">{{ __('messages.Parking') }}</label>
                            
                            <div class="col-md-4">
                                <input id="parking" type="text" class="form-control" name="parking">
                                
                                @error('parking')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="official_site" class="col-md-3 col-form-label text-md-right">{{ __('messages.Official_Site') }}</label>
                            
                            <div class="col-md-5">
                                <input id="official_site" type="text" class="form-control" name="official_site">
                                
                                @error('official_site')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="official_blog" class="col-md-3 col-form-label text-md-right">{{ __('messages.Official_Blog') }}</label>
                            
                            <div class="col-md-5">
                                <input id="official_blog" type="text" class="form-control" name="official_blog">
                                
                                @error('official_site')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facebook" class="col-md-3 col-form-label text-md-right">{{ __('messages.Facebook') }}</label>
                            
                            <div class="col-md-5">
                                <input id="facebook" type="text" class="form-control" name="facebook">
                                
                                @error('facebook')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="twitter" class="col-md-3 col-form-label text-md-right">{{ __('messages.Twitter') }}</label>
                            
                            <div class="col-md-5">
                                <input id="twitter" type="text" class="form-control" name="twitter">
                                
                                @error('twitter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_type" class="col-md-3 col-form-label text-md-right">{{ __('messages.Shop_Type') }}</label>
                            
                            <div class="col-md-9">
                                {{-- Laravel CollectiveのFormファサード使用 --}}
                                @foreach ($shop_types as $shop_type)
                                    {{ Form::radio('shop_type', $shop_type, false, ['value'=>old('shop_type')]) }}
                                    {{ Form::label($shop_type, $shop_type) }}
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="opening_date" class="col-md-3 col-form-label text-md-right">{{ __('messages.Opening_Date') }}</label>
                            
                            <div class="col-md-3">
                                <input id="opening_date" type="text" class="form-control" name="opening_date">
                                
                                @error('opening_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="menu" class="col-md-3 col-form-label text-md-right">{{ __('messages.Menu') }}</label>
                            
                            <div class="col-md-9">
                                <input id="menu" type="text" class="form-control" name="menu">
                                
                                @error('menu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notes" class="col-md-3 col-form-label text-md-right">{{ __('messages.Notes') }}</label>
                            
                            <div class="col-md-9">
                                <input id="notes" type="text" class="form-control" name="notes">
                                
                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-md-3 col-form-label text-md-right">{{ __('messages.Tags') }}</label>
                            
                            <div class="col-md-6">
                                <input id="tags" type="text" class="form-control" name="tags">
                                
                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>






                        {{-- <div id="map" style="height:500px">  {{-- 追加 --}}
                        {{-- </div>
                        {{-- {!! Form::open(['route' => 'result.currentLocation','method' => 'get']) !!} --}}
                        {{-- {!! Form::open(['url' => 'member/shop/entry','method' => 'get']) !!}
                        {{--隠しフォームでresult.currentLocationに位置情報を渡す--}}
                        {{--lat用--}}
                        {{-- {!! Form::hidden('lat','lat',['class'=>'lat_input']) !!}
                        {{--lng用--}}
                        {{-- {!! Form::hidden('lng','lng',['class'=>'lng_input']) !!}
                        {{--setlocation.jsを読み込んで、位置情報取得するまで押せないようにdisabledを付与し、非アクティブにする。--}}
                        {{--その後、disableはfalseになるようにsetlocation.js内に記述した--}}
                        {{-- {!! Form::submit("周辺を表示", ['class' => "btn btn-success btn-block",'disabled']) !!}
                        {{-- {!! Form::close() !!}

                        <input type="text" id="addressInput">
                        <button id="searchGeo">緯度経度変換</button>
                        <div>
                            緯度：<input type="text" id="lat">
                            経度：<input type="text" id="lng">
                        </div>

                        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
                        <script src="{{ asset('/js/setLocation.js') }}"></script>  {{-- 追加 --}}
                        {{-- <script src="{{ asset('/js/map_result.js') }}"></script>  {{-- 追加 --}}
                        {{-- <script src="{{ asset('/js/getLatLng.js') }}"></script>  {{-- 追加 --}}
                        {{-- <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('app.google_api_key') }}&callback=initMap" async defer> --}}
                        {{-- </script> --}}
            


            
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
