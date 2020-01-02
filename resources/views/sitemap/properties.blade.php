<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @if(!empty($data))
        @if($data['category']=='destinations')
            @if(!empty($data['parent']))
                @foreach ($data['row'] as $single)
                    <url>
                        <loc>{{url('/')}}/{{$data['parent']}}/{{ $single['slug'] }}</loc>
                        <lastmod>{{ $single['created'] }}</lastmod>
                        <changefreq>weekly</changefreq>
                        <priority>0.9</priority>
                    </url>
                @endforeach
            @else
                @foreach ($data['row'] as $single)
                    <url>
                        <loc>{{url('/')}}/{{ $single->slug }}</loc>
                        <lastmod>{{ $single->created }}</lastmod>
                        <changefreq>weekly</changefreq>
                        <priority>0.9</priority>
                    </url>
                @endforeach    
            @endif
        @elseif($data['category']=='channels')
            
            @if(!empty($data['parent']))
                @foreach ($data['row'] as $single)
                    @if($single['category_youtube_channel_url']!='')
                        <url>
                            <loc>{{url('/')}}/{{$data['parent']}}/{{ $single['slug'] }}</loc>
                            <lastmod>{{ $single['created'] }}</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.9</priority>
                        </url>
                    @endif
                @endforeach                    
            @endif                  
        @else
            @if(!empty($data['parent']))
                @foreach ($data['row'] as $single)
                    <url>
                        <loc>http://localhost:8181/emporium-staging-forge/public/{{$data['parent']}}/{{ $single->slug }}</loc>
                        <lastmod>{{ $single->created }}</lastmod>
                        <changefreq>weekly</changefreq>
                        <priority>0.9</priority>
                    </url>
                @endforeach
            @else
                @foreach ($data['row'] as $single)
                    <url>
                        <loc>http://localhost:8181/emporium-staging-forge/public/{{ $single->slug }}</loc>
                        <lastmod>{{ $single->created }}</lastmod>
                        <changefreq>weekly</changefreq>
                        <priority>0.9</priority>
                    </url>
                @endforeach    
            @endif
        @endif
    @endif
</urlset>