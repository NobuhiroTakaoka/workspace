{{-- layouts/member.blade.phpを読み込む --}}
@extends('layouts.member')


{{-- member.blade.phpの@yield('title')に'トップ - ラーメンresearch'を埋め込む --}}
@section('title', 'マイページ - ラーメンresearch')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('messages.Mypage') }}</div>

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
                    
                        <div class="float-left pb-3">
                            {{ Form::open(['route' => 'mypage', 'method' => 'get']) }}
                                <div class="pr-3 pb-2">
                                    {{-- キーワード検索フォーム --}}
                                    {{ Form::text('keyword', $keyword, [
                                        'class' => 'form-control',
                                        'placeholder' => __('messages.Keyword')
                                        ]) }}
                                </div>
                                <div class="pr-3 pb-2">
                                    {{ Form::submit(__('messages.MyReview_Search'), [
                                        'class' => 'btn btn-primary'
                                        ]) }}
                                </div>
                            {{ Form::close() }}
                        </div>

                        <div class="float-left col-10 lead font-weight-bold">
                            <span>レビュー投稿履歴</span>
                        </div>

                        <div class="clearfix">
                            <div class="table-responsive">
                                <table class="table mt-2">
                                    <thead class="table-info text-nowrap">
                                        <tr>
                                            <th scope="col">{{ __('messages.Menu_Title_Table') }}</th>
                                            <th scope="col">{{ __('messages.Shop_Name_Table') }}</th>
                                            <th scope="col">{{ __('messages.Points_Table') }}</th>
                                            <th scope="col">{{ __('messages.Posted_At') }}</th>
                                            <th scope="col">{{ __('messages.Updated_At') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-warning">
                                        @foreach ($my_reviews as $my_review)
                                            <tr>
                                                <th scope="row">
                                                    <a class="text-decoration-none text-primary" href="{{ route('shop.review_detail', ['shop_id' => $my_review->shop_id, 'review_id' => $my_review->id]) }}">
                                                        {{ $my_review->menu_title }}
                                                    </a>
                                                </th>
                                                <td class="text-nowrap">
                                                    <a class="text-decoration-none text-danger" href="{{ route('shop.detail', ['shop_id' => $my_review->shop_id]) }}">
                                                        <div>{{ $my_review->shop_name }}</div>
                                                        <div>{{ $my_review->branch }}</div>
                                                    </a>
                                                </td>
                                                <td class="text-nowrap">{{ $my_review->points }}点</td>
                                                <td>{{ $my_review->created_at->format('Y/m/d H:i') }}</td>
                                                <td>{{ $my_review->updated_at->format('Y/m/d H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-center mt-3">
                            {{-- ペジネーション結果の表示 --}}
                            {{ $my_reviews -> appends(['disp' => $disp]) -> links() }}
                        </div>

                        <div class="meet">
                            表示件数：
                            {{ Form::open(['route' => 'mypage', 'method' => 'get']) }}
                                {{ Form::select('disp', [
                                    '10' => '10',
                                    '20' => '20',
                                    '50' => '50',
                                    '100' => '100'],
                                    $disp, [
                                        'class' => 'disp',
                                        'id' => 'disp',
                                        'onchange' => 'submit();'
                                        ]) }}
                                {{ Form::hidden('keyword', $keyword) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
