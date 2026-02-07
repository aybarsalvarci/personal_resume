@extends('front.layouts.master')

@section('title', "Portfolio Projeleri")

@push('css')
    <style>
        /* Modern Sidebar - Blog Sayfanla Uyumlu */
        .filter-sidebar {
            position: sticky;
            top: 120px;
            background: var(--card-bg, #1a1a1a);
            backdrop-filter: blur(15px);
            padding: 25px;
            border-radius: 24px;
            border: 1px solid var(--border, rgba(255,255,255,0.1));
            box-shadow: var(--shadow-lg);
        }

        .sidebar-widget { margin-bottom: 30px; }

        .widget-title {
            color: var(--text-primary, #fff);
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
        }

        .widget-title::before {
            content: '';
            width: 4px;
            height: 18px;
            background: var(--primary, #0d6efd);
            margin-right: 12px;
            border-radius: 2px;
        }

        /* Arama Kutusu */
        .modern-search-box { position: relative; display: flex; align-items: center; }
        .modern-search-box .form-control {
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid var(--border, rgba(255,255,255,0.1)) !important;
            border-radius: 50px;
            padding: 12px 20px;
            color: #fff !important;
        }

        .search-icon-btn {
            position: absolute;
            right: 6px;
            background: var(--primary, #0d6efd);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .search-icon-btn:hover { transform: scale(1.1); }

        /* Filtre Linkleri */
        .filter-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #a0a0a0 !important;
            text-decoration: none;
            padding: 10px 15px;
            background: rgba(255,255,255,0.02);
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-bottom: 8px;
            border: 1px solid transparent;
        }

        .filter-link:hover, .filter-link.active {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd !important;
            border-color: rgba(13, 110, 253, 0.3);
            transform: translateX(5px);
        }

        .filter-link .count {
            font-size: 0.75rem;
            background: rgba(255,255,255,0.05);
            padding: 2px 8px;
            border-radius: 20px;
            color: #666;
        }

        /* Kaydırılabilir Liste Alanı */
        .scrollable-filter-list {
            max-height: 250px; /* Liste bu boyutu aşınca scroll çıkar */
            overflow-y: auto;
            padding-right: 8px;
            margin-right: -8px; /* Scrollbar'ın içeriği sıkıştırmaması için */
        }

        /* Şık Scrollbar Tasarımı (Webkit) */
        .scrollable-filter-list::-webkit-scrollbar {
            width: 5px;
        }

        .scrollable-filter-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 10px;
        }

        .scrollable-filter-list::-webkit-scrollbar-thumb {
            background: var(--primary, #0d6efd);
            border-radius: 10px;
            opacity: 0.5;
        }

        .scrollable-filter-list::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark, #0a58ca);
        }

        .filter-link.active .count { background: #0d6efd; color: #fff; }
    </style>
@endpush

@section('content')
    <section class="page-header">
        <div class="container text-center">
            <div class="mb-3" data-aos="fade-up">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill border border-primary border-opacity-25">
                    <i class="fas fa-folder-open me-2"></i>Portfolio Projeleri
                </span>
            </div>
            <h1 class="page-title" data-aos="fade-up" data-aos-delay="100">
                Öğrenme<br>
                <span class="gradient-text">Yolculuğum</span>
            </h1>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <aside class="filter-sidebar mb-5" data-aos="fade-right">
                        <form action="{{ route('projects') }}" method="GET" id="projectFilterForm">

                            <div class="sidebar-widget">
                                <h5 class="widget-title">Proje Ara</h5>
                                <div class="modern-search-box">
                                    <input type="text" name="keyword" class="form-control" placeholder="Proje adı..." value="{{ request('keyword') }}">
                                    <button type="submit" class="search-icon-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h5 class="widget-title">Kategoriler</h5>
                                <input type="hidden" name="category" id="selectedCategory" value="{{ request('category', 'all') }}">

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
                                                    <span><i class="{{ $category->icon ?? 'fas fa-chevron-right' }} me-2 small"></i>{{ $category->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h5 class="widget-title">Proje Durumu</h5>
                                <input type="hidden" name="status" id="selectedStatus" value="{{ request('status', 'all') }}">
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
                                            <a href="javascript:void(0)" class="filter-link {{ request('status', 'all') == $s['id'] ? 'active' : '' }}" onclick="filterBy('status', '{{ $s['id'] }}')">
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
                                {{-- Buradaki kart yapısı front.partials.project-list içindekiyle aynı olmalı --}}
                                @include('front.partials.project-card', ['project' => $project])
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="bento-card">
                                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                    <p class="text-secondary">Aradığınız kriterlere uygun proje bulunamadı.</p>
                                    <a href="{{ route('projects') }}" class="btn btn-primary rounded-pill">Filtreleri Temizle</a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-5 d-flex justify-content-center" data-aos="fade-up">
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
            if(type === 'category') {
                document.getElementById('selectedCategory').value = value;
            } else if(type === 'status') {
                document.getElementById('selectedStatus').value = value;
            }
            document.getElementById('projectFilterForm').submit();
        }
    </script>
@endpush
