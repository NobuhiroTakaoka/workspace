@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'レビュー投稿 - ラーメンresearch')


@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('messages.Title') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('shop.detail', ['shop_id' => $shop_id]) }}">{{ __('messages.Shop_detail') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Review_Post') }}</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <span class="review_post">{{ __('messages.Review_Post_Cd') }}</span>
                <span class="lead font-weight-bold">{{ $shop_name }}</span>&nbsp
                <span class="lead font-weight-bold">{{ $branch }}</span>
            </div>

            <div class="card-body">
                <form action="{{ route('review_check', ['shop_id' => $shop_id]) }}?" class="h-adr" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- メニュー（タイトル） --}}
                    <div class="form-group row">
                        <label for="menu_title" class="col-md-3 col-form-label text-md-right">{{ __('messages.Menu_Title') }}</label>

                        <div class="col-md-6">
                            <input id="menu_title" type="text" class="form-control @error('menu_title') is-invalid @enderror" name="menu_title" value="{{ $form['menu_title'] }}" autofocus>

                            @error('menu_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- カテゴリ --}}
                    <div class="form-group row">
                        <label for="category" class="col-md-3 col-form-label text-md-right">{{ __('messages.Category') }}</label>
                        
                        <div class="col-md-3">
                            {{-- Laravel CollectiveのFormファサード使用 --}}
                            {{ Form::select('category', [
                                'ラーメン' => 'ラーメン',
                                'つけ麺' => 'つけ麺',
                                'まぜそば' => 'まぜそば',
                                'その他の麺' => 'その他の麺',
                                ],
                                $form['category'],
                                $errors->has('category') ? ['placeholder' => '選択してください', 'id' => 'category', 'class' => 'form-control is-invalid']
                                                         : ['placeholder' => '選択してください', 'id' => 'category', 'class' => 'form-control']
                            ) }}

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- スープ --}}
                    <div class="form-group row">
                        <label for="soups" class="col-md-3 col-form-label text-md-right">{{ __('messages.Soups') }}</label>
                        
                        <div class="col-md-3">
                            {{-- Laravel CollectiveのFormファサード使用 --}}
                            {{ Form::select('soup', [
                                '醤油系' => '醤油系',
                                '味噌系' => '味噌系',
                                '塩系'=> '塩系',
                                '豚骨系' => '豚骨系',
                                '魚介系' => '魚介系',
                                'その他スープ' => 'その他スープ',
                                ],
                                $form['soup'],
                                $errors->has('soup') ? ['placeholder' => '選択してください', 'id' => 'soup', 'class' => 'form-control is-invalid']
                                                     : ['placeholder' => '選択してください', 'id' => 'soup', 'class' => 'form-control'] 
                            ) }}

                            @error('soup')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- 点数 --}}
                    <div class="form-group row">
                        <label for="points" class="col-md-3 col-form-label text-md-right">{{ __('messages.Points') }}</label>
                        
                        <div class="col-md-3">
                            {{-- Laravel CollectiveのFormファサード使用 --}}
                            {{ Form::select('points', [
                                100 => '100点',
                                99 => '99点',
                                98 => '98点',
                                97 => '97点',
                                96 => '96点',
                                95 => '95点',
                                94 => '94点',
                                93 => '93点',
                                92 => '92点',
                                91 => '91点',
                                90 => '90点',
                                89 => '89点',
                                88 => '88点',
                                87 => '87点',
                                86 => '86点',
                                85 => '85点',
                                84 => '84点',
                                83 => '83点',
                                82 => '82点',
                                81 => '81点',
                                80 => '80点',
                                79 => '79点',
                                78 => '78点',
                                77 => '77点',
                                76 => '76点',
                                75 => '75点',
                                74 => '74点',
                                73 => '73点',
                                72 => '72点',
                                71 => '71点',
                                70 => '70点',
                                69 => '69点',
                                68 => '68点',
                                67 => '67点',
                                66 => '66点',
                                65 => '65点',
                                64 => '64点',
                                63 => '63点',
                                62 => '62点',
                                61 => '61点',
                                60 => '60点',
                                59 => '59点',
                                58 => '58点',
                                57 => '57点',
                                56 => '56点',
                                55 => '55点',
                                54 => '54点',
                                53 => '53点',
                                52 => '52点',
                                51 => '51点',
                                50 => '50点',
                                49 => '49点',
                                48 => '48点',
                                47 => '47点',
                                46 => '46点',
                                45 => '45点',
                                44 => '44点',
                                43 => '43点',
                                42 => '42点',
                                41 => '41点',
                                40 => '40点',
                                39 => '39点',
                                38 => '38点',
                                37 => '37点',
                                36 => '36点',
                                35 => '35点',
                                34 => '34点',
                                33 => '33点',
                                32 => '32点',
                                31 => '31点',
                                30 => '30点',
                                29 => '29点',
                                28 => '28点',
                                27 => '27点',
                                26 => '26点',
                                25 => '25点',
                                24 => '24点',
                                23 => '23点',
                                22 => '22点',
                                21 => '21点',
                                20 => '20点',
                                19 => '19点',
                                18 => '18点',
                                17 => '17点',
                                16 => '16点',
                                15 => '15点',
                                14 => '14点',
                                13 => '13点',
                                12 => '12点',
                                11 => '11点',
                                10 => '10点',
                                9 => '9点',
                                8 => '8点',
                                7 => '7点',
                                6 => '6点',
                                5 => '5点',
                                4 => '4点',
                                3 => '3点',
                                2 => '2点',
                                1 => '1点',
                                ],
                                $form['points'],
                                $errors->has('points') ? ['placeholder' => '選択してください', 'id' => 'points', 'class' => 'form-control is-invalid']
                                                       : ['placeholder' => '選択してください', 'id' => 'points', 'class' => 'form-control']
                            ) }}

                            @error('points')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- メニュー画像 --}}
                    <div class="form-group row">
                        <label for="image_file" class="col-md-3 col-form-label text-md-right">{{ __('messages.Menu_Image') }}</label>

                        <div class="col-md-4">
                            <input id="menu_image" type="file" class="form-control-file" name="menu_image" value="{{ old('menu_image') }}">

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

                    {{-- コメント --}}
                    <div class="form-group row d-flex align-items-center">
                        <label for="comment" class="col-md-3 col-form-label text-md-right">{{ __('messages.Comment') }}</label>
                        
                        <div class="col-md-9">
                            {{ Form::textarea('comment', $form['comment'],
                                $errors->has('comment') ? ['id' => 'comment', 'class' => 'form-control is-invalid']
                                                        : ['id' => 'comment', 'class' => 'form-control']
                            ) }}

                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
@endsection
