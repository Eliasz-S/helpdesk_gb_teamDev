<h1>Привет, {{ Auth::user()->name }}!</h1>
<br>
<a href="{{ url('/') }}">На главную</a>
<br>
@if ($userRole === 'ROLE_ADMIN')
    <a href="{{ route('admin.users.index') }}">Список пользователей</a>
    <br>
@endif
<a href="{{ route('logout') }}">Выйти из профиля</a>