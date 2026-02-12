    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{Storage::url(config('settings.logo_dark'))}}" alt="{{config('settings.title')}} logo"></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}#about">Hakkımda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}#expertise">Uzmanlık</a></li>
                    <li class="nav-item"><a class="nav-link {{request()->routeIs('projects') ? 'active' : ''}}" href="{{route('projects')}}">Projeler</a></li>
                    <li class="nav-item"><a class="nav-link {{request()->routeIs('blogs') ? 'active' : ''}}" href="{{route('blogs')}}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}#contact">İletişim</a></li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-primary rounded-pill px-4" href="{{route('home')}}#contact">
                            <i class="fas fa-paper-plane me-2"></i>Birlikte Çalışalım
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
