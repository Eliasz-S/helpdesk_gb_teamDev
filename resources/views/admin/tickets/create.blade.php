@extends('layouts.dashboard')
@section('title')Tickets @parent @stop
@section('breadcrumbs-1')Admin @stop
@section('breadcrumbs-2')New ticket @stop
@section('content')
<div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card h-100">
        <div class="card-header pb-0">
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-primary float-right">
                <i class="fa fa-chevron-left text-white me-1" aria-hidden="true"></i> All tickets
            </a>
            <h6>Please submit here your problem</h6>
        </div>
        <div class="card-body p-3">
          <div class="timeline timeline-one-side">
            <form method="post" action="{{ route('admin.tickets.store') }}" enctype="multipart/form-data">
            @csrf
            
            @include('inc.ticketCreate-message')

            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="fa fa-user-circle-o text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <label for="name">Full name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="fa fa-envelope text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}" >
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="fa fa-pencil-square text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" aria-describedby="subjectHelp" value="{{ old('subject') }}" >
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="fa fa-commenting text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <label for="subject">Message</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="5">{{ old('message') }}</textarea>
                <small id="subjectHelp" class="form-text text-muted">Please describe your problem here</small>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="fa fa-bars text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <fieldset>
                  <select name="type_id" class="form-control" id="type_id" >
                      {{--TODO: брать данные из таблицы --}}
                      <option value="">Category</option>
                      <option value="1">support</option>
                      <option value="2">Query</option>
                      <option value="3">Customization</option>
                  </select>
              </fieldset>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="fa fa-bars text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <fieldset>
                  <select name="priority_id" class="form-control" id="priority_id" >
                      <option value="">priority</option>
                      <option value="1">Low</option>
                      <option value="2">Medium</option>
                      <option value="3">High</option>
                  </select>
                </fieldset>
              </div>
            </div>
            <button type="submit" class="btn bg-gradient-success mx-5">Create new ticket</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection