@extends('front.layouts.master')

@section('title', $blog->title)

@push('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/tokyo-night-dark.min.css">

    <style>
        /* Blog Detay Sayfası Özel Stilleri - style.css ile tam uyumlu */
        .article-header {
            padding: 160px 0 60px;
            text-align: center;
            position: relative;
        }

        .article-title {
            font-size: clamp(2.2rem, 6vw, 3.8rem);
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: -2px;
            margin: 1.5rem auto;
            max-width: 950px;
            color: var(--text-primary); /* style.css'den gelir */
        }

        .article-meta {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            color: var(--text-secondary);
            font-size: 1rem;
            margin-top: 2rem;
        }

        .article-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-meta-item i {
            color: var(--primary);
        }

        /* Kapak Görseli - Bento Stili */
        .article-cover-container {
            max-width: 1100px;
            margin: 0 auto 4rem;
            padding: 0 1.5rem;
        }

        .article-cover-img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 32px;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border);
        }

        /* Makale İçeriği */
        .article-content {
            max-width: 850px;
            margin: 0 auto;
            padding: 0 1.5rem 6rem;
            font-size: 1.2rem;
            line-height: 1.85;
            color: var(--text-secondary);
        }

        /* Tipografi */
        .article-content h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 4rem 0 1.5rem;
            color: var(--text-primary);
            border-left: 5px solid var(--primary);
            padding-left: 1.5rem;
        }

        .article-content h3 {
            font-size: 1.6rem;
            font-weight: 600;
            margin: 2.5rem 0 1.2rem;
            color: var(--text-primary);
        }

        .article-content p {
            margin-bottom: 1.8rem;
        }

        /* Kod Blokları - Senin Terminal Tasarımınla Uyumlu */
        .article-content pre {
            background: rgba(10, 10, 15, 0.8) !important;
            backdrop-filter: blur(10px);
            padding: 1.8rem;
            border-radius: 20px;
            margin: 3rem 0;
            border: 1px solid var(--border);
            overflow-x: auto;
        }

        .article-content code {
            font-family: 'JetBrains Mono', monospace;
            background: rgba(99, 102, 241, 0.1);
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            color: var(--primary-light);
            font-size: 0.9em;
        }

        .article-content pre code {
            background: transparent;
            padding: 0;
        }

        /* Paylaşım Bölümü - Bento Kart Stili */
        .share-section {
            margin-top: 5rem;
            padding: 3rem;
            background: var(--card-bg);
            border-radius: 28px;
            border: 1px solid var(--border);
            text-align: center;
            backdrop-filter: blur(20px);
        }

        .share-btn {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            background: var(--glass);
            border: 1px solid var(--border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }

        .share-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        @media (max-width: 768px) {
            .article-header {
                padding: 120px 0 40px;
            }

            .article-cover-img {
                height: 300px;
                border-radius: 20px;
            }

            .article-title {
                font-size: 2rem;
            }

            .article-content {
                font-size: 1.1rem;
            }
        }
    </style>
@endpush

@push('og')
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $blog->title }} | Aybars.dev">
    <meta property="og:description"
          content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">
    <meta property="og:image" content="{{ asset(Storage::url($blog->image)) }}">
    <meta property="og:locale" content="tr_TR">
    <meta property="og:site_name" content="Aybars.dev">
    <meta property="article:published_time" content="{{ $blog->created_at->toIso8601String() }}">
    <meta property="article:author" content="Aybars Şalvarcı">
    <meta property="article:section" content="{{ $blog->category->name }}">

    {{-- og twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $blog->title }}">
    <meta name="twitter:description"
          content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">
    <meta name="twitter:image" content="{{ asset(Storage::url($blog->image)) }}">
    <meta name="twitter:creator" content="@aybarsalvarci">
@endpush

@section('content')
    <div class="animated-bg"></div>
    <div class="grid-overlay"></div>

    <header class="article-header">
        <div class="container" data-aos="fade-down">
            <div class="tech-tag mb-4">
                <i class="fas fa-layer-group me-2"></i>
                <span>{{$blog->category->name}}</span>
            </div>

            <h1 class="article-title">
                {{$blog->title}}
            </h1>

            <div class="article-meta">
                <div class="article-meta-item">
                    <i class="fas fa-user-circle"></i>
                    <span>Aybars Şalvarcı</span>
                </div>
                <div class="article-meta-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{$blog->created_at->translatedFormat("d M Y")}}</span>
                </div>
                <div class="article-meta-item">
                    <i class="fas fa-clock"></i>
                    <span>5 dk okuma</span>
                </div>
            </div>
        </div>
    </header>

    @if($blog->image)
        <div class="article-cover-container" data-aos="zoom-in" data-aos-delay="200">
            <img src="{{ asset(Storage::url($blog->image)) }}" alt="{{$blog->title}}" class="article-cover-img">
        </div>
    @endif

    <article class="article-content" data-aos="fade-up" data-aos-delay="300">
        <div class="content-body">
            {!! $blog->content !!}
        </div>

        <div class="share-section">
            <h4 class="fw-bold text-primary mb-3">Bu yazıyı beğendiniz mi?</h4>
            <p class="text-secondary mb-4">Paylaşarak daha fazla kişiye ulaşmasına yardımcı olabilirsiniz.</p>
            <div class="d-flex justify-content-center">
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ url()->current() }}"
                   target="_blank"
                   class="share-btn"
                   title="Twitter'da Paylaş">
                    <i class="fab fa-twitter"></i>
                </a>

                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                   target="_blank"
                   class="share-btn"
                   title="LinkedIn'de Paylaş">
                    <i class="fab fa-linkedin"></i>
                </a>

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                   target="_blank"
                   class="share-btn"
                   title="Facebook'ta Paylaş">
                    <i class="fab fa-facebook"></i>
                </a>

                <a href="#" class="share-btn" title="Linki Kopyala" id="copyLink">
                    <i class="fas fa-link"></i>
                </a>
                <a href="#" class="share-btn" id="copyLink" title="Bağlantıyı Kopyala">
                    <i class="fas fa-link"></i>
                </a>
            </div>
        </div>
    </article>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll();

        // Link Kopyalama Fonksiyonu (style.css'deki SweetAlert uyumuyla)
        document.getElementById('copyLink').addEventListener('click', function (e) {
            e.preventDefault();
            navigator.clipboard.writeText(window.location.href);

            const btn = $(this);
            const originalIcon = btn.html();
            btn.html('<i class="fas fa-check text-success"></i>');

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Bağlantı kopyalandı!',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                background: 'var(--card-bg)',
                color: 'var(--text-primary)'
            });

            setTimeout(() => {
                btn.html(originalIcon);
            }, 2000);
        });
    </script>
@endpush
