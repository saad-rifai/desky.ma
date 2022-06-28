<nav class="navbar navbar-expand-lg f1-head-nav fixed-top  nav-standard">
    <div class="container">
        <button class="navbar-toggler btn-tg-black" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="{{asset('/')}}"><img class="nav-logo"
                src="{{asset('img/logo-web.png')}}" alt="logo desky"></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">
                <li class="nav-item">
                    <a class="nav-link  effect-line @yield('active-1')" aria-current="page" href="{{asset('/')}}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link effect-line @yield('active-2')" href="{{asset('chercheurs-de-marché')}}">Chercheurs de marché</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link effect-line @yield('active-3')" href="{{asset('les-appel-doffre')}}">les appel d’offre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link effect-line @yield('active-4')" href="#">les tarif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link effect-line @yield('active-5')" href="{{asset('qui-sommes-nous')}}">Qui sommes-nous</a>
                </li>
                <li class="nav-item dropdown change-lang">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        FR
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="#">AR</a></li>

                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">

                <button type="button" class="btn btn-link">se connecter</button>
                <button type="button" class="btn btn-primary">s'inscrire</button>

            </form>
        </div>
    </div>
</nav>