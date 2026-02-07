@extends('front.layouts.master')

@section('title', "")

@push('css')
    <style>
        .blog-card:hover .blog-image-wrapper img {
            transform: scale(1.1);
        }

        .blog-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .blog-card:hover {
            border-color: rgba(99, 102, 241, 0.4);
            transform: translateY(-5px);
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="mb-3">
                        <span
                            class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill border border-primary border-opacity-25">
                            <i class="fas fa-code me-2"></i>Computer Engineering Student
                        </span>
                    </div>
                    <h1 class="hero-title">
                        Kodla<br>
                        <span class="gradient-text">Sistemler</span><br>
                        İnşa Et.
                    </h1>
                    <p class="hero-subtitle">Bilgisayar Mühendisliği Öğrencisi & Backend Developer</p>
                    <p class="hero-description">
                        Öğrenmeye ve gelişmeye açık bir bilgisayar mühendisliği öğrencisi olarak, sürdürülebilir ve
                        ölçeklenebilir backend sistemler geliştirmeye odaklanıyorum. Her proje ile clean architecture
                        ve best practices öğrenmeye devam ediyorum.
                    </p>
                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <a href="projects.html" class="btn btn-primary btn-lg rounded-pill px-4">
                            <i class="fas fa-folder-open me-2"></i>Projelerimi İncele
                        </a>
                        <a href="#contact" class="btn btn-outline-light btn-lg rounded-pill px-4">
                            <i class="fas fa-envelope me-2"></i>İletişime Geç
                        </a>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-5" data-aos="fade-left">
                    <div class="terminal floating">
                        <div class="terminal-buttons">
                            <div class="terminal-button red"></div>
                            <div class="terminal-button yellow"></div>
                            <div class="terminal-button green"></div>
                        </div>
                        <div class="terminal-content">
                            <div class="terminal-line">
                                <span class="prompt">➜</span> <span class="command">whoami</span>
                            </div>
                            <div class="terminal-line output">
                                Aybars Şalvarcı - Bilgisayar Mühendisliği Öğrencisi
                            </div>
                            <div class="terminal-line">
                                <span class="prompt">➜</span> <span class="command">cat ./focus.txt</span>
                            </div>
                            <div class="terminal-line output">
                                "Her gün biraz daha iyi kod yazmayı öğreniyorum"
                            </div>
                            <div class="terminal-line">
                                <span class="prompt">➜</span> <span class="command">echo $STATUS</span>
                            </div>
                            <div class="terminal-line output">
                                Öğreniyor, geliştiriyor, büyüyor 🚀
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4" data-aos="fade-up">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Projeler</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">8+</div>
                        <div class="stat-label">Teknoloji</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">1.5Y</div>
                        <div class="stat-label">Deneyim</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">∞</div>
                        <div class="stat-label">Motivasyon</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GitHub Stats & Analytics -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">GitHub İstatistiklerim</h2>
                <p class="section-subtitle">
                    Kod yazma alışkanlıklarım ve GitHub aktivitelerim (Otomatik Güncellenir)
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                    <div class="bento-card h-100 text-center d-flex flex-column justify-content-center p-4">
                        <h4 class="fw-bold mb-4">Genel Bakış</h4>
                        <div class="stats-container">
                            <img
                                src="https://github-profile-summary-cards.vercel.app/api/cards/stats?username=aybarsalvarci&theme=radical"
                                alt="GitHub Stats" class="img-fluid rounded" style="min-height: 200px;"/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="bento-card h-100 text-center d-flex flex-column justify-content-center p-4">
                        <h4 class="fw-bold mb-4">En Çok Kullanılan Diller</h4>
                        <div class="stats-container">
                            <img
                                src="https://github-profile-summary-cards.vercel.app/api/cards/most-commit-language?username=aybarsalvarci&theme=radical"
                                alt="Top Languages" class="img-fluid rounded" style="min-height: 200px;"/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="bento-card text-center p-4">
                        <h4 class="fw-bold mb-4">Haftalık Aktivite Grafiği</h4>
                        <div class="stats-container">
                            <img
                                src="https://github-profile-summary-cards.vercel.app/api/cards/profile-details?username=aybarsalvarci&theme=radical"
                                alt="GitHub Profile Details" class="img-fluid w-100 rounded"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-4 justify-content-center">
                <div class="col-auto" data-aos="zoom-in" data-aos-delay="400">
                    <img
                        src="https://img.shields.io/github/repos/aybarsalvarci?color=6366f1&style=for-the-badge&logo=github"
                        alt="Repos"/>
                </div>
                <div class="col-auto" data-aos="zoom-in" data-aos-delay="500">
                    <img
                        src="https://img.shields.io/github/followers/aybarsalvarci?color=8b5cf6&style=for-the-badge&logo=github"
                        alt="Followers"/>
                </div>
                <div class="col-auto" data-aos="zoom-in" data-aos-delay="600">
                    <img
                        src="https://img.shields.io/github/stars/aybarsalvarci?color=f59e0b&style=for-the-badge&logo=github"
                        alt="Stars"/>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="https://github.com/aybarsalvarci" target="_blank"
                   class="btn btn-primary btn-lg rounded-pill px-5">
                    <i class="fab fa-github me-2"></i>GitHub Profilimi Ziyaret Et
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container py-5">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Hakkımda</h2>
                <p class="section-subtitle">
                    Backend sistemler ve temiz kod mimarisi öğrenmeye odaklanan bir bilgisayar mühendisliği öğrencisi
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="bento-card">
                        <div class="card-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Öğrenme Yolculuğum</h3>
                        <p class="text-secondary mb-4">
                            Bilgisayar mühendisliği eğitimim boyunca, sadece kod yazmanın yeterli olmadığını,
                            kodun okunabilir, sürdürülebilir ve test edilebilir olması gerektiğini öğrendim.
                            Her proje ile bu prensipleri daha iyi anlamaya çalışıyorum.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="tech-tag">Clean Code</span>
                            <span class="tech-tag">Best Practices</span>
                            <span class="tech-tag">Sürekli Öğrenme</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="bento-card">
                        <div class="card-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Teknik Yetkinlikler</h3>
                        <p class="text-secondary mb-4">
                            Eğitimim ve kişisel projelerim boyunca edindiğim teknolojiler ve odaklandığım alanlar.
                        </p>
                        <ul class="text-secondary mt-3 mb-0">
                            <li class="mb-2">Backend Development (Laravel, Python, Java)</li>
                            <li class="mb-2">RESTful API Design & Authentication</li>
                            <li class="mb-2">Relational Databases (MySQL, PostgreSQL)</li>
                            <li class="mb-2">Docker & Development Tools</li>
                            <li>Version Control (Git, GitHub)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section id="expertise" class="py-5">
        <div class="container py-5">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Öğrendiğim Teknolojiler</h2>
                <p class="section-subtitle">
                    Eğitimim ve projelerim boyunca çalıştığım teknolojiler ve araçlar
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="bento-card text-center">
                        <div class="card-icon mx-auto">
                            <i class="fas fa-server"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Backend Development</h4>
                        <p class="text-secondary mb-4">RESTful API'ler, authentication sistemleri ve database tasarımı
                        </p>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <span class="tech-tag">Laravel</span>
                            <span class="tech-tag">Python</span>
                            <span class="tech-tag">Java</span>
                            <span class="tech-tag">REST API</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="bento-card text-center">
                        <div class="card-icon mx-auto">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Database Systems</h4>
                        <p class="text-secondary mb-4">İlişkisel veritabanları ve query optimizasyonu</p>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <span class="tech-tag">MySQL</span>
                            <span class="tech-tag">PostgreSQL</span>
                            <span class="tech-tag">SQL</span>
                            <span class="tech-tag">Optimization</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="bento-card text-center">
                        <div class="card-icon mx-auto">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h4 class="fw-bold mb-3">DevOps & Tools</h4>
                        <p class="text-secondary mb-4">Containerization ve modern development tooling</p>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <span class="tech-tag">Docker</span>
                            <span class="tech-tag">Git</span>
                            <span class="tech-tag">Linux</span>
                            <span class="tech-tag">CI/CD</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Öne Çıkan Projeler</h2>
                <p class="section-subtitle">
                    Öğrenme sürecimde geliştirdiğim seçilmiş projeler
                </p>
            </div>
            <div class="row g-4">
                @foreach($projects as $project)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="project-card h-100"> {{-- Görsel Alanı --}}
                            @if($project->image)
                                <div class="project-image-wrapper mb-3">
                                    <img src="{{ Storage::url($project->image) }}"
                                         alt="{{ $project->name }}"
                                         class="img-fluid rounded project-img">
                                </div>
                            @endif

                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="card-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="{{$project->icon}}"></i>
                                </div>
                                @if($project->link != null)
                                    <a href="{{$project->link}}" target="_blank" class="text-primary">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @endif
                            </div>

                            <h3 class="project-title">{{$project->name}}</h3>
                            <p class="project-description mb-4">
                                {!! $project->description !!}
                            </p>

                            <div class="d-flex flex-wrap gap-2 mt-auto"> @foreach(explode(",", $project->keys) as $key)
                                    <span class="tech-tag">{{trim($key)}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="projects.html" class="btn btn-outline-light btn-lg rounded-pill px-5">
                    <i class="fas fa-folder-open me-2"></i>Tüm Projeleri Gör
                </a>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Son Yazılar</h2>
                <p class="section-subtitle">
                    Öğrendiklerimi ve deneyimlerimi paylaştığım teknik yazılar
                </p>
            </div>
            <div class="row g-4">
                @foreach($blogs as $blog)
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{$loop->iteration * 100}}">
                        <a href="{{ route('blog.detail', $blog->slug) }}" class="text-decoration-none">
                            <div
                                class="bento-card blog-card p-0 overflow-hidden">

                                <div class="blog-image-wrapper" style="height: 200px; overflow: hidden;">
                                    <img
                                        src="{{asset(Storage::url($blog->image))}}"
                                        alt="{{$blog->title}}"
                                        class="w-100 h-100 object-fit-cover transition-all"
                                        style="transition: transform 0.5s ease;">
                                </div>

                                <div class="p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                            {{$blog->category->name}}
                                        </span>
                                        <small class="text-secondary">
                                            <i class="far fa-clock me-1"></i> {{ $blog->reading_time ?? '5' }} dk
                                        </small>
                                    </div>

                                    <h4 class="fw-bold mb-3 text-white">{{$blog->title}}</h4>

                                    <p class="text-secondary mb-4">
                                        {{str(strip_tags($blog->content))->limit(100, '...')}}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-primary fw-semibold">
                                            Devamını Oku <i class="fas fa-arrow-right ms-2"></i>
                                        </span>
                                        <small
                                            class="text-secondary">{{$blog->created_at->translatedFormat("d M Y")}}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{route('blogs')}}" class="btn btn-outline-light btn-lg rounded-pill px-5">
                    <i class="fas fa-book-open me-2"></i>Tüm Yazıları Gör
                </a>
            </div>
        </div>
    </section>

    <!-- Engineering Principles -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="bento-card">
                        <div class="card-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3 class="fw-bold mb-4">Mühendislik Prensiplerim</h3>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-primary me-3 mt-1"></i>
                                <span class="text-secondary">Okunabilirlik, kısalıktan daha önemlidir</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-primary me-3 mt-1"></i>
                                <span class="text-secondary">Test yazılmayan kod teknik borçtur</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-primary me-3 mt-1"></i>
                                <span class="text-secondary">Yorum yerine iyi isimlendirme tercih ederim</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-primary me-3 mt-1"></i>
                                <span class="text-secondary">Sistemler zamanla evrilmelidir, sert olmamalıdır</span>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="fas fa-check-circle text-primary me-3 mt-1"></i>
                                <span class="text-secondary">Erken optimizasyon tüm kötülüklerin anasıdır</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="bento-card">
                        <div class="card-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="fw-bold mb-4">Development Setup</h3>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary"><i class="fas fa-desktop me-2"></i>İşletim Sistemi</span>
                                <span class="fw-semibold">Linux / Windows</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary"><i class="fas fa-code me-2"></i>Code Editor</span>
                                <span class="fw-semibold">VS Code</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary"><i class="fas fa-terminal me-2"></i>Terminal</span>
                                <span class="fw-semibold">Bash / PowerShell</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary"><i class="fas fa-database me-2"></i>Database Tools</span>
                                <span class="fw-semibold">MySQL Workbench, DBeaver</span>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary"><i class="fab fa-docker me-2"></i>Containerization</span>
                                <span class="fw-semibold">Docker, Docker Compose</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container py-5">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">İletişime Geçin</h2>
                <p class="section-subtitle">
                    Proje işbirlikleri, staj fırsatları veya sorularınız için benimle iletişime geçebilirsiniz
                </p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="bento-card">
                        <form id="contactForm" method="post">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-secondary fw-semibold">Adınız</label>
                                    <input type="text" class="form-control" placeholder="John Doe" name="name"
                                           id="name">
                                    <div class="error-msg text-danger small mt-1" id="error-name"></div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-secondary fw-semibold">Email</label>
                                    <input type="email" class="form-control" placeholder="john@example.com" name="email"
                                           id="email">
                                    <div class="error-msg text-danger small mt-1" id="error-email"></div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-secondary fw-semibold">Konu</label>
                                    <input type="text" class="form-control" name="subject" id="subject"
                                           placeholder="Proje...">
                                    <div class="error-msg text-danger small mt-1" id="error-subject"></div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-secondary fw-semibold">Mesajınız</label>
                                    <textarea class="form-control" rows="5" name="message" id="message"
                                              placeholder="Mesajınız..."></textarea>
                                    <div class="error-msg text-danger small mt-1" id="error-message"></div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill"
                                            id="submitContactBtn">
                                        <i class="fas fa-paper-plane me-2"></i>Mesaj Gönder
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#submitContactBtn').click(function (event) {
                event.preventDefault();

                let btn = $(this);
                let form = $('#contactForm');

                $('.error-msg').text('');
                $('.form-control').removeClass('is-invalid');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Gönderiliyor...');

                let data = form.serialize();

                $.ajax({
                    url: "{{route('contact')}}",
                    method: "POST",
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": "{{csrf_token()}}",
                        "Accept": "application/json"
                    },
                    success: function (resp) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Mesaj gönderildi!',
                            text: 'En kısa sürede sana dönüş yapacağım.',
                            confirmButtonColor: '#6366f1'
                        });
                        form[0].reset();
                    },
                    error: function (resp) {
                        if (resp.status === 422) {
                            let errors = resp.responseJSON.errors;

                            $.each(errors, function (key, value) {
                                $(`[name="${key}"]`).addClass('is-invalid');

                                $(`#error-${key}`).text(value[0]);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata!',
                                text: 'Sistem kaynaklı bir hata oluştu. Lütfen sonra tekrar deneyin.'
                            });
                        }
                    },
                    complete: function () {
                        btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Mesaj Gönder');
                    }
                });
            });
        });
    </script>
@endpush
