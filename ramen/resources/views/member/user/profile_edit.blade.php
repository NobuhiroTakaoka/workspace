{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'プロフィール編集 - ラーメンresearch')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Mypage_Profile_Edit') }}</div>

                    <div class="card-body">
                        {{-- 各種メニュー --}}
                        <div class="float-right row mb-4 col-7">
                            <div class="pr-3 pb-2">
                                <a href="{{ route('mypage') }}" class="btn btn-success">{{ __('messages.Top') }}</a>
                            </div>
                            <div class="pr-3 pb-2">
                                <a href="{{ route('profile_public') }}" class="btn btn-success">{{ __('messages.Public_Profile') }}</a>
                            </div>
                            <div class="pr-3 pb-2">
                                <a href="{{ route('profile_edit') }}" class="btn btn-success">{{ __('messages.Profile_Edit') }}</a>
                            </div>
                        </div>

                        <div class="float-left col-md-12">
                            <form action="{{ route('profile_save') }}" class="h-adr" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- ニックネーム --}}
                                <div class="form-group row">
                                    <label for="nickname" class="col-md-3 col-form-label text-md-right">{{ __('messages.Nickname') }}</label>

                                    <div class="col-md-6">
                                        @if (isset($profile[0]->nickname))
                                            <input id="nickname" type="text" class="form-control" name="nickname" value="{{ $profile[0]->nickname }}" maxlength="30" autofocus>
                                        @else
                                            <input id="nickname" type="text" class="form-control" name="nickname" value="" maxlength="30" autofocus>
                                        @endif
                                        <span>30文字以内</span>
                                    </div>
                                </div>

                                {{-- 性別 --}}
                                <div class="form-group row">
                                    <label for="gender" class="col-md-3 col-form-label text-md-right">{{ __('messages.Gender') }}</label>
                                    
                                    <div class="col-md-9">
                                        @if (isset($profile[0]->gender))
                                            @foreach ($genders as $key => $gender)
                                            <span style="white-space: nowrap;" class="mr-2 form-check">
                                                {{ Form::radio('gender', $gender, $gender == $profile[0]->gender, [
                                                    'id' => 'gender-' . $key,
                                                    'class' => 'form-check-input'
                                                    ]) }}
                                                {{ Form::label('gender-' . $key, $gender, [
                                                    'for' => 'gender-' . $key,
                                                    'class' => 'form-check-label'
                                                    ]) }}
                                            </span>
                                            @endforeach
                                        @else
                                            @foreach ($genders as $key => $gender)
                                            <span style="white-space: nowrap;" class="mr-2 form-check">
                                                {{ Form::radio('gender', $gender, $key == 3, [
                                                    'id' => 'gender-' . $key,
                                                    'class' => 'form-check-input'
                                                    ]) }}
                                                {{ Form::label('gender-' . $key, $gender, [
                                                    'for' => 'gender-' . $key,
                                                    'class' => 'form-check-label'
                                                    ]) }}
                                            </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                {{-- 誕生年 --}}
                                <div class="form-group row">
                                    <label for="birth_year" class="col-md-3 col-form-label text-md-right">{{ __('messages.Birth_Year') }}</label>
                                    
                                    <div class="col-md-3">
                                        {{ Form::select('birth_year', [
                                            '非公開' => '非公開',
                                            '2016' => '2016年',
                                            '2015' => '2015年',
                                            '2014' => '2014年',
                                            '2013' => '2013年',
                                            '2012' => '2012年',
                                            '2011' => '2011年',
                                            '2010' => '2010年',
                                            '2009' => '2009年',
                                            '2008' => '2008年',
                                            '2007' => '2007年',
                                            '2006' => '2006年',
                                            '2005' => '2005年',
                                            '2004' => '2004年',
                                            '2003' => '2003年',
                                            '2002' => '2002年',
                                            '2001' => '2001年',
                                            '2000' => '2000年',
                                            '1999' => '1999年',
                                            '1998' => '1998年',
                                            '1997' => '1997年',
                                            '1996' => '1996年',
                                            '1995' => '1995年',
                                            '1994' => '1994年',
                                            '1993' => '1993年',
                                            '1992' => '1992年',
                                            '1991' => '1991年',
                                            '1990' => '1990年',
                                            '1989' => '1989年',
                                            '1988' => '1988年',
                                            '1987' => '1987年',
                                            '1986' => '1986年',
                                            '1985' => '1985年',
                                            '1984' => '1984年',
                                            '1983' => '1983年',
                                            '1982' => '1982年',
                                            '1981' => '1981年',
                                            '1980' => '1980年',
                                            '1979' => '1979年',
                                            '1978' => '1978年',
                                            '1977' => '1977年',
                                            '1976' => '1976年',
                                            '1975' => '1975年',
                                            '1974' => '1974年',
                                            '1973' => '1973年',
                                            '1972' => '1972年',
                                            '1971' => '1971年',
                                            '1970' => '1970年',
                                            '1969' => '1969年',
                                            '1968' => '1968年',
                                            '1967' => '1967年',
                                            '1966' => '1966年',
                                            '1965' => '1965年',
                                            '1964' => '1964年',
                                            '1963' => '1963年',
                                            '1962' => '1962年',
                                            '1961' => '1961年',
                                            '1960' => '1960年',
                                            '1959' => '1959年',
                                            '1958' => '1958年',
                                            '1957' => '1957年',
                                            '1956' => '1956年',
                                            '1955' => '1955年',
                                            '1954' => '1954年',
                                            '1953' => '1953年',
                                            '1952' => '1952年',
                                            '1951' => '1951年',
                                            '1950' => '1950年',
                                            '1949' => '1949年',
                                            '1948' => '1948年',
                                            '1947' => '1947年',
                                            '1946' => '1946年',
                                            '1945' => '1945年',
                                            '1944' => '1944年',
                                            '1943' => '1943年',
                                            '1942' => '1942年',
                                            '1941' => '1941年',
                                            '1940' => '1940年',
                                            '1939' => '1939年',
                                            '1938' => '1938年',
                                            '1937' => '1937年',
                                            '1936' => '1936年',
                                            '1935' => '1935年',
                                            '1934' => '1934年',
                                            '1933' => '1933年',
                                            '1932' => '1932年',
                                            '1931' => '1931年',
                                            '1930' => '1930年',
                                            '1929' => '1929年',
                                            '1928' => '1928年',
                                            '1927' => '1927年',
                                            '1926' => '1926年',
                                            '1925' => '1925年',
                                            '1924' => '1924年',
                                            '1923' => '1923年',
                                            '1922' => '1922年',
                                            '1921' => '1921年',
                                            '1920' => '1920年',
                                            '1919' => '1919年',
                                            '1918' => '1918年',
                                            '1917' => '1917年',
                                            '1916' => '1916年',
                                            ],
                                            isset($profile[0]->birth_year) ? $profile[0]->birth_year : '非公開',
                                            ['id' => 'birth_year', 'class' => 'form-control'] 
                                        ) }}
                                    </div>
                                </div>

                                {{-- 出身地 --}}
                                <div class="form-group row">
                                    <label for="base" class="col-md-3 col-form-label text-md-right">{{ __('messages.Base') }}</label>
                                    
                                    <div class="col-md-3">
                                        {{-- 都道府県のプルダウンメニュー --}}
                                        {{ Form::select('base',
                                            App\Models\Prefectures::prefList(),
                                            $pref_id != '' ? $pref_id: '非公開',
                                            ['placeholder' => '非公開', 'class' => 'form-control', 'id' => 'base']
                                        ) }}
                                    </div>
                                </div>

                                {{-- プロフィール画像 --}}
                                <div class="form-group row">
                                    <label for="image_file" class="col-md-3 col-form-label text-md-right">{{ __('messages.Profile_Image') }}</label>

                                    <div class="col-md-9">
                                        {{-- <input id="profile_image" type="file" class="form-control-file" name="profile_image" value="{{ old('profile_image') }}"> --}}
                                        {{ Form::file('image_file', ['class'=>'form-control-file','id'=>'image_file']) }}

                                        @if (isset($profile[0]->image_path) && $profile[0]->image_path !== '')                                       
                                            <p>選択済みは{{ $profile[0]->image_path }}</p>
                                            {{ Form::checkbox('image_delete', true, false, ['id'=>'image_delete']) }}
                                            {{ Form::label('image_delete', '選択済みを削除する場合はチェックしてください') }}
                                            <img class="img-thumbnail" src="{{ asset('storage/image/' . $profile[0]->image_path) }}">     
                                            <input id="image_path" type="hidden" class="form-control" name="image_path" value="{{ $profile[0]->image_path }}">
                                        @endif
                                    </div>
                                </div>

                                {{-- 自己紹介 --}}
                                <div class="form-group row d-flex align-items-center">
                                    <label for="introduction" class="col-md-3 col-form-label text-md-right">{{ __('messages.Introduction') }}</label>
                                    
                                    <div class="col-md-9">
                                        @if (isset($profile[0]->introduction))
                                            {{ Form::textarea('introduction', $profile[0]->introduction, [
                                                'id' => 'introduction',
                                                'class' => 'form-control'
                                                ]) }}
                                        @else
                                            {{ Form::textarea('introduction', "", [
                                                'id' => 'introduction',
                                                'class' => 'form-control'
                                                ]) }}
                                        @endif
                                    </div>
                                </div>

                                {{-- 保存するボタン --}}
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="fedit" value="true">
                                            {{ __('messages.Profile_Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
