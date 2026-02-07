@extends('front.layouts.master')

@section('title', "Teknik Blog | Tüm Yazılar")

@push('css')
    <style>
        /* Modern Sidebar - style.css Değişkenleri ile Uyumlu */
        .filter-sidebar {
            position: sticky;
            top: 120px;
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            padding: 25px;
            border-radius: 24px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-lg);
        }

        .sidebar-widget { margin-bottom: 30px; }

        .widget-title {
            color: var(--text-primary);
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
        }

        /* Kırmızı Çizgi Yerine Temanın Primary Rengi */
        .widget-title::before {
            content: '';
            width: 4px;
            height: 18px;
            background: var(--primary);
            margin-right: 12px;
            border-radius: 2px;
        }

        /* Arama Kutusu Modernize */
        .modern-search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .modern-search-box .form-control {
            background: var(--glass) !important;
            border: 1px solid var(--border) !important;
            border-radius: 50px;
            padding: 12px 20px;
            color: var(--text-primary) !important;
        }

        .modern-search-box .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
        }

        .search-icon-btn {
            position: absolute;
            right: 6px;
            background: var(--primary);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-icon-btn:hover { background: var(--primary-dark); transform: scale(1.1); }

        /* Kaydırılabilir Kategori Listesi */
        .category-list {
            max-height: 350px;
            overflow-y: auto;
            padding-right: 5px;
        }

        /* Şık Scrollbar */
        .category-list::-webkit-scrollbar { width: 4px; }
        .category-list::-webkit-scrollbar-track { background: var(--glass); }
        .category-list::-webkit-scrollbar-thumb { background: var(--border-hover); border-radius: 10px; }

        .filter-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-secondary) !important;
            text-decoration: none;
            padding: 10px 15px;
            background: var(--glass);
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-bottom: 8px;
            border: 1px solid transparent;
        }

        .filter-link:hover, .filter-link.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary) !important;
            border-color: var(--border-hover);
            transform: translateX(5px);
        }

        .filter-link .count {
            font-size: 0.75rem;
            background: var(--glass);
            padding: 2px 8px;
            border-radius: 20px;
            color: var(--text-muted);
        }

        .filter-link.active .count { background: var(--primary); color: #fff; }
    </style>
@endpush

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
                                <input type="hidden" name="category" id="selectedCategory" value="{{ request('category', 'all') }}">

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
                                <a href="{{ route('blog.detail', $blog->slug) }}" class="text-decoration-none h-100 d-block">
                                    <div class="bento-card blog-card h-100 p-0 overflow-hidden">
                                        <div class="blog-image-wrapper" style="height: 180px; overflow: hidden;">
                                            <img src="{{ Storage::url($blog->image) }}" class="project-img">
                                        </div>
                                        <div class="p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                                {{ $blog->category->name }}
                                            </span>
                                                <small class="text-secondary">{{ $blog->reading_time ?? '5' }} dk okuma</small>
                                            </div>
                                            <h4 class="fw-bold mb-3 text-white">{{ $blog->title }}</h4>
                                            <p class="text-secondary mb-4">
                                                {{ str(strip_tags($blog->content))->limit(90) }}
                                            </p>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="text-primary fw-semibold">Oku <i class="fas fa-arrow-right ms-2"></i></span>
                                                <small class="text-muted">{{ $blog->created_at->translatedFormat('d M Y') }}</small>
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
