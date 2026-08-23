{!! '<'.'?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($staticRoutes as $url => $meta)
    <url>
        <loc>{{ $url }}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
        <changefreq>{{ $meta['changefreq'] }}</changefreq>
        <priority>{{ $meta['priority'] }}</priority>
    </url>
@endforeach

@foreach($activeServices as $service)
    <url>
        <loc>{{ route('services.show', $service) }}</loc>
        <lastmod>{{ $service->updated_at ? $service->updated_at->format('Y-m-d') : date('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.85</priority>
    </url>
@endforeach
</urlset>
