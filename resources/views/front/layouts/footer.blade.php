<!-- Footer -->
<footer class="site-footer">
    <div class="container">

        <!-- Main Footer Content -->
        <div class="footer-main">

            <!-- Logo & Description -->
            <div class="footer-col footer-about">
                <a href="{{ route('home') }}" class="footer-logo">
                    <img src="{{ asset(Storage::url(config('settings.logo_dark'))) }}"
                         alt="{{ config('settings.title') }}">
                </a>
                <p class="footer-desc">
                    {{config('settings.footer_description')}}
                </p>
                <div class="footer-social">
                    <a href="https://github.com/{{config('settings.github')}}" target="_blank" rel="noopener" aria-label="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="{{config('settings.linkedin')}}" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="mailto:{{config('settings.email')}}" aria-label="Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="{{config('settings.twitter')}}" target="_blank" rel="noopener" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div class="footer-col">
                <h6>Keşfet</h6>
                <ul>
                    <li><a href="#about">Hakkımda</a></li>
                    <li><a href="{{route('projects')}}">Projeler</a></li>
                    <li><a href="{{route('blogs')}}">Blog</a></li>
                    <li><a href="#contact">İletişim</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-col">
                <h6>İletişim</h6>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{config('settings.email')}}">{{config('settings.email')}}</a>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{config('settings.address')}}</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>{{config('settings.working_hours')}}</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>{!!config('settings.footer_text')!!}</p>
        </div>

    </div>
</footer>

<script src="{{asset('front/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('front/js/aos.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao="
        crossorigin="anonymous"></script>
<script src="{{asset('front/js/main.js')}}"></script>

@stack('js')
