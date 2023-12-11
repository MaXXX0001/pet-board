@extends('base')

@section('content')

    <h1>Редагування компаньйона</h1>

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

                <form method="POST" action="{{ route('pets.update', $pet->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-floating mb-3">
                        <input type="text" name="name" value="{{ old('name', $pet->name) }}" class="form-control">
                        <x-label for="name">Кличка</x-label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="breed" value="{{ old('breed', $pet->breed) }}" class="form-control">
                        <x-label for="breed">Порода</x-label>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Опис компаньйона:</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Введіть опис..." rows="4" required>{{ old('description', $pet->description) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Завантажити фотографію:</label>
                        <input type="file" name="image" id="image" class="form-control-file"  onchange="previewImage()">
                        <img id="imagePreview" src="{{ asset('storage/' . $pet->image_path) }}" alt="Preview" class="mt-2" style="max-width: 100%">
                    </div>

                    <button type="submit" class="btn btn-success mb-3">Оновити компаньйона</button>
                </form>


            </div>
        </div>
    </div>

@endsection
