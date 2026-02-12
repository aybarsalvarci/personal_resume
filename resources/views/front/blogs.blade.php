@extends('front.layouts.master')

@section('title', "Teknik Blog | Tüm Yazılar")

@push('css')
    <link rel="stylesheet" href="{{asset('front/css/blogs.css')}}">
@endpush

@push('og')
    <meta property="og:type" content="blog">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Teknik Blog - Öğrenme Yolculuğum">
    <meta property="og:description"
          content="Backend development ve clean architecture üzerine teknik notlar ve makaleler.">
    <meta property="og:image" content="{{ asset('front/img/og-blog.jpg') }}">
    <meta property="og:site_name" content="Aybars.dev">
    <meta property="og:locale" content="tr_TR">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Teknik Blog - Öğrenme Yolculuğum">
    <meta property="twitter:description"
          content="Backend development ve clean architecture üzerine teknik notlar ve makaleler.">
    <meta property="twitter:image" content="{{ asset('front/img/og-blog.jpg') }}">
@endpush

@section('schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@graph": [
            {
              "@type": "CollectionPage",
              "@id": "{{ url()->current() }}#collection",
              "url": "{{ url()->current() }}",
              "name": "Teknik Blog | Tüm Yazılar",
              "description": "Backend development ve clean architecture üzerine teknik notlar ve makaleler.",
              "publisher": {
                "@id": "{{ url('/#person') }}"
              }
            },
            {
              "@type": "Blog",
              "@id": "{{ url()->current() }}#blog",
              "name": "Aybars.dev Teknik Blog",
              "description": "Backend development üzerine teknik yazılar.",
              "publisher": {
                "@type": "Person",
                "name": "Aybars"
              },
              "blogPost": [
        @foreach($blogs as $blog)
            {
              "@type": "BlogPosting",
              "headline": "{{ $blog->title }}",
                              "url": "{{ route('blog.detail', $blog->slug) }}",
                              "datePublished": "{{ $blog->created_at->toIso8601String() }}",
                              "image": "{{ asset(Storage::url($blog->image)) }}",
                              "abstract": "{{ str(strip_tags($blog->content))->limit(90) }}"
                            }@if(!$loop->last)
                ,
            @endif
        @endforeach
        ]
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
                  "name": "Blog",
                  "item": "{{ url()->current() }}"
                }
              ]
            }
          ]
        }
    </script>
@endsection

@section('content')
    <div class="animated-bg"></div>
    <div class="grid-overlay"></div>

    <section class="page-header">
        <div class="container text-center">
            <div class="mb-3" data-aos="fade-up">
                <span class="tech-tag">
                    <i class="fas fa-blog me-2"></i>Teknik Blog
                </span>
            </div>
            <h1 class="page-title" data-aos="fade-up" data-aos-delay="100">
                Öğrendiklerimi<br>
                <span class="gradient-text">Paylaşıyorum</span>
            </h1>
            <p class="page-subtitle" data-aos="fade-up" data-aos-delay="200">
                Backend development ve clean architecture üzerine teknik notlar.
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <aside class="filter-sidebar mb-5" data-aos="fade-right">
                        <form id="blogFilterForm">

                            <div class="sidebar-widget mb-4">
                                <h5 class="widget-title">
                                    <i class="fas fa-search me-2 text-primary"></i>Yazılarda Ara
                                </h5>
                                <div class="modern-search-box">
                                    <input type="text"
                                           name="keyword"
                                           class="form-control"
                                           placeholder="Anahtar kelime..."
                                           value="{{ request('keyword') }}"
                                           id="blogSearch">
                                    <button type="submit" class="search-icon-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h5 class="widget-title">
                                    <i class="fas fa-tags me-2 text-primary"></i>Kategoriler
                                </h5>
                                <input type="hidden" name="category" id="selectedCategory"
                                       value="{{ request('category', 'all') }}">

                                <ul class="category-list list-unstyled m-0">
                                    <li>
                                        <a href="javascript:void(0)"
                                           class="filter-link {{ request('category', 'all') == 'all' ? 'active' : '' }}"
                                           onclick="filterByCategory('all')">
                                            <span><i class="fas fa-border-all me-2"></i>Tümü</span>
                                            <span class="count">{{ $totalCount ?? '0' }}</span>
                                        </a>
                                    </li>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="filter-link {{ request('category') == $category->id ? 'active' : '' }}"
                                               onclick="filterByCategory('{{ $category->id }}')">
                                                <span><i class="fas fa-chevron-right me-2 small"></i>{{ $category->name }}</span>
                                                <span class="count">{{ $category->blogs_count }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </form>
                    </aside>
                </div>

                <div class="col-lg-9">
                    <div class="row g-4" id="blogGrid">
                        @foreach($blogs as $blog)
                            <div class="col-md-6" data-aos="fade-up">
                                <a href="{{ route('blog.detail', $blog->slug) }}"
                                   class="text-decoration-none h-100 d-block">
                                    <div class="bento-card blog-card h-100 p-0 overflow-hidden">
                                        <div class="blog-image-wrapper" style="height: 180px; overflow: hidden;">
                                            <img src="{{ Storage::url($blog->image) }}" class="project-img">
                                        </div>
                                        <div class="p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                                {{ $blog->category->name }}
                                            </span>
                                                <small class="text-secondary">{{ $blog->reading_time ?? '5' }} dk
                                                    okuma</small>
                                            </div>
                                            <h4 class="fw-bold mb-3 text-white">{{ $blog->title }}</h4>
                                            <p class="text-secondary mb-4">
                                                {{ str(strip_tags($blog->content))->limit(90) }}
                                            </p>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="text-primary fw-semibold">Oku <i
                                                        class="fas fa-arrow-right ms-2"></i></span>
                                                <small
                                                    class="text-muted">{{ $blog->created_at->translatedFormat('d M Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 d-flex justify-content-center" data-aos="fade-up">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        function filterByCategory(id) {
            // Gizli inputun değerini güncelle
            document.getElementById('selectedCategory').value = id;
            // Formu gönder
            document.getElementById('blogFilterForm').submit();
        }
    </script>
@endpush
