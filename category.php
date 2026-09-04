<?php 
include('config/connect.php');

// =============================================
// Slug Validation
// =============================================
if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    header("Location: index.php");
    exit();
}

$slug_url = trim($_GET['slug']);

// =============================================
// Category Fetch
// =============================================
$cate_stmt = $conn->prepare("
    SELECT * FROM `categories` 
    WHERE `slug_url` = ? 
    AND `status` = 1 
    LIMIT 1
");
$cate_stmt->bind_param("s", $slug_url);
$cate_stmt->execute();
$cate_result = $cate_stmt->get_result();
$category = $cate_result->fetch_assoc();

// =============================================
// Invalid Category Handling
// =============================================
if (!$category) {
    echo "
    <center style='padding:80px 20px; font-family:Arial;'>
        <h2>Category Not Found!</h2>
        <a href='index.php'>Go Back Home</a>
    </center>
    ";
    exit();
}

// =============================================
// Category Variables
// =============================================
$category_name = $category['categories'];
$category_id   = $category['cate_id'];

// =============================================
// SEO Meta
// =============================================
$meta_title = !empty($category['meta_title']) ? $category['meta_title'] : $category_name . " | SHB Technologies";
$meta_desc = !empty($category['meta_desc']) ? $category['meta_desc'] : $category_name;
$meta_key = !empty($category['meta_key']) ? $category['meta_key'] : $category_name;

// ==========================================
// PAGINATION SETUP LOGIC (NEW)
// ==========================================
$limit = 9; // Ek page par 9 products
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total products in THIS specific category
$count_stmt = $conn->prepare("SELECT COUNT(id) AS total FROM `products` WHERE `pro_cate` = ? AND `status` = 1 AND `is_disabled` = 0");
$count_stmt->bind_param("i", $category_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$count_row = $count_result->fetch_assoc();
$total_records = $count_row['total'];
$total_pages = ceil($total_records / $limit);

// =============================================
// Products Fetch (With Limit & Offset)
// =============================================
$prod_stmt = $conn->prepare("
    SELECT * FROM `products`
    WHERE `pro_cate` = ?
    AND `status` = 1
    AND `is_disabled` = 0
    ORDER BY `id` DESC
    LIMIT ?, ?
");
$prod_stmt->bind_param("iii", $category_id, $offset, $limit);
$prod_stmt->execute();
$prod_result = $prod_stmt->get_result();

$products = [];
while ($row = $prod_result->fetch_assoc()) {
    $products[] = $row;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($meta_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($meta_key); ?>">
    <!-- Standard CSS includes will come via header.php -->
</head>

<body>

<?php include('inc/header.php'); ?>

<!-- DYNAMIC BREADCRUMB -->
<?php 
$pageTitle = $category_name; 
$parentPage = "Products";
$parentLink = $site . "products.php";
include('inc/breadcrumb.php'); 
?>

<!-- =========================================
     CATEGORY PRODUCTS GRID (LUXURY THEME)
========================================= -->
<section class="shb-products-page py-5 bg-white">
    <div class="container py-4">

        <!-- Header -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <span class="shb-subtitle justify-content-center">
                    <span class="shb-dot"></span> Category Overview
                </span>
                <h2 class="shb-main-heading mt-2 mb-3">
                    <?php echo htmlspecialchars($category_name); ?>
                </h2>
                <p class="shb-sub-text">
                    Explore our premium range of precision-engineered equipment under this category.
                </p>
                <div class="text-muted small mt-2">
                    Showing page <?php echo $page; ?> of <?php echo $total_pages > 0 ? $total_pages : 1; ?> 
                    (Total <?php echo $total_records; ?> Products)
                </div>
            </div>
        </div>

        <div class="row g-5">
            <?php if(count($products) > 0){ ?>

                <?php foreach($products as $row){ 
                    // Image Path Fallback
                    $image_src = !empty($row['pro_img']) 
                        ? $site . 'admin/assets/img/uploads/' . $row['pro_img'] 
                        : $site . 'assets/images/no-image.png';

                    // Direct PHP file link with GET parameter
                    $product_link = $site . 'product-detail.php?slug=' . $row['slug_url'];
                ?>

                <!-- Individual Product Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="shb-pro-card-modern d-flex flex-column h-100">
                        
                        <!-- Top Image Area -->
                        <div class="shb-pro-img-wrapper">
                            <?php if($row['new_arrival'] == 1 || $row['trending'] == 1) { ?>
                                <span class="shb-pro-tag">Featured</span>
                            <?php } ?>
                            
                            <a href="<?php echo $product_link; ?>">
                                <img src="<?php echo $image_src; ?>" alt="<?php echo htmlspecialchars($row['pro_name']); ?>" class="img-fluid">
                            </a>
                            
                            <!-- Hover Overlay Button -->
                            <div class="shb-pro-img-overlay">
                                <a href="<?php echo $product_link; ?>" class="shb-pro-quick-view">
                                    View Details
                                </a>
                            </div>
                        </div>

                        <!-- Bottom Content Area -->
                        <div class="shb-pro-content-wrapper flex-grow-1 d-flex flex-column">
                            
                            <?php if(!empty($row['brand_name'])){ ?>
                                <small class="shb-pro-brand text-muted text-uppercase fw-bold letter-spacing-1 mb-2 d-block">
                                    <?php echo htmlspecialchars($row['brand_name']); ?>
                                </small>
                            <?php } ?>

                            <h3 class="shb-pro-title-main">
                                <a href="<?php echo $product_link; ?>">
                                    <?php echo htmlspecialchars($row['pro_name']); ?>
                                </a>
                            </h3>
                            
                            <p class="shb-pro-short-desc flex-grow-1">
                                <?php 
                                echo !empty($row['short_desc']) 
                                    ? substr(strip_tags($row['short_desc']), 0, 95) . '...'
                                    : 'Advanced healthcare solution engineered for reliability and critical care performance.';
                                ?>
                            </p>

                            <!-- Bottom Strip: Stock Status & Link -->
                            <div class="shb-pro-footer mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                <div class="shb-stock-status">
                                    <?php if(isset($row['stock']) && $row['stock'] > 0){ ?>
                                        <span class="text-success small fw-bold"><i class="bi bi-check-circle-fill me-1"></i> In Stock</span>
                                    <?php } else { ?>
                                        <span class="text-danger small fw-bold"><i class="bi bi-x-circle-fill me-1"></i> Out of Stock</span>
                                    <?php } ?>
                                </div>
                                
                                <a href="<?php echo $product_link; ?>" class="shb-minimal-link">
                                    Explore <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <?php } ?>

            <?php } else { ?>

                <!-- Fallback if no products in category -->
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border">
                        <i class="bi bi-info-circle text-danger fs-3 d-block mb-2"></i>
                        <h5 class="fw-bold">No Products Found</h5>
                        <p class="text-muted mb-0">We are currently updating our catalog for this category. Please check back later.</p>
                    </div>
                </div>

            <?php } ?>

        </div>

        <!-- =========================================
             PREMIUM PAGINATION UI
        ========================================= -->
        <?php if ($total_pages > 1) { 
            // URL encode logic for safety
            $safe_slug = urlencode($slug_url);
        ?>
        <div class="row mt-5 pt-3">
            <div class="col-12">
                <nav aria-label="Category Pagination">
                    <ul class="pagination shb-custom-pagination justify-content-center mb-0">
                        
                        <!-- Previous Button -->
                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="category.php?slug=<?php echo $safe_slug; ?>&page=<?php echo $page - 1; ?>" tabindex="-1" aria-disabled="true">
                                <i class="bi bi-chevron-left"></i> Prev
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="category.php?slug=<?php echo $safe_slug; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>

                        <!-- Next Button -->
                        <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="category.php?slug=<?php echo $safe_slug; ?>&page=<?php echo $page + 1; ?>">
                                Next <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </div>
        <?php } ?>

    </div>
</section>

<?php include('inc/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>