@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                <div class="card-header">{{ __('認証成功') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    {{ __('ログインしました。') }}
                    <div class="pt-3">
                        <form action="{{ route('index') }}" method="GET">
                            <input type="submit" class="btn btn-primary" value="{{ __('トップページ') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
