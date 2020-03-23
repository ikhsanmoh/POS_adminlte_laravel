@extends('layouts.master-login')

@section('title')
  Web Admin - Login
@endsection

@section('konten')

<div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="login" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" placeholder="Email address" name="username" required="required" autofocus="autofocus">
              <label for="inputEmail">Username or Email Address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          {{-- <a class="btn btn-primary btn-block" href="web-admin/dashboard">Login</a> --}}
          <input type="submit" value="Log">
        </form>

  @endsection