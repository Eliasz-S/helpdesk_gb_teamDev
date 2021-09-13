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
            <h3> List of tickets</h3>
        </div><br>

        <div>
            @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif

            @if(session()->has('error'))
            <div class="alert alert-warning">{{ session()->get('error') }}</div>
            @endif
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer name</th>
                    <th scope="col">Customer email</th>
                    <th scope="col">Issue description</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Specialist assigned</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($issues as $issue)
                <tr>
                    <th scope="row">{{ $issue->id }}</th>
                    <th>{{ $issue->name }}</th>
                    <th>{{ $issue->email }}</th>
                    <th>{{ $issue->subject }}</th>
                    <th>{{ $issue->priority }}</th>
                    <th>{{ $issue->specialist }}</th>
                    <th><a href="{{ route('issue.edit',['issue' => $issue ]) }}">edit</a>
                    </th>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>


    </script>

</body>

</html>