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
    
    <div class="card mb-4">
        <div class="container mt-4 mb-2">
            <div class="row mt-4">
                <div class="col-sm">
                    <i class="fas fa-table me-1"></i>
                    <h6>Tickets List</h6>
                </div>
                <div class="col-sm">
                    <a href="{{ route('admin.tickets.create') }}" class="btn btn-success float-right">New ticket +</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Subject</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Date of addition</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($ticketsList as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->name }}</td>
                        <td>{{ $ticket->email }}</td>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ $ticket->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>