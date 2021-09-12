@extends('layouts.app')

@section('content')
    <h1>Создать заявку</h1>
    <div class="form">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('create-ticket') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>
                    <span>Имя</span>
                    <input name="name" class="field create-ticket" type="text" value="" placeholder="Введите ваше имя">
                </label>
            </div>

            <div class="form-group">
                <label>
                    <span>Email</span>
                    <input name="email" class="field create-ticket" type="text" value="" placeholder="Введите ваш email">
                </label>
            </div>

            <div class="form-group">
                <label>
                    <span>Категория</span>
                    <select name="type_id" class="select create-ticket" id="type">
{{--                        TODO: брать данные из таблицы --}}
                        <option value="">Выберите категорию</option>
                        <option value="3">Customization</option>
                        <option value="2">Query</option>
                        <option value="1">support</option>
                    </select>
                </label>
            </div>

            <div class="form-group">
                <label>
                    <span>Тема</span>
                    <input name="subject" class="field create-ticket" type="text" value="" placeholder="Тема заявки">
                </label>
            </div>

            <div class="form-group">
                <label>
                    <span>Сообщение</span>
                    <textarea name="message" class="field create-ticket grammarly-fix-message" type="text" placeholder="Текст сообщения"></textarea>
                </label>
            </div>

{{--            <div class="form-group attachment-block no-error-success-icon" id="attachment-option">--}}
{{--                <label>--}}
{{--                    <span class="file-label">Добавить вложение</span>--}}
{{--                </label>--}}
{{--            </div>--}}

            <div class="form-group">
                <button type="submit" id="create-ticket-btn" class="btn">Создать заявку</button>
            </div>
        </form>
    </div>
@endsection
