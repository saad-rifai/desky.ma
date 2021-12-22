<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($users as $user)
        <url>
            <loc>{{asset('/@'.$user->username)}}</loc>
            <lastmod>@php if($user->updated_at == null){ echo $user->created_at->tz('UTC')->toAtomString(); }else{ echo $user->updated_at->tz('UTC')->toAtomString(); } @endphp</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>