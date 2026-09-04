<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <title>
    SHB Technologies & Medical Systems | Innovation in Healthcare Tech
  </title>
</head>

<body>

<?php 
include ('config/connect.php');
include('inc/header.php'); 
?>

<!-- 2. Dynamic Breadcrumb Include -->
<?php 
$pageTitle = "Medical Equipment Catalog"; 
include('inc/breadcrumb.php'); 
$limit = 9;
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Total products count karna taaki total pages nikal sakein
$count_query = mysqli_query($conn, "SELECT COUNT(id) AS total FROM products WHERE status = 1 AND is_disabled = 0");
$count_row = mysqli_fetch_assoc($count_query);
$total_records = $count_row['total'];
$total_pages = ceil($total_records / $limit);
?>

<!-- =========================================
     PRODUCTS GRID SECTION (DYNAMIC & LUXURY)
========================================= -->

<section class="shb-products-page py-5 bg-white">
    <div class="container py-4">

        <!-- Page Intro -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <span class="shb-subtitle justify-content-center">
                    <span class="shb-dot"></span> Full Catalog
                </span>
                <h2 class="shb-main-heading mt-2 mb-3">
                    Premium <span style="color: #cc0000;">Medical Equipment</span>
                </h2>
                <p class="shb-sub-text">
                    Explore our comprehensive range of high-precision medical gas pipeline systems, modular operation theaters, and advanced healthcare infrastructure solutions.
                </p>
                <div class="text-muted small mt-2">
                    Showing page <?php echo $page; ?> of <?php echo $total_pages > 0 ? $total_pages : 1; ?> 
                    (Total <?php echo $total_records; ?> Products)
                </div>
            </div>
        </div>

        <!-- Dynamic Product Grid -->
        <div class="row g-5">
            <?php
            // 3. Database se products fetch karna with LIMIT and OFFSET for pagination
            $product_query = mysqli_query($conn, "
                SELECT * FROM products 
                WHERE status = 1 
                AND is_disabled = 0 
                ORDER BY id DESC 
                LIMIT $offset, $limit
            ");

            if ($product_query && mysqli_num_rows($product_query) > 0) {
                while ($row = mysqli_fetch_assoc($product_query)) {

                    // Image Path Set Karna (with Fallback)
                    $product_image = !empty($row['pro_img'])
                        ? $site . 'admin/assets/img/uploads/' . $row['pro_img']
                        : $site . 'assets/images/no-image.png';

                    // FIX: Direct PHP file link with GET parameter (?slug=...)
                    $product_link = $site . 'product-detail.php?slug=' . $row['slug_url'];
            ?>

            <!-- Individual Product Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="shb-pro-card-modern d-flex flex-column h-100">
                    
                    <!-- Top Image Area -->
                    <div class="shb-pro-img-wrapper">
                        <!-- Red Tag/Badge if product is new/trending -->
                        <?php if($row['new_arrival'] == 1 || $row['trending'] == 1) { ?>
                            <span class="shb-pro-tag">Featured</span>
                        <?php } ?>
                        
                        <a href="<?php echo $product_link; ?>">
                            <img src="<?php echo $product_image; ?>" alt="<?php echo htmlspecialchars($row['pro_name']); ?>" class="img-fluid">
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
                        
                        <!-- Optional Brand/Category Name Mapped from DB -->
                        <?php if(!empty($row['brand_name'])) { ?>
                            <small class="shb-pro-brand text-muted text-uppercase fw-bold letter-spacing-1 mb-2 d-block">
                                <?php echo htmlspecialchars($row['brand_name']); ?>
                            </small>
                        <?php } ?>

                        <h3 class="shb-pro-title-main">
                            <a href="<?php echo $product_link; ?>">
                                <?php echo htmlspecialchars($row['pro_name']); ?>
                            </a>
                        </h3>
                        
                        <!-- Short Description (Trimmed so cards stay uniform) -->
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
                                <?php if($row['stock'] > 0) { ?>
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

            <?php 
                } // End while loop
            } else { 
            ?>
                <!-- Fallback if database is empty -->
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border">
                        <i class="bi bi-info-circle text-danger fs-3 d-block mb-2"></i>
                        <h5 class="fw-bold">No Products Found</h5>
                        <p class="text-muted mb-0">We are currently updating our catalog. Please check back later.</p>
                    </div>
                </div>
            <?php } ?>

        </div>

        <!-- =========================================
             PREMIUM PAGINATION UI
        ========================================= -->
        <?php if ($total_pages > 1) { ?>
        <div class="row mt-5 pt-3">
            <div class="col-12">
                <nav aria-label="Product Catalog Pagination">
                    <ul class="pagination shb-custom-pagination justify-content-center mb-0">
                        
                        <!-- Previous Button -->
                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="products.php?page=<?php echo $page - 1; ?>" tabindex="-1" aria-disabled="true">
                                <i class="bi bi-chevron-left"></i> Prev
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="products.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>

                        <!-- Next Button -->
                        <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="products.php?page=<?php echo $page + 1; ?>">
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

<?php 
include('inc/footer.php'); 
?>