<?php
// Set header so browser and Google treat this as an XML file
header("Content-Type: application/xml; charset=utf-8");
include('config/connect.php');

// Get Base URL from your config or set a fallback
global $site;
$baseUrl = !empty($site) ? $site : "https://shbtechmed.com/";

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // 1. Static Pages (Updated to Clean URLs without .php)
    $staticPages = [
    ["url" => "", "priority" => "1.0", "changefreq" => "daily"], // Homepage
    ["url" => "about", "priority" => "0.8", "changefreq" => "daily"],
    ["url" => "solution", "priority" => "0.8", "changefreq" => "daily"],
    ["url" => "It-services", "priority" => "0.8", "changefreq" => "daily"],
    ["url" => "products", "priority" => "0.9", "changefreq" => "daily"],
    ["url" => "blog", "priority" => "0.8", "changefreq" => "daily"],
    ["url" => "location", "priority" => "0.8", "changefreq" => "daily"],
    ["url" => "contact", "priority" => "0.8", "changefreq" => "daily"]
    ];

    // Print Static Pages
    foreach ($staticPages as $page) {
    echo '<url>' . "\n";
        echo '<loc>' . $baseUrl . $page['url'] . '</loc>' . "\n";
        echo '<changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
        echo '<priority>' . $page['priority'] . '</priority>' . "\n";
        echo '</url>' . "\n";
    }

    if (isset($conn)) {
    // 2. Dynamic Categories (Clean URL: category/slug)
    $catQuery = mysqli_query($conn, "SELECT slug_url FROM categories WHERE status = 1");
    if ($catQuery && mysqli_num_rows($catQuery) > 0) {
    while ($row = mysqli_fetch_assoc($catQuery)) {
    if(!empty($row['slug_url'])) {
    echo '<url>' . "\n";
        echo '<loc>' . $baseUrl . 'category/' . urlencode(trim($row['slug_url'])) . '</loc>' . "\n";
        echo '<changefreq>daily</changefreq>' . "\n";
        echo '<priority>0.8</priority>' . "\n";
        echo '</url>' . "\n";
    }
    }
    }

    // 3. Dynamic Products (Clean URL: product/slug)
    $prodQuery = mysqli_query($conn, "SELECT slug_url FROM products WHERE status = 1 AND is_disabled = 0");
    if ($prodQuery && mysqli_num_rows($prodQuery) > 0) {
    while ($row = mysqli_fetch_assoc($prodQuery)) {
    if(!empty($row['slug_url'])) {
    echo '<url>' . "\n";
        echo '<loc>' . $baseUrl . 'product/' . urlencode(trim($row['slug_url'])) . '</loc>' . "\n";
        echo '<changefreq>daily</changefreq>' . "\n";
        echo '<priority>0.9</priority>' . "\n";
        echo '</url>' . "\n";
    }
    }
    }

    // 4. Dynamic Blogs (Clean URL: blog/slug)
    $blogQuery = mysqli_query($conn, "SELECT slug FROM blogs WHERE status = 1");
    if ($blogQuery && mysqli_num_rows($blogQuery) > 0) {
    while ($row = mysqli_fetch_assoc($blogQuery)) {
    if (!empty($row['slug'])) {
    echo '<url>' . "\n";
        echo '<loc>' . $baseUrl . 'blog/' . urlencode(trim($row['slug'])) . '</loc>' . "\n";
        echo '<changefreq>daily</changefreq>' . "\n";
        echo '<priority>0.7</priority>' . "\n";
        echo '</url>' . "\n";
    }
    }
    }

    // 5. Dynamic Custom/Location Pages (Clean URL: page/slug)
    $customPageQuery = mysqli_query($conn, "SELECT slug_url FROM custom_pages WHERE status = 1");
    if ($customPageQuery && mysqli_num_rows($customPageQuery) > 0) {
    while ($row = mysqli_fetch_assoc($customPageQuery)) {
    if (!empty($row['slug_url'])) {
    echo '<url>' . "\n";
        echo '<loc>' . $baseUrl . 'page/' . urlencode(trim($row['slug_url'])) . '</loc>' . "\n";
        echo '<changefreq>daily</changefreq>' . "\n";
        echo '<priority>0.7</priority>' . "\n";
        echo '</url>' . "\n";
    }
    }
    }
    }

    echo '</urlset>';
?>