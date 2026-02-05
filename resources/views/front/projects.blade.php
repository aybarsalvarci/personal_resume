@extends('front.layouts.master')

@section('title', "")

@push('css') @endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="mb-3" data-aos="fade-up">
                <span
                    class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill border border-primary border-opacity-25">
                    <i class="fas fa-folder-open me-2"></i>Portfolio Projeleri
                </span>
            </div>
            <h1 class="page-title" data-aos="fade-up" data-aos-delay="100">
                Öğrenme<br>
                <span class="gradient-text">Yolculuğum</span>
            </h1>
            <p class="page-subtitle" data-aos="fade-up" data-aos-delay="200">
                Backend development ve clean architecture prensiplerini öğrenmek için geliştirdiğim projeler
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-3">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 justify-content-center" data-aos="fade-up">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-th me-2"></i>Tümü
                </button>
                @foreach($categories as $category)
                    <button class="filter-btn" data-filter="{{$category->slug}}">
                        <i class="{{$category->icon}} me-2"></i>{{$category->name}}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Stats -->
    <section class="py-4">
        <div class="container">
            <div class="row g-3" data-aos="fade-up">
                <div class="col-md-3 col-6">
                    <div class="text-center">
                        <h3 class="gradient-text fw-bold mb-1">15+</h3>
                        <p class="text-secondary mb-0 small">Toplam Proje</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center">
                        <h3 class="gradient-text fw-bold mb-1">8+</h3>
                        <p class="text-secondary mb-0 small">Teknoloji</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center">
                        <h3 class="gradient-text fw-bold mb-1">2K+</h3>
                        <p class="text-secondary mb-0 small">Kod Satırı</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center">
                        <h3 class="gradient-text fw-bold mb-1">100+</h3>
                        <p class="text-secondary mb-0 small">GitHub Commit</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-4" id="projectsGrid">
                @include('front.partials.project-list', compact('projects'))
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-5" data-aos="fade-up">
                <button class="btn btn-outline-light btn-lg rounded-pill px-5" id="load-more-btn">
                    <i class="fas fa-plus-circle me-2"></i>Daha Fazla Proje Yükle
                </button>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bento-card text-center" data-aos="fade-up">
                        <div class="card-icon mx-auto">
                            <i class="fab fa-github"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Tüm Projeleri GitHub'da İnceleyin</h3>
                        <p class="text-secondary mb-4">
                            Açık kaynak projelerim ve kod örneklerim için GitHub profilimi ziyaret edebilirsiniz.
                            Her proje detaylı README ve dokümantasyon içerir.
                        </p>
                        <a href="https://github.com/aybarsalvarci" target="_blank"
                           class="btn btn-primary btn-lg rounded-pill px-5">
                            <i class="fab fa-github me-2"></i>GitHub Profilime Git
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')

    <script>
        // Filter Functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const container = document.querySelector("#projectsGrid");

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.dataset.filter;
                // Update active button
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                let url = "{{route('get-projects', ['slug'])}}";
                url = url.replace('slug', filter);

                fetch(url, {
                    "method": "GET"
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Ağ hatası oluştu.");
                        }

                        return response.json();
                    })
                    .then(data => {
                        container.innerHTML = data['html'];
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
        });

        // load more button event
        const loadMoreBtn = document.querySelector("#load-more-btn");
        loadMoreBtn.addEventListener('click', function(event) {
            event.preventDefault();

            let count = document.querySelectorAll('.project-card').length;
            let filter = document.querySelector(".filter-btn.active").dataset.filter;

            let url = "{{route('get-projects', ['slug', 'count'])}}";
            url = url.replace('slug', filter);
            url = url.replace('count', count);

            fetch(url, {
                "method": "GET"
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Ağ hatası oluştu.");
                    }

                    return response.json();
                })
                .then(data => {
                    if(data.html == "")
                    {
                        swal.fire({
                            title: 'Şimdilik bu kadar!',
                            text: 'Daha fazla proje bulunamadı.',
                            icon: 'warning',
                            confirmButtonText: 'Tamam'
                        });
                    }
                    else
                    {
                        container.innerHTML += data.html;
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        });
    </script>
@endpush
