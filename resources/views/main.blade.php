<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('materialize/css/materialize.min.css') }}"
        media="screen,projection" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<style>

.switch label input[type=checkbox]:checked+.lever {
    background-color: #84c7c1;
}
.switch label input[type=checkbox][disabled]+.lever:after, .switch label input[type=checkbox][disabled]:checked+.lever:after {
    background-color: #26a69a;
}
body {
background-color:red;
background-color: #e8eef1;
}
.page-footer {
background-color: #2e3131;
}


}
</style>
</head>

<body>

    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content" style="min-width:15%">

        <li><a href="/credits?filter=today">ödəniş gözləyənlər</a></li>
        <li><a href="/credits?filter=active">aktiv kreditlər</a></li>
        <li><a href="/credits?filter=closed">bağlanmış kreditlər</a></li>
        <li><a href="/credits?filter=delayed">gecikmədə olan kreditlər</a></li>


    </ul>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo"><img src="https://iili.io/JGTkaON.png" alt="JGTkaON.png" height="60" border="0"></a>
            <ul class="right hide-on-med-and-down">
          
                <li><a href="/statics">statistika</a></li>
                <li><a href="/customers">müştərilər</a></li>
                <li><a href="/auth/users">mütəxəssislər</a></li>
                <!-- Dropdown Trigger -->
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">kreditlər<i
                            class="material-icons right">arrow_drop_down</i></a></li>
                ` @auth
                    <li><a href="/">{{ auth()->user()->name }} {{ auth()->user()->lastname }}  {{ auth()->user()->middlename }}</a></li>

                @endauth
                </p>


            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">

        <li style="padding-top:15px"></li>
        @auth
            @if (auth()->user()->status == 3)
                <li><a href="/users"><i class="material-icons">accessibility</i> istifadeciler</a></li>
            @endif
            <li><a href="/logout"><i class="material-icons">flight</i>cixis et</a></li>

        @endauth
        @guest
            <li><a href="/login"><i class="material-icons">assignment_ind</i> giris et</a></li>
        @endguest



    </ul>

    <div class="col s12 m7" style="padding-left: 50px;padding-right: 50px">
        <h2 class="header"></h2>
        <div class="card horizontal">
            <div class="card-image">
                {{-- <img src="https://lorempixel.com/100/190/nature/6"> --}}
            </div>

            <div class="card-stacked">
                <div class="card-content">
                    @yield('passage')
                </div>
                <div class="card-content">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>


    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Texnologiyalar</h5>
                    <p class="grey-text text-lighten-4">

                        DART Flutter <br>
                        FIREBASE FCM <br>
                        PHP - Laravel <br>
                        CSS - MATERALIZE <br>
                        JS - JQUERY
                    </p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Linkler</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Websignal qurulumu</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2023 WEBSIGNAL
                {{-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> --}}
            </div>
        </div>
    </footer>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="{{ asset('materialize/js/materialize.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('materialize/js/materialize.min.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function() {
            $('.sidenav').sidenav();
            $('.dropdown-trigger').dropdown();
        });
    </script>






    {{-- SWEET ALERT  --}}
</body>

</html>
