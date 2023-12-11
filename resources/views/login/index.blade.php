@extends('base')

@section('page.title')

    Сторінка входу

@endsection

@section('content')

    <h1>
        Вхід
    </h1>


    <x-card>

        @if(session('error'))
            <div role="alert" class="alert alert-danger">
                <p>{{ session('error') }}</p>
            </div>
        @endif


        <x-form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <x-input name="email"></x-input>
                <x-label for="email" :required="true">Електронна пошта</x-label>
            </div>

            <div class="form-floating mb-3">
                <x-input name="password"></x-input>
                <x-label for="password" :required="true">Пароль</x-label>
            </div>

            <x-checkbox>

            </x-checkbox>

            <x-button type="submit">Увійти</x-button>

        </x-form>

    </x-card>


@endsection
