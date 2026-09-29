<?php 
include('config/connect.php');

$limit = 9; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) *$limit;

$count_query = mysqli_query($conn, "SELECT COUNT(blog_id) AS total FROM blogs WHERE status = 1");
$count_row = mysqli_fetch_assoc($count_query);$total_records = $count_row['total'];$total_pages = ceil($total_records / $limit);

$blog_query = "SELECT * FROM `blogs` WHERE `status` = 1 ORDER BY `blog_id` DESC LIMIT $offset,$limit";
$blog_result = mysqli_query($conn,$blog_query);

$meta_title = "Insights & News - SHB Technologies";
$meta_desc = "Read our latest articles, insights, and news on medical equipment, hospital infrastructure, and technological advancements.";
$meta_key = "medical news, hospital infrastructure blog, SHB technologies updates";

include('inc/header.php'); 

$pageTitle = "Insights & News"; 
include('inc/breadcrumb.php'); 
?>

<!-- =========================================
     BLOG GRID SECTION (LUXURY THEME)
========================================= -->
<section class="shb-blog-page py-5 bg-white">
    <div class="container py-4">

        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <span class="shb-subtitle justify-content-center">
                    <span class="shb-dot"></span> Our Blog
                </span>
                <h1 class="shb-main-heading mt-2 mb-3">
                    Latest <span style="color: #cc0000;">Insights</span> & News
                </h1>
                <p class="shb-sub-text">
                    Stay updated with the latest trends in medical technology, healthcare infrastructure, and expert insights from our team.
                </p>
                <div class="text-muted small mt-2">
                    Showing page <?php echo $page; ?> of <?php echo $total_pages > 0 ?$total_pages : 1; ?> 
                </div>
            </div>
        </div>

        <div class="row g-5">
            <?php if ($blog_result && mysqli_num_rows($blog_result) > 0) { 
                while ($row = mysqli_fetch_assoc($blog_result)) {
                    $blog_image = !empty($row['image']) 
                        ? $site . 'admin/assets/img/uploads/blogs/' . htmlspecialchars($row['image']) 
                        : $site . 'assets/images/no-image.png';

                    $blog_link = $site . 'blog-detail.php?slug=' . htmlspecialchars($row['slug']);
                    $date = !empty($row['created_at']) ? date("F j, Y", strtotime($row['created_at'])) : date("F j, Y");
            ?>

            <div class="col-lg-4 col-md-6 mb-4">
                <article class="shb-blog-card h-100 d-flex flex-column">
                    <div class="shb-blog-img-box">
                        <a href="<?php echo $blog_link; ?>">
                            <img src="<?php echo $blog_image; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="img-fluid">
                        </a>
                        <div class="shb-blog-date">
                            <i class="bi bi-calendar3 me-1"></i> <?php echo $date; ?>
                        </div>
                    </div>

                    <div class="shb-blog-content flex-grow-1 d-flex flex-column">
                        <div class="shb-blog-meta mb-2">
                            <span class="text-uppercase fw-bold letter-spacing-1" style="color: #cc0000; font-size: 0.8rem;">
                                <i class="bi bi-person me-1"></i> <?php echo htmlspecialchars($row['author']); ?>
                            </span>
                        </div>
                        
                        <h3 class="shb-blog-title mb-3">
                            <a href="<?php echo $blog_link; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                        </h3>
                        
                        <p class="shb-blog-excerpt flex-grow-1">
                            <?php 
                            $desc_clean = strip_tags($row['description']);
                            echo strlen($desc_clean) > 120 ? substr($desc_clean, 0, 120) . '...' :$desc_clean;
                            ?>
                        </p>
                        
                        <div class="mt-4 pt-3 border-top">
                            <a href="<?php echo $blog_link; ?>" class="shb-minimal-link">
                                Read Article <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <?php } } else { ?>
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border">
                        <i class="bi bi-journal-x text-danger fs-3 d-block mb-2"></i>
                        <h5 class="fw-bold">No Articles Found</h5>
                        <p class="text-muted mb-0">Check back later for new insights and updates.</p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if ($total_pages > 1) { ?>
        <div class="row mt-5 pt-3">
            <div class="col-12">
                <nav aria-label="Blog Pagination">
                    <ul class="pagination shb-custom-pagination justify-content-center mb-0">
                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="blog.php?page=<?php echo $page - 1; ?>"><i class="bi bi-chevron-left"></i> Prev</a>
                        </li>
                        <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                            <li class="page-item <?php echo ($page ==$i) ? 'active' : ''; ?>">
                                <a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?php echo ($page >=$total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="blog.php?page=<?php echo $page + 1; ?>">Next <i class="bi bi-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <?php } ?>

    </div>
</section>

<?php include('inc/footer.php'); ?>