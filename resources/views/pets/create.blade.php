@extends('base')

@section('content')

    <h1>

        Покажіть свого компаньйона!

    </h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="list-unstyled ">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container">
        <div class="row justify-content-center">
            <div>

                <x-form method="POST" action="{{ route('pets.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-floating mb-3">
                        <x-input name="name"></x-input>
                        <x-label for="name" :required="true">Кличка</x-label>
                    </div>

                    <div class="form-floating mb-3">
                        <x-input name="breed"></x-input>
                        <x-label for="breed" :required="true">Порода</x-label>
                    </div>

                    <div class="form-group mb-3">
                        <x-label for="description">Опис компаньйона:</x-label>
                        <textarea name="description" id="description" class="form-control" placeholder="Введіть опис..." rows="4" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <x-label for="image">Завантажити фотографію:</x-label>
                        <input type="file" name="image" id="image" class="form-control-file" required onchange="previewImage()">
                        <img id="imagePreview" src="#" alt="Preview" class="d-none mt-2" style="max-width: 100%">
                    </div>

                    <x-button type="submit" class="btn btn-success mb-3">Додати компаньйона</x-button>
                </x-form>

            </div>
        </div>
    </div>

@endsection
