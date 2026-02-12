@extends('front.layouts.master')

@section('title', "Portfolio Projeleri")

@push('css')
    <link rel="stylesheet" href="{{asset('front/css/projects.css')}}">
@endpush

@push('og')
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('projects') }}">
    <meta property="og:title" content="Portfolio Projeleri - Öğrenme Yolculuğum">
    <meta property="og:description"
          content="{{config('settings.meta_description')}}">
    <meta property="og:image" content="{{ asset('front/images/og_projects.webp') }}">
    <meta property="og:site_name" content="Aybars.dev">
    <meta property="og:locale" content="tr_TR">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ route('projects') }}">
    <meta property="twitter:title" content="Portfolio Projeleri - Öğrenme Yolculuğum">
    <meta property="twitter:description"
          content="{{config('settings.meta_description')}}">
    <meta property="twitter:image" content="{{ asset('front/images/og_projects.webp') }}">
@endpush

@section('schema')
    <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@graph": [
                    {
                      "@type": "CollectionPage",
                      "@id": "{{ route('projects') }}#collection",
                  "url": "{{ route('projects') }}",
                  "name": "Portfolio Projeleri - Öğrenme Yolculuğum",
                  "description": "Backend mimarisi ve modern teknolojiler üzerine geliştirdiğim projelerimi inceleyin.",
                  "publisher": {
                    "@type": "Person",
                    "name": "Aybars",
                    "url": "{{ url('/') }}"
                  }
                },
                {
                  "@type": "BreadcrumbList",
                  "itemListElement": [
                    {
                      "@type": "ListItem",
                      "position": 1,
                      "name": "Anasayfa",
                      "item": "{{ url('/') }}"
                    },
                    {
                      "@type": "ListItem",
                      "position": 2,
                      "name": "Projeler",
                      "item": "{{ route('projects') }}"
                    }
                  ]
                },
                {
                  "@type": "ItemList",
                  "name": "Geliştirilen Projeler",
                  "description": "Yazılım geliştirme projeleri listesi",
                  "itemListElement": [
                @foreach($projects as $project)
                    {
                      "@type": "ListItem",
                      "position": {{ $loop->iteration }},
                      "item": {
                        "@type": "SoftwareSourceCode",
                        "name": "{{ $project->name }}",
                        "description": "{{ strip_tags($project->description) }}",
                        "programmingLanguage": [
                    @foreach(explode(',', $project->keys) as $key)
                        "{{ trim($key) }}"@if(!$loop->last)
                            ,
                        @endif
                    @endforeach
                    ],
                    @if($project->link)
                        "codeRepository": "{{ $project->link }}",
                    @endif
                    @if($project->image)
                        "image": "{{ asset(Storage::url($project->image)) }}",
                    @endif
                    "author": {
                      "@type": "Person",
                      "name": "Aybars"
                    }
                  }
                }@if(!$loop->last)
                        ,
                    @endif
                @endforeach
                ]
              }
            ]
          }
    </script>
@endsection

@section('content')
    <section class="page-header">
        <div class="header-bg-effect"></div>
        <div class="header-glow"></div>

        <div class="container text-center position-relative z-1">
            <div data-aos="fade-down">
            <span class="tech-tag-hero">
                <i class="fas fa-code-branch me-2"></i> Portfolio & Projeler
            </span>
            </div>

            <h1 class="hero-title" data-aos="fade-up" data-aos-delay="100">
                Öğrenme
                <span class="gradient-text-hero">Yolculuğum</span>
            </h1>

            <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
                Backend mimarisi, Clean Code prensipleri ve modern teknolojiler üzerine
                geliştirdiğim açık kaynak projelerimi burada keşfedebilirsiniz.
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <aside class="filter-sidebar" data-aos="fade-right">
                        <form action="{{ route('projects') }}" method="GET" id="projectFilterForm">
                            <div class="sidebar-widget">
                                <h5 class="widget-title">Proje Ara</h5>
                                <div class="modern-search-box d-flex align-items-center position-relative">
                                    <input type="text" name="keyword" class="form-control"
                                           placeholder="Proje adı..."
                                           value="{{ request('keyword') }}">
                                    <button type="submit" class="search-icon-btn"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h5 class="widget-title">Kategoriler</h5>
                                <input type="hidden" name="category" id="selectedCategory"
                                       value="{{ request('category', 'all') }}">
                                <div class="scrollable-filter-list">
                                    <ul class="list-unstyled m-0">
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="filter-link {{ request('category', 'all') == 'all' ? 'active' : '' }}"
                                               onclick="filterBy('category', 'all')">
                                                <span><i class="fas fa-border-all me-2"></i>Tümü</span>
                                            </a>
                                        </li>
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="javascript:void(0)"
                                                   class="filter-link {{ request('category') == $category->slug ? 'active' : '' }}"
                                                   onclick="filterBy('category', '{{ $category->slug }}')">
                                                    <span><i
                                                            class="{{ $category->icon ?? 'fas fa-chevron-right' }} me-2 small"></i>{{ $category->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h5 class="widget-title">Durum</h5>
                                <input type="hidden" name="status" id="selectedStatus"
                                       value="{{ request('status', 'all') }}">
                                <ul class="list-unstyled m-0">
                                    @php
                                        $statuses = [
                                            ['id' => 'all', 'label' => 'Tümü', 'icon' => 'fas fa-layer-group'],
                                            ['id' => 'completed', 'label' => 'Tamamlandı', 'icon' => 'fas fa-check-circle text-success'],
                                            ['id' => 'in-progress', 'label' => 'Devam Ediyor', 'icon' => 'fas fa-spinner fa-spin text-warning'],
                                            ['id' => 'upcoming', 'label' => 'Yakında', 'icon' => 'fas fa-calendar-alt text-info']
                                        ];
                                    @endphp
                                    @foreach($statuses as $s)
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="filter-link {{ request('status', 'all') == $s['id'] ? 'active' : '' }}"
                                               onclick="filterBy('status', '{{ $s['id'] }}')">
                                                <span><i class="{{ $s['icon'] }} me-2"></i>{{ $s['label'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </form>
                    </aside>
                </div>

                <div class="col-lg-9">
                    <div class="row g-4" id="projectsGrid">
                        @forelse($projects as $project)
                            <div class="col-md-6" data-aos="fade-up">
                                @include('front.partials.project-card', ['project' => $project])
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="filter-sidebar"> {{-- Bento card yerine sidebar stili kullanıldı --}}
                                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                    <p class="text-secondary">Aradığınız kriterlere uygun proje bulunamadı.</p>
                                    <a href="{{ route('projects') }}" class="btn btn-primary rounded-pill px-4">Filtreleri
                                        Temizle</a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        {{ $projects->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        function filterBy(type, value) {
            if (type === 'category') {
                document.getElementById('selectedCategory').value = value;
            } else if (type === 'status') {
                document.getElementById('selectedStatus').value = value;
            }
            document.getElementById('projectFilterForm').submit();
        }
    </script>
@endpush
