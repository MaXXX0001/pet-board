@extends('base')


@section('content')

    <h1>
        Домашні Компаньйони
    </h1>

    <form action="{{ route('home') }}" method="GET">
        <input type="text" name="name" placeholder="Ім'я" value="{{ $request->input('name') }}" >
        <input type="text" name="breed" placeholder="Порода" value="{{ $request->input('breed') }}" >
        <x-button type="submit" class="mb-3 ms-1">Знайти</x-button>
    </form>

    @if(session('success'))
        <div class="alert alert-success form-floating mx-auto" style="max-width: 50%;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger form-floating mx-auto" style="max-width: 50%;">
            {{ session('error') }}
        </div>
    @endif


    <div class="container ">
        <div class="row justify-content-center mt-5">


            @foreach($pets as $pet)

                <x-pet :pet="$pet">


                </x-pet>

            @endforeach


        </div>
    </div>

    <div class="container">

        <div class="mb-3">
            {{ $pets->links() }}
        </div>

    </div>

@endsection
