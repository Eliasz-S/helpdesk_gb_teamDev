<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"></link>
    <title>Users</title>
</head>
<body>

<body>

  <div class="container"> <br>
    <div class="header">
      <h3> Please submit here your problem</h3>
    </div>
    <div>
      @if(session()->has('success'))
      <div class="alert alert-success">{{ session()->get('success') }}</div>
      @endif

      @if(session()->has('error'))
      <div class="alert alert-warning">{{ session()->get('error') }}</div>
      @endif
    </div>

    <br>
    <form method="post" action="{{ route('admin.tickets.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group col-md-6">
        <label for="name">Full name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" aria-describedby="subjectHelp" value="{{ old('subject') }}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="subject">Message</label>
        <textarea class="form-control" name="message" id="message" cols="30" rows="5">{{ old('message') }}</textarea>
        <small id="subjectHelp" class="form-text text-muted">Please describe your problem here</small>
      </div>
      
      <div class="form-group col-md-6">
        <fieldset>
          <select name="type_id" class="form-control" id="type_id" required>
              {{--TODO: брать данные из таблицы --}}
              <option value="">Category</option>
              <option value="1">support</option>
              <option value="2">Query</option>
              <option value="3">Customization</option>
          </select>
      </fieldset>
      </div>
        <div class="form-group col-md-6">
          <fieldset>
            <select name="priority_id" class="form-control" id="priority_id" required>
                <option value="">priority</option>
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
            </select>
          </fieldset>
        </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>