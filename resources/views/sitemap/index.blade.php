<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">

    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>{{ now()->startOfDay()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ route('projects') }}</loc>
        <lastmod>{{now()->toAtomString()}}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('blogs') }}</loc>
        <lastmod>{{now()->toAtomString()}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach($blogs as $blog)
        <url>
            <loc>{{ route('blog.detail', $blog->slug) }}</loc>
            <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

</urlset>
