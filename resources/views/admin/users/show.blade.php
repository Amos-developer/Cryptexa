@extends('admin.layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')
@section('page-description', $user->name)

@section('breadcrumb')
<li><a href="{{ route('admin.users.index') }}">Users</a></li>
<li class="active">{{ $user->name }}</li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-4">
    <!-- User Profile -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ asset('admin-assets/dist/img/user2-160x160.jpg') }}" alt="User profile">
        <h3 class="profile-username text-center">{{ $user->name }}</h3>
        <p class="text-muted text-center">
          @if($user->role == 'admin')
            <span class="label label-danger">Administrator</span>
          @else
            <span class="label label-primary">User</span>
          @endif
        </p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Account ID</b> <a class="pull-right"><code>{{ $user->account_id }}</code></a>
          </li>
          <li class="list-group-item">
            <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
          </li>
          <li class="list-group-item">
            <b>Balance</b> <a class="pull-right text-green">${{ number_format($user->balance ?? 0, 2) }}</a>
          </li>
          <li class="list-group-item">
            <b>Referral Code</b> <a class="pull-right"><code>{{ $user->referral_code }}</code></a>
          </li>
          <li class="list-group-item">
            <b>Referrals</b> <a class="pull-right">{{ $user->referrals()->count() }}</a>
          </li>
          <li class="list-group-item">
            <b>Joined</b> <a class="pull-right">{{ $user->created_at->format('M d, Y') }}</a>
          </li>
        </ul>

        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-block"><b>Edit User</b></a>
      </div>
    </div>

    <!-- Balance Management -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Balance Management</h3>
      </div>
      <div class="box-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="margin-bottom">
          @csrf
          @method('PUT')
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input type="number" step="0.01" min="0" name="balance" class="form-control" placeholder="New Balance" value="{{ $user->balance }}" required>
            <span class="input-group-btn">
              <button type="submit" class="btn btn-success">Update Balance</button>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <!-- Activity Timeline -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Recent Activity</h3>
      </div>
      <div class="box-body">
        <ul class="timeline timeline-inverse">
          <li class="time-label">
            <span class="bg-blue">Account Information</span>
          </li>
          <li>
            <i class="fa fa-user bg-aqua"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ $user->created_at->diffForHumans() }}</span>
              <h3 class="timeline-header">Account Created</h3>
              <div class="timeline-body">
                User registered on {{ $user->created_at->format('F d, Y at H:i') }}
              </div>
            </div>
          </li>
          @if($user->email_verified_at)
          <li>
            <i class="fa fa-check bg-green"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ $user->email_verified_at->diffForHumans() }}</span>
              <h3 class="timeline-header">Email Verified</h3>
            </div>
          </li>
          @endif
          <li>
            <i class="fa fa-clock-o bg-gray"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
