<?php 
require_once('config/connect.php'); 

// 1. Dynamic Base URL ($site) - Localhost aur Live Server dono ke liye automatic
if (!isset($site) || empty($site)) {
    $protocol_base = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host_base = $_SERVER['HTTP_HOST'];
    if ($host_base === 'localhost' || $host_base === '127.0.0.1') {
        $site = $protocol_base . $host_base . '/office_php_project/shbtechmed/';
    } else {
        $site = $protocol_base . $host_base . '/';
    }
}

// 2. Get Current Page Name (e.g., 'index.php', 'about.php')
$current_page = basename($_SERVER['PHP_SELF']);

// 3. Initialize DB Meta Variables
$db_meta_title = "";
$db_meta_desc  = "";
$db_meta_key   = "";
$schema_markup = "";

// 4. Fetch Meta details from DB
$meta_query = mysqli_query($conn, "SELECT * FROM `meta` WHERE `page_url` = '$current_page' LIMIT 1");
if ($meta_query && mysqli_num_rows($meta_query) > 0) {
    $meta_row = mysqli_fetch_assoc($meta_query);
    $db_meta_title = $meta_row['meta_title'];
    $db_meta_desc  = $meta_row['meta_desc'];
    $db_meta_key   = $meta_row['meta_key'];
}

// 5. Fetch Schema from DB
$schema_query = mysqli_query($conn, "SELECT * FROM `page_schemas` WHERE `page_url` = '$current_page' LIMIT 1");
if ($schema_query && mysqli_num_rows($schema_query) > 0) {
    $schema_row = mysqli_fetch_assoc($schema_query);
    $schema_markup = $schema_row['schema_markup'];
}

// 6. SMART SEO LOGIC
$final_title = isset($meta_title) && !empty($meta_title) ? $meta_title : (!empty($db_meta_title) ? $db_meta_title : "SHB Technologies & Medical Systems");
$final_desc  = isset($meta_desc) && !empty($meta_desc)   ? $meta_desc  : (!empty($db_meta_desc) ? $db_meta_desc : "Innovative medical technology solutions and MGPS systems.");
$final_key   = isset($meta_key) && !empty($meta_key)     ? $meta_key   : (!empty($db_meta_key) ? $db_meta_key : "healthcare, medical systems, MGPS");

// =========================================================
// 7. DYNAMIC CANONICAL URL GENERATOR WITH 'www.' (UPDATED)
// =========================================================
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domain_name = $_SERVER['HTTP_HOST'];

// Agar domain mein 'www.' nahi laga hai, toh 'www.' add karein
if (stripos($domain_name, 'www.') !== 0) {
    $canonical_domain = 'www.' . $domain_name;
} else {
    $canonical_domain = $domain_name;
}

// Request URI se फालतू query parameters hata kar clean URL rakhein
$clean_uri = strtok($_SERVER['REQUEST_URI'], '?');
// Agar end mein /index.php hai toh usko clean rakhein
$clean_uri = preg_replace('/\/index\.php$/i', '/', $clean_uri);

$canonical_url = $protocol . $canonical_domain . $clean_uri;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <base href="<?php echo htmlspecialchars($site); ?>" />

    <!-- DYNAMIC SEO META TAGS -->
    <title><?php echo htmlspecialchars($final_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($final_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($final_key); ?>">

    <!-- Canonical Tag with www -->
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>" />

    <?php if (!empty($schema_markup)) { echo $schema_markup; } ?>
    <?php if (!empty($page_schema)) { echo $page_schema; } ?>

    <!-- ALL CSS LINKS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/include.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/blog.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/about.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/solution.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/it.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/product.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo $site; ?>assets/css/contact.css?v=<?php echo time(); ?>">

    <link rel="icon" href="<?php echo $site; ?>favicon.ico" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $site; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $site; ?>favicon-16x16.png">
    <link rel="apple-touch-icon" href="<?php echo $site; ?>apple-touch-icon.png">
    <link rel="manifest" href="<?php echo $site; ?>site.webmanifest">

</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top shb-premium-navbar" id="mainNavbar">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo $site; ?>">
                <img src="<?php echo $site; ?>assets/images/logo.jpg" alt="SHB Technologies Logo" class="main-logo" />
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-1">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site; ?>">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site; ?>about">About Us</a>
                    </li>

                    <li class="nav-item dropdown shb-hover-dropdown">
                        <a class="nav-link dropdown-toggle" href="<?php echo $site; ?>products"
                            id="productsDropdown">
                            Products
                        </a>
                        <ul class="dropdown-menu shadow-lg border-0 p-2 main-scroll-menu">
                            <?php
                            $cat_query = "SELECT * FROM `categories` WHERE `status` = 1 ORDER BY `categories` ASC";
                            $cat_result = mysqli_query($conn, $cat_query);

                            if ($cat_result && mysqli_num_rows($cat_result) > 0) {
                                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                    $cate_id = $cat_row['cate_id'];
                                    $cat_name = $cat_row['categories'];
                                    $cat_slug = trim($cat_row['slug_url']);

                                    $pro_query = "SELECT * FROM `products` WHERE `pro_cate` = '$cate_id' AND `status` = 1 AND `is_disabled` = 0 ORDER BY `pro_name` ASC";
                                    $pro_result = mysqli_query($conn, $pro_query);

                                    if ($pro_result && mysqli_num_rows($pro_result) > 0) {
                            ?>
                            <li class="dropdown-submenu-left shb-hover-dropdown">
                                <a class="dropdown-item dropdown-toggle"
                                    href="<?php echo $site; ?>category/<?php echo urlencode($cat_slug); ?>">
                                    <?php echo htmlspecialchars(strtoupper($cat_name)); ?>
                                </a>
                                <ul class="dropdown-menu child-left-menu shadow border-0">
                                    <?php while ($pro_row = mysqli_fetch_assoc($pro_result)) { ?>
                                    <li>
                                        <a class="dropdown-item"
                                            href="<?php echo $site; ?>product/<?php echo urlencode(trim($pro_row['slug_url'])); ?>">
                                            <?php echo htmlspecialchars($pro_row['pro_name']); ?>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php } else { ?>
                            <li>
                                <a class="dropdown-item"
                                    href="<?php echo $site; ?>category/<?php echo urlencode($cat_slug); ?>">
                                    <?php echo htmlspecialchars(strtoupper($cat_name)); ?>
                                </a>
                            </li>
                            <?php
                                    }
                                }
                            } else {
                                echo '<li><a class="dropdown-item" href="#">No Categories Found</a></li>';
                            }
                            ?>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site; ?>blog">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site; ?>solution">Solution</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site; ?>It-services">IT services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site; ?>contact">Contact</a>
                    </li>

                </ul>

                <a href="<?php echo $site; ?>contact" class="btn btn-nav-cta ms-lg-3 mt-2 mt-lg-0">
                    Get in Touch
                </a>

            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let currentPath = window.location.pathname.replace(/\/$/, "");
        let currentSegment = currentPath.split("/").pop();

        const navLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.dropdown-toggle)');
        const productsDropdownToggle = document.getElementById('productsDropdown');

        navLinks.forEach(link => link.classList.remove('active'));
        if (productsDropdownToggle) productsDropdownToggle.classList.remove('active');

        navLinks.forEach(link => {
            let linkHref = (link.getAttribute('href') || '').replace(/\/$/, "");
            let linkSegment = linkHref.split("/").pop();

            if ((currentSegment === "" || currentSegment === "shbtechmed" || currentSegment === "index.php") && (linkSegment === "" || linkSegment === "shbtechmed")) {
                link.classList.add('active');
            } else if (linkSegment !== "" && linkSegment !== "shbtechmed" && currentSegment === linkSegment) {
                link.classList.add('active');
            }
        });

        if (
            currentPath.includes("/products") ||
            currentPath.includes("/category/") ||
            currentPath.includes("/product/")
        ) {
            if (productsDropdownToggle) {
                productsDropdownToggle.classList.add('active');
            }
        }
    });
    </script>