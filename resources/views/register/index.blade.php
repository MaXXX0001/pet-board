@extends('base')

@section('page.title')
    Сторінка реєстрації
@endsection

@section('content')

    <h1>
        Реєстрація
    </h1>


    <x-card>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="list-unstyled">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <x-input name="name"></x-input>
                <x-label for="name" :required="true">Ім'я</x-label>
            </div>

            <div class="form-floating mb-3">
                <x-input name="email"></x-input>
                <x-label for="email" :required="true">Електронна пошта</x-label>
            </div>

            <div class="form-floating mb-3">
                <x-input name="password"></x-input>
                <x-label for="password" :required="true">Пароль</x-label>
            </div>

            <x-button type="submit">Зареєструватись</x-button>

        </x-form>

    </x-card>

@endsection


