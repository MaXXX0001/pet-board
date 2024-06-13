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
                        <img src="https://fastly.picsum.photos/id/978/200/300.jpg?hmac=sP2_huC-v5a6cNxpdmxp1FPInoDET7j7O3GoftdaEJk" class="img-fluid" alt="{{ $user->name }}">
                    </div>
                    <div class="col-md-6">
                        <h2>{{ $user->name }}</h2>
                        <p><strong>E-mail:</strong> {{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2><strong>Ваші компаньйони:</strong></h2>
        <div class="row justify-content-center mt-5">
            @foreach($pets as $pet)

                <x-pet :pet="$pet">

                </x-pet>

            @endforeach
        </div>
    </div>

    <div class="container mt-3">

        <div class="mt-4">
{{--            @auth--}}
{{--                <form action="{{ route('comment.store') }}" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="comment">Додати коментар:</label>--}}
{{--                        <textarea name="comment" id="content" class="form-control" rows="1" required></textarea>--}}
{{--                        <input type="hidden" name="pets_id" value="{{ $pet->id }}" />--}}
{{--                    </div>--}}
{{--                    <x-button type="submit">Відправити коментар</x-button>--}}
{{--                </form>--}}
{{--            @else--}}
{{--                <p>Авторизуйтесь, щоб написати коментар.</p>--}}
{{--            @endauth--}}

{{--            @if($pet->comments->count() > 0)--}}

{{--                <div class="row mt-5">--}}

{{--                    <h2>Коментарі:</h2>--}}
{{--                    <ul class="mt-3">--}}
{{--                        @foreach($pet->comments as $comment)--}}
{{--                            <div class="card mt-3">--}}
{{--                                <div class="card-body">--}}
{{--                                    <p class="card-text">{{ $comment->comment }}</p>--}}
{{--                                    <p class="text-muted">Автор: {{ $comment->user->name }}</p>--}}

{{--                                    @if(optional(auth()->user())->isAdmin() || optional(auth()->user())->id === $comment->user_id)--}}
{{--                                        <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}

{{--                                            <button type="submit" class="btn btn-danger">Видалити</button>--}}
{{--                                        </form>--}}
{{--                                    @endif--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

{{--                </div>--}}

{{--            @else--}}
{{--                <p class="mt-3">На жаль, немає коментарів для цього компаньйона.</p>--}}
{{--            @endif--}}

        </div>

    </div>

@endsection

