@extends('base')


@section('content')

    <h1>
        Домашні Компаньйони
    </h1>

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

@endsection
