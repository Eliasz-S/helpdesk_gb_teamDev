<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </link>
</head>

<body>



    <div class="container"> <br>
        <div class="header">
            <h3>Update issue</h3>
        </div><br>

        <form method="post" action="{{ route('issue.update', ['issue' => $issue]) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="id">ID</label>
                <input type="number" class="form-control" id="id" name="id" value="{{ $issue->id }}" readonly>
            </div><br>

            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $issue->name }}" readonly>
            </div><br>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $issue->email }}" readonly>
            </div><br>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" value="{{ $issue->subject }}" readonly>
            </div><br>

            <div class="form-group">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-control">

                    <option value="low" @if($issue->priority == "low") selected @endif>
                        low
                    </option>
                    <option value="medium" @if($issue->priority == "medium") selected @endif>
                        medium
                    </option>
                    <option value="high" @if($issue->priority == "high") selected @endif>
                        high
                    </option>
                </select>

            </div><br>

            <div class="form-group">
                <label for="specialist">Specialist</label>
                <input type="text" class="form-control" id="specialist" name="specialist" value="{{ $issue->specialist }}">
            </div><br>

            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>