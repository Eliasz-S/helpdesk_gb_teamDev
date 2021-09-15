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
                    <h6>Users list</h6>
                </div>
                <div class="col-sm">
                    <a href="#" class="btn btn-success float-right">New user+</a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Логин</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>E-mail</th>
                        <th>Роль</th>
                        <th>Дата регистрации</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($userList as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ optional($user->userRole)->description }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>