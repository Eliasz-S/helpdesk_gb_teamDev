@if ($errors->any())
    <div class="timeline-block mb-3">
      <span class="timeline-step">
        <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
      </span>
      <div class="timeline-content">
        @foreach($errors->all() as $error)
            <p class="bg-warning p-2 col-lg-6 rounded">
                {{ $error }}
            </p>
        @endforeach
      </div>
    </div>
@endif

{{--@if(session()->has('error'))--}}
{{--    <div class="alert alert-warning">{{ session()->get('error') }}</div>--}}
{{--@endif--}}

@if(session()->has('success'))
    <div class="timeline-block mb-3">
      <span class="timeline-step">
        <i class="fa fa-check text-success" aria-hidden="true"></i>
      </span>
      <div class="timeline-content">
            <p class="bg-gradient-success p-2 col-lg-6 rounded text-white">
              Ticket successfully created!
            </p>
      </div>
    </div>
@endif
