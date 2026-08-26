```php id="eqvbx7"
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
// Invalid Category
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

$meta_title = !empty($category['meta_title']) 
    ? $category['meta_title'] 
    : $category_name . " | SHB Technologies";

$meta_desc = !empty($category['meta_desc']) 
    ? $category['meta_desc'] 
    : $category_name;

$meta_key = !empty($category['meta_key']) 
    ? $category['meta_key'] 
    : $category_name;


// =============================================
// Products Fetch
// =============================================

$prod_stmt = $conn->prepare("
    SELECT * FROM `products`
    WHERE `pro_cate` = ?
    AND `status` = 1
    AND `is_disabled` = 0
    ORDER BY `id` DESC
");

$prod_stmt->bind_param("i", $category_id);

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter', sans-serif;
        }

        body{
            background:#f7f9fc;
            color:#0f172a;
        }

        .section-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 18px;
            background:#eaf4ff;
            border-radius:50px;
            color:#0d6efd;
            font-weight:600;
            margin-bottom:15px;
        }

        .section-heading{
            font-size:42px;
            font-weight:800;
            color:#0b2b5c;
        }

        .product-card{
            background:#fff;
            border-radius:24px;
            overflow:hidden;
            transition:0.4s;
            height:100%;
            box-shadow:0 10px 30px rgba(0,0,0,0.06);
        }

        .product-card:hover{
            transform:translateY(-8px);
        }

        .product-image-box{
            background:#f8fafc;
            padding:30px;
            text-align:center;
        }

        .product-img{
            width:100%;
            height:280px;
            object-fit:contain;
            transition:0.4s;
        }

        .product-card:hover .product-img{
            transform:scale(1.05);
        }

        .product-content{
            padding:28px;
        }

        .service-icon-circle{
            width:55px;
            height:55px;
            background:#eaf2ff;
            color:#0d6efd;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
        }

        .product-title{
            font-size:24px;
            font-weight:700;
            color:#0b2b5c;
            margin-bottom:14px;
        }

        .spec-badge{
            background:#eef4ff;
            color:#0d3b66;
            padding:8px 14px;
            border-radius:50px;
            font-size:13px;
            font-weight:600;
        }

        .btn-custom{
            background:#0d6efd;
            color:#fff;
            padding:12px 25px;
            border-radius:50px;
            text-decoration:none;
            display:inline-block;
            transition:0.3s;
        }

        .btn-custom:hover{
            background:#0b5ed7;
            color:#fff;
        }

        @media(max-width:991px){

            .section-heading{
                font-size:32px;
            }

            .product-img{
                height:220px;
            }

            .product-title{
                font-size:20px;
            }
        }

    </style>

</head>

<body>

<?php include('header.php'); ?>


<section class="py-5">

    <div class="container py-4">

        <div class="text-center mb-5">

            <span class="section-badge">
                <i class="bi bi-box-seam"></i>
                Category Catalog
            </span>

            <h1 class="section-heading">
                <?php echo htmlspecialchars($category_name); ?>
            </h1>

            <p class="text-secondary col-lg-7 mx-auto mt-4">
                Explore our premium range of products under 
                <?php echo htmlspecialchars($category_name); ?>.
            </p>

        </div>


        <div class="row g-4">

            <?php if(count($products) > 0){ ?>

                <?php foreach($products as $row){ 

                    // ======================================
                    // Image Path
                    // ======================================

                    $image_src = !empty($row['pro_img']) 
                        ? $row['pro_img'] 
                        : "no-image.png";

                ?>

                <div class="col-lg-4 col-md-6">

                    <div class="product-card h-100">

                        <div class="product-image-box">

                            <img 
                                src="<?php echo $site; ?>admin/assets/img/uploads/<?php echo htmlspecialchars($image_src); ?>" 
                                alt="<?php echo htmlspecialchars($row['pro_name']); ?>" 
                                class="product-img"
                            >

                        </div>

                        <div class="product-content">

                            <div class="service-icon-circle mb-3">
                                <i class="bi bi-activity"></i>
                            </div>

                            <h3 class="product-title">
                                <?php echo htmlspecialchars($row['pro_name']); ?>
                            </h3>

                            <div class="text-secondary mb-3">

                                <?php 
                                echo !empty($row['short_desc']) 
                                    ? $row['short_desc'] 
                                    : 'No description available.';
                                ?>

                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-3 mb-4">

                                <?php if(!empty($row['brand_name'])){ ?>

                                    <span class="spec-badge">
                                        <i class="bi bi-shield-check me-1"></i>
                                        <?php echo htmlspecialchars($row['brand_name']); ?>
                                    </span>

                                <?php } ?>


                                <?php if(isset($row['stock']) && $row['stock'] > 0){ ?>

                                    <span class="spec-badge">
                                        <i class="bi bi-check-circle me-1"></i>
                                        In Stock
                                    </span>

                                <?php } ?>

                            </div>

                            <a 
                                href="<?php echo $site; ?>product/<?php echo htmlspecialchars($row['slug_url']); ?>" 
                                class="btn-custom"
                            >
                                View Details
                            </a>

                        </div>

                    </div>

                </div>

                <?php } ?>

            <?php } else { ?>

                <div class="col-12 text-center py-5">

                    <i class="bi bi-exclamation-circle text-muted" style="font-size:3rem;"></i>

                    <p class="text-secondary mt-3">
                        No products available in this category yet.
                    </p>

                </div>

            <?php } ?>

        </div>

    </div>

</section>


<?php include('footer.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
