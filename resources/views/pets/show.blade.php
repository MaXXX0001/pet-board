@extends('base')

@section('content')

    @if(session('success'))
        <div class="alert alert-success form-floating mx-auto" style="max-width: 50%;">
            {{ session('success') }}
        </div>
    @endif


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $pet->image_path) }}" class="img-fluid" alt="{{ $pet->name }}">
                    </div>
                    <div class="col-md-6">
                        <h2>{{ $pet->name }}</h2>
                        <p><strong>Порода:</strong> {{ $pet->breed }}</p>
                        <p><strong>Опис:</strong> {{ $pet->description }}</p>
                        <p><strong>Власник:</strong> {{ $pet->owner->name }}</p>

                        @if($pet && (optional(auth()->user())->isAdmin() || (isset($pet) && auth()->user() && auth()->user()->id === $pet->author_id)))

                            @if(!$pet->isApproved())
                                <x-form action="{{ route('pets.approve', $pet->id) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-success mt-2" type="submit">Прийняти</button>
                                </x-form>
                            @endif

                            <form id="delete-form" action="{{ route('pets.destroy', ['pets' => $pet->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mt-2" type="submit" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                    Видалити
                                </button>
                            </form>

                            <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-warning mt-2">Редагувати</a>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-3">

        <div class="mt-4">
            @auth
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Додати коментар:</label>
                        <textarea name="comment" id="content" class="form-control" rows="1" required></textarea>
                        <input type="hidden" name="pets_id" value="{{ $pet->id }}" />
                    </div>
                    <x-button type="submit">Відправити коментар</x-button>
                </form>
            @else
                <p>Авторизуйтесь, щоб написати коментар.</p>
            @endauth

            @if($pet->comments->count() > 0)

                <div class="row mt-5">

                    <h2>Коментарі:</h2>
                    <ul class="mt-3">
                        @foreach($pet->comments as $comment)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <p class="card-text">{{ $comment->comment }}</p>
                                    <p class="text-muted">Автор: {{ $comment->user->name }}</p>

                                    @if(optional(auth()->user())->isAdmin() || optional(auth()->user())->id === $comment->user_id)
                                        <a href="{{ route('comment.destroy', ['comment' => $comment->id]) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $comment->id }}').submit();">
                                            Видалити
                                        </a>

                                        <form id="delete-comment-form-{{ $comment->id }}" action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </ul>

                </div>

            @else
                <p class="mt-3">На жаль, немає коментарів для цього компаньйона.</p>
            @endif

        </div>

    </div>


@endsection


{{--@if($pet && (optional(auth()->user())->isAdmin() || (isset($pet) && auth()->user() && auth()->user()->id === $pet->author_id)))--}}

{{--    @if(!$pet->isApproved())--}}
{{--        <x-form action="{{ route('pets.approve', $pet->id) }}" method="post">--}}
{{--            @method('put')--}}
{{--            @csrf--}}
{{--            <button class="btn btn-success mt-2" type="submit">Прийняти</button>--}}
{{--        </x-form>--}}
{{--    @endif--}}

{{--    <a class="btn btn-danger mt-2" href="{{ route('pet.destroy', ['pets' => $pet->id]) }}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">--}}
{{--        Видалити--}}
{{--    </a>--}}

{{--    <form id="delete-form" action="{{ route('pet.destroy', ['pets' => $pet->id]) }}" method="POST" style="display: none;">--}}
{{--        @csrf--}}
{{--        @method('DELETE')--}}
{{--    </form>--}}

{{--    <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-warning mt-2">Редагувати</a>--}}

{{--@endif--}}
