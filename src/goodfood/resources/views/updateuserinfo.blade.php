@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('情報変更') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updateuserinfo') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="row">
                        <div class="col-md-4 col-form-label text-md-right">{{ __('ユーザ名')}}
                        </div>
                        <div class="col-md-4 col-form-label text-md-left">{{ __(Auth::user()->username) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-form-label text-md-right">{{ __('名前')}}
                        </div>
                        <div class="col-md-4 col-form-label text-md-left">{{ __(Auth::user()->name) }}
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row ">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('情報更新') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                  <div class="card-footer ">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
