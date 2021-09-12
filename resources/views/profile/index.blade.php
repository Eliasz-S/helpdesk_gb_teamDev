<h1>Привет, {{ Auth::user()->name }}!</h1>
<br>
<a href="{{ url('/') }}">На главную</a>
<br>
<a href="{{ route('logout') }}">Выйти из профиля</a>