@extends('layouts.dashboard-admin')
@section('title')Users @parent @stop
@section('breadcrumbs-1')Admin @stop
@section('breadcrumbs-2')Users @stop
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between">
          <h6>User List</h6>
          <a href="#" class="btn btn-success float-right">New user +</a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="25px">#ID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Login</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Of Addition</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($userList as $user)
                <tr>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                    </td>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('admin/img/team-3.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $user->name }} 
                            @if ($user->first_name )
                                | {{ $user->first_name }} {{ $user->last_name }}
                            @endif
                        </h6>
                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="badge badge-sm bg-gradient-success">{{ optional($user->userRole)->description }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{ $user->created_at }}</p>
                  </td>
                  <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        <i class="fa fa-pencil-square-o sbadge badge-sm bg-gradient-primary color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                    </a>
                    &nbsp; | &nbsp;
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                       <i class="fa fa-trash sbadge badge-sm bg-gradient-danger color-white text-white px-1 rounded h6" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    @endsection