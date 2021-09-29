@extends('admin.index')
@section('title')Account @parent @stop
@section('breadcrumbs-1')Admin @stop
@section('breadcrumbs-2')Account @stop
@section('content')
<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{ asset("admin/img/curved-images/curved0.jpg") }}'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
  </div>
  <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="{{ asset('admin/img/bruce-mars.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ $user->name }}
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            Role: {{ $user->description }}
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid py-4">
  <div class="row">
    <div class="col-12 col-xl-4">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-md-8 d-flex align-items-center">
              <h6 class="mb-0">Profile Information</h6>
            </div>
            <div class="col-md-4 text-end">
              <a href="javascript:;">
                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Edit Profile" aria-label="Edit Profile"></i><span class="sr-only">Edit Profile</span>
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <hr class="horizontal gray-light my-4">
          <ul class="list-group">
            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ $user->first_name }} {{ $user->last_name }}</li>
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $user->email }}</li>
            @if ( $user->email_verified_at !== NULL)
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email verified:</strong>
                    <span class="badge badge-sm bg-gradient-success">YES</span>
                </li>
            @else
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email verified:</strong>
                    <span class="badge badge-sm bg-gradient-danger">NO</span>
                </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
    <div class="col-12 col-xl-8">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Messages: </h6>
        </div>
        <div class="card-body p-3">
          <ul class="list-group">
            <!-- <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
              <div class="avatar me-3">
                <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
              </div>
              <div class="d-flex align-items-start flex-column justify-content-center">
                <h6 class="mb-0 text-sm">Sophie B.</h6>
                <p class="mb-0 text-xs">Hi! I need more information..</p>
              </div>
              <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
    </div>
    </div>
@endsection