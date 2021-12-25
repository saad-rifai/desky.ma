<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @for ($i = 0; $i < $pages; $i++)
    <sitemap>
        <loc>{{asset('/sitemap-users.xml?page='.($i+1))}}</loc>
      </sitemap>
    @endfor


</sitemapindex>