@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Change Password
    </h1><br>
</div>
@stop
@section('content')
<div class="dt-card">
   <div class="dt-card__body">
      <form action={{ route('user.password.change') }} method="POST">
         @csrf
         @method('PATCH')

         <div class="row">
            <div class="col-6">
               <div class="form-group">
                  <label for="password">Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter New Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
               </div>
            </div>
            <div class="col-6">
               <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat Password">
            </div>

            <div class="col-12">
               <button type="submit" class="btn btn-sm btn-success">Reset Password</button>
            </div>
         </div>
      </form>
   </div>
</div>
@stop