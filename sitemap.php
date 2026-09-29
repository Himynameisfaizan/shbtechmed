<?php
// Set header so browser and Google treat this as an XML file
header("Content-Type: application/xml; charset=utf-8");
include('config/connect.php');

// Get Base URL from your config or set a fallback
global $site;
$baseUrl = !empty($site) ? $site : "https://shbtechmed.com/";

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// 1. Static Pages (Updated for SHB Technologies)
$staticPages = [
    ["url" => "index.php", "priority" => "1.0", "changefreq" => "daily"],
    ["url" => "about.php", "priority" => "0.8", "changefreq" => "monthly"],
    ["url" => "solution.php", "priority" => "0.8", "changefreq" => "monthly"],
    ["url" => "It-services.php", "priority" => "0.8", "changefreq" => "monthly"],
    ["url" => "products.php", "priority" => "0.9", "changefreq" => "daily"],
    ["url" => "blog.php", "priority" => "0.8", "changefreq" => "weekly"],
    ["url" => "contact.php", "priority" => "0.8", "changefreq" => "monthly"]
];

// Print Static Pages
foreach ($staticPages as $page) {
    echo '<url>';
    echo '<loc>' . $baseUrl . $page['url'] . '</loc>';
    echo '<changefreq>' . $page['changefreq'] . '</changefreq>';
    echo '<priority>' . $page['priority'] . '</priority>';
    echo '</url>';
}

if (isset($conn)) {
    // 2. Dynamic Categories
    $catQuery = mysqli_query($conn, "SELECT slug_url FROM categories WHERE status = 1");
    if ($catQuery && mysqli_num_rows($catQuery) > 0) {
        while ($row = mysqli_fetch_assoc($catQuery)) {
            if(!empty($row['slug_url'])) {
                echo '<url>';
                echo '<loc>' . $baseUrl . 'category.php?slug=' . urlencode($row['slug_url']) . '</loc>';
                echo '<changefreq>weekly</changefreq>';
                echo '<priority>0.8</priority>';
                echo '</url>';
            }
        }
    }

    // 3. Dynamic Products
    $prodQuery = mysqli_query($conn, "SELECT slug_url FROM products WHERE status = 1 AND is_disabled = 0");
    if ($prodQuery && mysqli_num_rows($prodQuery) > 0) {
        while ($row = mysqli_fetch_assoc($prodQuery)) {
            if(!empty($row['slug_url'])) {
                echo '<url>';
                // Using the exact URL pattern we created for SHB
                echo '<loc>' . $baseUrl . 'product-detail.php?slug=' . urlencode($row['slug_url']) . '</loc>';
                echo '<changefreq>weekly</changefreq>';
                echo '<priority>0.9</priority>';
                echo '</url>';
            }
        }
    }

    // 4. Dynamic Blogs
    $blogQuery = mysqli_query($conn, "SELECT slug FROM blogs WHERE status = 1");
    if ($blogQuery && mysqli_num_rows($blogQuery) > 0) {
        while ($row = mysqli_fetch_assoc($blogQuery)) {
            if (!empty($row['slug'])) {
                echo '<url>';
                echo '<loc>' . $baseUrl . 'blog-detail.php?slug=' . urlencode($row['slug']) . '</loc>';
                echo '<changefreq>weekly</changefreq>';
                echo '<priority>0.7</priority>';
                echo '</url>';
            }
        }
    }
}

echo '</urlset>';
?>