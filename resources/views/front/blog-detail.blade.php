@extends('front.layouts.master')

@section('title', $blog->title)

@push('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/tokyo-night-dark.min.css">

    <link rel="stylesheet" href="{{asset('front/css/blog-detail.css')}}">
@endpush

@push('og')
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $blog->title }} | {{config('app.name')}}">
    <meta property="og:description"
          content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">
    <meta property="og:image" content="{{ asset(Storage::url($blog->image)) }}">
    <meta property="og:locale" content="tr_TR">
    <meta property="og:site_name" content="{{config('app.name')}}">
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

@section('schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@graph": [
            {
              "@type": "BlogPosting",
              "@id": "{{ url()->current() }}#primarypost",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url()->current() }}"
      },
      "headline": "{{ $blog->title }}",
      "description": "{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}",
      "image": {
        "@type": "ImageObject",
        "url": "{{ asset(Storage::url($blog->image)) }}"
      },
      "author": {
        "@type": "Person",
        "name": "Aybars Şalvarcı",
        "url": "{{ url('/') }}"
      },
      "publisher": {
        "@type": "Person",
        "name": "Aybars Şalvarcı",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset(Storage::url(config('settings.logo_dark'))) }}"
        }
      },
      "datePublished": "{{ $blog->created_at->toIso8601String() }}",
      "dateModified": "{{ $blog->updated_at->toIso8601String() }}",
      "articleSection": "{{ $blog->category->name }}",
      "wordCount": "{{ str_word_count(strip_tags($blog->content)) }}",
      "timeRequired": "PT5M"
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
          "item": "{{ route('blogs') }}"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "{{ $blog->title }}",
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
