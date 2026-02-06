<!-- Footer -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up">
                <h5 class="fw-bold mb-3 gradient-text">Aybars.dev</h5>
                <p class="text-secondary">
                    Sürekli öğrenen, gelişen ve backend sistemler üzerine çalışan bilgisayar mühendisliği öğrencisi.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <h6 class="fw-bold mb-3">Navigasyon</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#about" class="text-secondary text-decoration-none">Hakkımda</a></li>
                    <li class="mb-2"><a href="projects.html" class="text-secondary text-decoration-none">Projeler</a>
                    </li>
                    <li class="mb-2"><a href="blog.html" class="text-secondary text-decoration-none">Blog</a></li>
                    <li class="mb-2"><a href="#contact" class="text-secondary text-decoration-none">İletişim</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <h6 class="fw-bold mb-3">Teknolojiler</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Laravel</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Python</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Docker</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">PostgreSQL</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <h6 class="fw-bold mb-3">İletişim</h6>
                <ul class="list-unstyled">
                    <li class="mb-2 text-secondary">
                        <i class="fas fa-envelope me-2"></i>aybars@example.com
                    </li>
                    <li class="mb-2 text-secondary">
                        <i class="fas fa-map-marker-alt me-2"></i>Malatya, Türkiye
                    </li>
                    <li class="mb-2 text-secondary">
                        <i class="fas fa-clock me-2"></i>Her zaman öğrenmeye açık
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-4 border-secondary border-opacity-25">
        <div class="text-center text-secondary">
            <p class="mb-0">
                © 2026 Aybars Şalvarcı. Tüm hakları saklıdır. | Built with <span class="text-danger">❤</span> and
                <span class="text-primary">Code</span>
            </p>
        </div>
    </div>
</footer>

<script src="{{asset('front/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('front/js/aos.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script src="{{asset('front/js/main.js')}}"></script>

@stack('js')
