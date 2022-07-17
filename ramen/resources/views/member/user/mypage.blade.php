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
                        @csrf

                        {{-- 各種メニュー --}}
                        <div class="float-right row mb-2">
                            {{ Form::open(['url' => route('mypage'), 'method' => 'get']) }}
                            <div class="pr-3 pb-2">
                                {{ Form::submit(__('messages.Top'), ['class' => 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}
                            {{ Form::open(['url' => route('profile_public'), 'method' => 'get']) }}
                            <div class="pr-3 pb-2">
                                {{ Form::submit(__('messages.Public_Profile'), ['class' => 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}
                            {{ Form::open(['url' => route('profile_edit'), 'method' => 'get']) }}
                            <div class="pr-3 pb-2">
                                {{ Form::submit(__('messages.Profile_Edit'), ['class' => 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    
                        <div class="clearfix">
                            <div class="col-md-3">
                                {{ Form::open(['url' => route('mypage'), 'method' => 'get']) }}
                                <div class="pb-3">
                                    {{-- キーワード検索フォーム --}}
                                    {{ Form::text('keyword', $keyword, ['class' => 'form-control', 'placeholder' => __('messages.Keyword')]) }}
                                </div>
                                <div class="pb-3">
                                    {{ Form::submit(__('messages.MyReview_Search'), ['class' => 'btn btn-primary']) }}
                                </div>
                                {{ Form::close() }}
                            </div>

                            <div class="mt-4 lead font-weight-bold">
                                レビュー投稿履歴
                            </div>

                            <div class="table-responsive">
                                <table class="table mt-2">
                                    <thead class="table-info">
                                        <tr>
                                            <th style="width: 35%" scope="col">{{ __('messages.Menu_Title_Table') }}</th>
                                            <th style="width: 25%" scope="col">{{ __('messages.Shop_Name_Table') }}</th>
                                            <th style="width: 10%" scope="col">{{ __('messages.Points_Table') }}</th>
                                            <th style="width: 15%" scope="col">{{ __('messages.Posted_At') }}</th>
                                            <th style="width: 15%" scope="col">{{ __('messages.Updated_At') }}</th>
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
                                                <td>
                                                    <a class="text-decoration-none text-danger" href="{{ route('shop.detail', ['shop_id' => $my_review->shop_id]) }}">
                                                        {{ $my_review->shop_name }}&nbsp{{ $my_review->branch }}
                                                    </a>
                                                </td>
                                                <td>{{ $my_review->points }}点</td>
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
                            {{-- {{ $shops->links() }} --}}
                            {{ $my_reviews -> appends(['disp' => $disp]) -> links() }}
                        </div>

                        <div class="meet">
                            表示件数：
                            {{ Form::open(['url' => route('mypage'), 'method' => 'get']) }}
                                {{ Form::select('disp', ['10' => '10', '20' => '20', '50' => '50', '100' => '100'], $disp, ['class' => 'disp', 'id' => 'disp', 'onchange' => 'submit();']) }}
                                {{ Form::hidden('keyword', $keyword) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
