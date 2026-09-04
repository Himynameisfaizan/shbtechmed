<?php
// 1. Database Connection file
include('config/connect.php');

// 2. Fetch Product Data based on URL Slug
if (isset($_GET['slug'])) {
    $slug = mysqli_real_escape_string($conn, $_GET['slug']);
    
    $product_query = "SELECT * FROM `products` WHERE `slug_url` = '$slug' AND `status` = 1 LIMIT 1";
    $product_result = mysqli_query($conn, $product_query);
    
    if ($product_result && mysqli_num_rows($product_result) > 0) {
        $product = mysqli_fetch_assoc($product_result);
        
        $current_pro_id       = $product['id']; 
        $current_pro_cate     = $product['pro_cate']; 
        // FIX: Variable renamed to prevent clash with header.php loop
        $current_pro_name     = $product['pro_name'];
        $current_brand_name   = $product['brand_name'];
        $current_short_desc   = $product['short_desc'];
        $current_description  = $product['description']; 
        $current_pro_img      = $product['pro_img'];
        $current_stock        = $product['stock'];
        
        $meta_title   = !empty($product['meta_title']) ? $product['meta_title'] : $current_pro_name . " - SHB Technologies";
        $meta_desc    = !empty($product['meta_desc']) ? $product['meta_desc'] : $current_short_desc;
        $meta_key     = $product['meta_key'];
    } else {
        header("Location: " . $site . "products.php");
        exit();
    }
} else {
    header("Location: " . $site . "products.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($meta_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($meta_key); ?>">
    <base href="<?php echo $site; ?>">
    <!-- Standard CSS includes will come via header.php -->
</head>
<body>
    
    <?php include('inc/header.php'); ?>

    <!-- DYNAMIC BREADCRUMB -->
    <?php 
    $pageTitle = $current_pro_name; 
    $parentPage = "Products";
    $parentLink = $site . "products.php";
    include('inc/breadcrumb.php'); 
    ?>

    <!-- =========================================
         PRODUCT DETAIL SECTION
    ========================================= -->
    <section class="shb-product-detail-section py-5 bg-white">
        <div class="container py-4">
            
            <div class="row g-5 align-items-center mb-5 pb-4">
                
                <!-- Product Image Gallery (Left) -->
                <div class="col-lg-5">
                    <div class="shb-detail-image-box">
                        <?php 
                        $final_img = !empty($current_pro_img) 
                            ? $site . 'admin/assets/img/uploads/' . htmlspecialchars($current_pro_img) 
                            : $site . 'assets/images/no-image.png'; 
                        ?>
                        <img src="<?php echo $final_img; ?>" alt="<?php echo htmlspecialchars($current_pro_name); ?>" class="img-fluid shb-detail-main-img" />
                        
                        <!-- Custom Tag (e.g. In Stock / Medical Grade) -->
                        <div class="shb-detail-tags">
                            <?php if($current_stock > 0) { ?>
                                <span class="badge bg-success"><i class="bi bi-check2-circle me-1"></i> Available</span>
                            <?php } ?>
                            <span class="badge" style="background-color: #1a1a1a;"><i class="bi bi-shield-check me-1"></i> Medical Grade</span>
                        </div>
                    </div>
                </div>

                <!-- Product Info & Actions (Right) -->
                <div class="col-lg-7">
                    <div class="shb-detail-info-wrapper ps-lg-4">
                        
                        <!-- Brand/Category -->
                        <?php if(!empty($current_brand_name)): ?>
                            <p class="shb-detail-brand text-muted text-uppercase fw-bold letter-spacing-1 mb-2">
                                <i class="bi bi-building me-1"></i> <?php echo htmlspecialchars($current_brand_name); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Title -->
                        <h1 class="shb-detail-title mb-4">
                            <?php echo htmlspecialchars($current_pro_name); ?>
                        </h1>

                        <!-- Action Buttons (No Price shown) -->
                        <div class="shb-detail-action-box mb-4 p-4 rounded-3" style="background-color: #f8f9fa; border-left: 4px solid #cc0000;">
                            <p class="mb-3 text-secondary fw-medium">
                                For detailed technical specifications, bulk pricing, or installation queries, please contact our engineering team.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <!-- Call Now Button -->
                                <a href="tel:+918178037626" class="btn shb-btn-call">
                                    <i class="bi bi-telephone-outbound me-2"></i> Request a Call
                                </a>
                                <!-- Inquiry Button -->
                                <a href="<?php echo $site; ?>contact.php" class="btn shb-btn-inquiry">
                                    <i class="bi bi-envelope-paper me-2"></i> Send Inquiry
                                </a>
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="shb-detail-short-desc mb-4">
                            <?php if(!empty($current_short_desc)): ?>
                                <?php echo $current_short_desc; ?>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- =========================================
                 TABS FOR FULL DESCRIPTION
            ========================================= -->
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs shb-custom-tabs mb-4" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">Detailed Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">Installation & Support</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content shb-tab-content p-4 border rounded-bottom rounded-end" id="productTabContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="desc" role="tabpanel">
                            <?php 
                            if(!empty($current_description)) {
                                echo $current_description; 
                            } else {
                                echo "<p class='text-muted'>Detailed technical specifications will be provided upon inquiry.</p>";
                            }
                            ?>
                        </div>
                        <!-- Support Tab -->
                        <div class="tab-pane fade" id="shipping" role="tabpanel">
                            <ul class="list-unstyled shb-support-list">
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-danger me-2"></i> <strong>Professional Installation:</strong> Pan-India deployment by certified biomedical engineers.</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill text-danger me-2"></i> <strong>Maintenance:</strong> 24/7 technical support and Annual Maintenance Contracts (AMC) available.</li>
                                <li><i class="bi bi-check-circle-fill text-danger me-2"></i> <strong>Quality Assurance:</strong> All equipment complies with rigorous medical industry standards.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================
         RELATED PRODUCTS SECTION (DYNAMIC)
    ========================================= -->
    <?php
    // Fetch 3 related products from the same category, excluding the current product
    $related_query = mysqli_query($conn, "
        SELECT * FROM products 
        WHERE pro_cate = '$current_pro_cate' 
        AND id != '$current_pro_id' 
        AND status = 1 
        AND is_disabled = 0 
        ORDER BY RAND() 
        LIMIT 3
    ");

    if ($related_query && mysqli_num_rows($related_query) > 0) {
    ?>
    <section class="shb-related-products py-5 bg-light border-top">
        <div class="container py-3">
            <h3 class="fw-bold mb-4" style="color: #1a1a1a;">
                Related <span style="color: #cc0000;">Equipment</span>
            </h3>
            
            <div class="row g-4">
                <?php while($rel = mysqli_fetch_assoc($related_query)) { 
                    $rel_img = !empty($rel['pro_img']) ? $site . 'admin/assets/img/uploads/' . $rel['pro_img'] : $site . 'assets/images/no-image.png';
                    
                    // FIX: Direct PHP file link with GET parameter for related products too
                    $rel_link = $site . 'product-detail.php?slug=' . $rel['slug_url'];
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="shb-pro-card-modern d-flex flex-column h-100">
                        <div class="shb-pro-img-wrapper" style="height: 200px;">
                            <a href="<?php echo $rel_link; ?>">
                                <img src="<?php echo $rel_img; ?>" alt="<?php echo htmlspecialchars($rel['pro_name']); ?>">
                            </a>
                        </div>
                        <div class="shb-pro-content-wrapper p-3">
                            <h5 class="fw-bold mb-2">
                                <a href="<?php echo $rel_link; ?>" class="text-dark text-decoration-none hover-danger">
                                    <?php echo htmlspecialchars($rel['pro_name']); ?>
                                </a>
                            </h5>
                            <a href="<?php echo $rel_link; ?>" class="shb-minimal-link small">
                                View Details <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php include('inc/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>