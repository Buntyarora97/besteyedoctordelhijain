<?php
require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';
require_once __DIR__ . '/app/core/helpers.php';
require_once __DIR__ . '/app/data/content.php';
require_once __DIR__ . '/app/core/Router.php';
require_once __DIR__ . '/app/controllers/PageController.php';
header('Content-Type: application/xml; charset=utf-8');

$urls = array_merge(
    ['', 'about', 'find-an-eye-doctor', 'doctors', 'why-choose-an-eye-specialist', 'second-opinion',
     'book-appointment', 'contact', 'location/adarsh-nagar-delhi', 'faqs', 'articles', 'videos', 'gallery',
     'privacy-policy', 'terms', 'medical-disclaimer', 'accessibility', 'sitemap'],
    PageController::sitemapPaths()
);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach (array_unique($urls) as $u) {
    echo "  <url><loc>" . e(url($u)) . "</loc><changefreq>weekly</changefreq></url>\n";
}
echo '</urlset>';
