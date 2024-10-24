<?php

use Cake\Routing\Router;
?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($articles as $article): ?>
        <url>
            <loc><?php //echo h(Router::url(['_name' => 'articles', 'slug' => $article->slug], true)); 
                    ?></loc>

            <loc><?php echo Router::url('/articles/', true) . $article->slug; ?></loc>
            <lastmod><?= h($article->modified->format('Y-m-d')); ?></lastmod>
        </url>
    <?php endforeach; ?>
</urlset>