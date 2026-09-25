<?php
include('config/connect.php');

if (isset($_GET['slug'])) {
    $slug = mysqli_real_escape_string($conn, $_GET['slug']);          // 1. Fetch Current Blog based on Slug
    $blog_query = "SELECT * FROM `blogs` WHERE `slug` = '$slug' AND `status` = 1 LIMIT 1";
    $blog_result = mysqli_query($conn,$blog_query);
    
    if ($blog_result && mysqli_num_rows($blog_result) > 0) {
        $blog = mysqli_fetch_assoc($blog_result);
        
        $blog_id      =$blog['blog_id'];
        // FIX: Renamed variable to $blog_title so it doesn't clash with breadcrumb.php
        $blog_title   =$blog['title']; 
        $blog_author  =$blog['author'];
        $blog_desc    =$blog['description']; 
        $blog_image   =$blog['image'];
        $blog_date    = !empty($blog['created_at']) ? date("F j, Y", strtotime($blog['created_at'])) : date("F j, Y");
        
        // Dynamic SEO Tags
        $meta_title   = !empty($blog['meta_title']) ? $blog['meta_title'] :$blog_title . " - SHB Technologies";
        $meta_desc    = !empty($blog['meta_desc']) ? $blog['meta_desc'] : substr(strip_tags($blog_desc), 0, 160);
        $meta_key     =$blog['meta_key'];
    } else {
        header("Location: " . $site . "blog.php");
        exit();
    }
} else {
    header("Location: " . $site . "blog.php");
    exit();
}

// 2. Fetch Contact Data for WhatsApp & Map (From DB)
$contact_query = mysqli_query($conn, "SELECT wp_number, map FROM contacts LIMIT 1");
$contact_data = mysqli_fetch_assoc($contact_query);

// Clean WP number for WhatsApp API link (removes spaces, hyphens)
$raw_wp = !empty($contact_data['wp_number']) ?$contact_data['wp_number'] : '918178037626';
$clean_wp = preg_replace('/[^0-9]/', '',$raw_wp); 

// Map Fallback (Agar DB mein map khali ho toh default Mayur Vihar ka dikhayega)
$map_iframe = !empty($contact_data['map']) ?$contact_data['map'] : '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14013.385552319082!2d77.31557285!3d28.58933255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce4f09d8bf61d%3A0xc3c942485e985834!2sMayur%20Vihar%20Phase%203%2C%20Delhi%2C%20110096!5e0!3m2!1sen!2sin!4v1680000000000!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

// 3. Fetch Recent Other Blogs for Sidebar
$recent_blogs = mysqli_query($conn, "SELECT title, slug, image, created_at FROM blogs WHERE slug != '$slug' AND status = 1 ORDER BY blog_id DESC LIMIT 4");
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
    <!-- Standard CSS includes via header.php -->
</head>
<body>
    
    <?php include('inc/header.php'); ?>

    <!-- DYNAMIC BREADCRUMB -->
    <?php 
    // FIX: Using the correct DB Title here
    $pageTitle =$blog_title; 
    $parentPage = "Blog";
    $parentLink =$site . "blog.php";
    include('inc/breadcrumb.php'); 
    ?>

    <!-- =========================================
         BLOG DETAIL TWO-COLUMN SECTION
    ========================================= -->
    <section class="shb-blog-detail-wrapper py-5 bg-white">
        <div class="container py-4">
            
            <div class="row g-5">
                
                <!-- LEFT SIDE: MAIN CONTENT -->
                <div class="col-lg-8">
                    <article class="shb-main-article">
                        
                        <!-- Meta Info -->
                        <div class="shb-article-meta mb-3">
                            <span class="badge bg-light text-danger border border-danger p-2 px-3 fw-bold letter-spacing-1 me-2">
                                <i class="bi bi-person me-1"></i> <?php echo htmlspecialchars($blog_author); ?>
                            </span>
                            <span class="text-muted fw-medium">
                                <i class="bi bi-calendar3 me-1"></i> <?php echo $blog_date; ?>
                            </span>
                        </div>
                        
                        <!-- ONLY ONE H1 TAG FOR SEO -->
                        <h1 class="shb-article-title mb-4">
                            <?php echo htmlspecialchars($blog_title); ?>
                        </h1>

                        <!-- Featured Image -->
                        <div class="shb-article-image-box mb-4">
                            <?php 
                            $final_img = !empty($blog_image) 
                                ? $site . 'admin/assets/img/uploads/blogs/' . htmlspecialchars($blog_image) 
                                : $site . 'assets/images/no-image.png'; 
                            ?>
                            <img src="<?php echo $final_img; ?>" alt="<?php echo htmlspecialchars($blog_title); ?>" class="img-fluid rounded-4 shadow-sm w-100" />
                        </div>

                        <!-- Main Description (HTML Content) -->
                        <div class="shb-article-body">
                            <?php echo $blog_desc; ?>
                        </div>

                    </article>
                </div>

                <!-- RIGHT SIDE: SIDEBAR -->
                <div class="col-lg-4">
                    <aside class="shb-sidebar">
                        
                        <!-- DYNAMIC WHATSAPP WIDGET -->
                        <div class="shb-sidebar-widget shb-whatsapp-widget text-center mb-5">
                            <div class="wp-icon-wrapper mb-3">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <h4 class="fw-bold text-white mb-2">Need Quick Assistance?</h4>
                            <p class="text-white-50 small mb-4">Chat with our engineering and support team instantly on WhatsApp.</p>
                            <a href="https://wa.me/<?php echo $clean_wp; ?>?text=Hi, I am reading the article '<?php echo urlencode($blog_title); ?>' and need some information." target="_blank" class="btn btn-light w-100 fw-bold wp-chat-btn">
                                Start Chat <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>

                        <!-- OTHER BLOGS WIDGET -->
                        <div class="shb-sidebar-widget">
                            <h4 class="widget-title mb-4">Recent Articles</h4>
                            
                            <?php if ($recent_blogs && mysqli_num_rows($recent_blogs) > 0) { ?>
                                <div class="shb-recent-post-list">
                                    <?php while($rb = mysqli_fetch_assoc($recent_blogs)) { 
                                        $rb_img = !empty($rb['image']) ? $site . 'admin/assets/img/uploads/' . htmlspecialchars($rb['image']) : $site . 'assets/images/no-image.png';$rb_link = $site . 'blog-detail.php?slug=' . htmlspecialchars($rb['slug']);
                                        $rb_date = !empty($rb['created_at']) ? date("M j, Y", strtotime($rb['created_at'])) : '';
                                    ?>
                                    
                                    <a href="<?php echo $rb_link; ?>" class="shb-recent-post-item">
                                        <img src="<?php echo $rb_img; ?>" alt="Thumb">
                                        <div class="recent-post-info">
                                            <h6 class="mb-1"><?php echo htmlspecialchars($rb['title']); ?></h6>
                                            <small class="text-muted"><i class="bi bi-clock me-1"></i> <?php echo $rb_date; ?></small>
                                        </div>
                                    </a>
                                    
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <p class="text-muted small">No recent articles found.</p>
                            <?php } ?>
                        </div>

                    </aside>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================
         BOTTOM INQUIRY SECTION (MAP + FORM)
    ========================================= -->
    <section class="shb-bottom-inquiry border-top">
        <div class="container-fluid p-0">
            <div class="row g-0">
                
                <!-- Left: Google Map -->
                <div class="col-lg-6">
                    <div class="shb-map-wrapper h-100">
                        <?php echo $map_iframe; ?>
                    </div>
                </div>

                <!-- Right: Inquiry Form -->
                <div class="col-lg-6 bg-light">
                    <div class="shb-inquiry-form-wrapper p-4 p-lg-5">
                        <!-- Use H2 here to keep H1 unique for SEO -->
                        <h2 class="fw-bold mb-3">Leave an Inquiry</h2>
                        <p class="text-muted mb-4">Interested in our medical equipment or services? Drop us a message below.</p>
                        
                        <form action="#" method="post">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control px-3 py-2" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control px-3 py-2" placeholder="Email Address" required>
                                </div>
                                <div class="col-12">
                                    <input type="tel" class="form-control px-3 py-2" placeholder="Phone Number" required>
                                </div>
                                <div class="col-12">
                                    <textarea rows="4" class="form-control px-3 py-2" placeholder="Type your message here..." required></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="button" class="btn btn-danger px-4 py-2 w-100 fw-bold" onclick="alert('Inquiry Sent!')">Submit Inquiry</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include('inc/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>