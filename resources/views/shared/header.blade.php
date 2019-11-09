@include('shared.auth-navbar')
<header class="site-logo p-2">


    <nav class="navbar list-group navbar-expand-lg">

        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/cesi-logo.png') }}" alt="CESi" height="76">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Évènements
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('events', ['type' => 'month']) }}">Du mois</a>
                        <a class="dropdown-item" href="{{ route('events', ['type' => 'past']) }}">Passés</a>
                        <a class="dropdown-item" href="{{ route('events', ['type' => 'future']) }}">Future</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events', ['type' => 'suggestions']) }}">Boite à idée</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Boutique</a>
                </li>
            </ul>
        </div>
    </nav>

</header>
