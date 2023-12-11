<header class="py-3 border-bottom ext-light">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center">

            <div class="d-flex">

                <div class="ms-3">
                    <a class="btn btn-outline-secondary" href="{{ route('home') }}">На головну</a>
                </div>

                @guest()
                    <div class="ms-3">
                        <a class="btn btn-outline-success" href="{{ route('register') }}">Реєстрація</a>
                    </div>
                @endguest


            </div>

            @auth()
            <div class="d-flex">

                <div class="ms-3">

                    <a class="btn btn-outline-primary" href="{{ route('pets.create') }}">Покажіть свого компаньйона!</a>

                </div>

            </div>
            @endauth

            <div class="d-flex">

                @guest()

                    <div class="ms-3">
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">Вхід</a>
                    </div>

                @endguest()

                    @auth()
                <div class="">

                    <a  class="btn btn-outline-primary">
                        {{ auth()->user()->name ?? 'Гість' }}
                    </a>

                </div>



                <div class="ms-3">


                    <form  action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Вихід</button>
                    </form>


                </div>
                    @endauth

            </div>

        </div>

    </div>

</header>
