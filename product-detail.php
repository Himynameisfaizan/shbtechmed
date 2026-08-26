<?php
// 1. Database Connection file ko include karein
include('config/connect.php');

// 2. Checking if slug parameter exists in URL string 
if (isset($_GET['slug'])) {
    // SQL Injection se bachne ke liye string sanitize karein
    $slug = mysqli_real_escape_string($conn, $_GET['slug']);
    
    // Product details fetch karne ke liye query chalaein
    $product_query = "SELECT * FROM `products` WHERE `slug_url` = '$slug' AND `status` = 1 LIMIT 1";
    $product_result = mysqli_query($conn, $product_query);
    
    if ($product_result && mysqli_num_rows($product_result) > 0) {
        $product = mysqli_fetch_assoc($product_result);
        
        // Data variables asign karein database columns ke mutabik
        $pro_name     = $product['pro_name'];
        $brand_name   = $product['brand_name'];
        $short_desc   = $product['short_desc'];
        $description  = $product['description']; // Isme HTML content ho sakta hai (<p>, etc.)
        $pro_img      = $product['pro_img'];
        
        // SEO Meta data parameters fallbacks ke sath
        $meta_title   = !empty($product['meta_title']) ? $product['meta_title'] : $pro_name . " - SHB Technologies";
        $meta_desc    = !empty($product['meta_desc']) ? $product['meta_desc'] : $short_desc;
        $meta_key     = $product['meta_key'];
    } else {
        // Agar slug match nahi karta to index page par redirect karein ya 404 handler setup karein
        header("Location: " . $base_url . "index.php");
        exit();
    }
} else {
    // Agar direct entry ho bina slug ke
    header("Location: " . $base_url . "index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    
    <title><?php echo htmlspecialchars($meta_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($meta_key); ?>">
    
    <base href="<?php echo $base_url; ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap" rel="stylesheet" />
    
    <style>
      :root {
        --deep-navy: #061428;
        --navy: #0b2b5c;
        --steel-blue: #1a5f8a;
        --ocean: #1e6f9f;
        --teal-accent: #219897;
        --sky-light: #e8f4f9;
        --surface-white: #ffffff;
        --surface-soft: #f7fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-500: #64748b;
        --gray-700: #334155;
        --gray-900: #0f172a;
        --text-primary: #0a1e3d;
        --text-secondary: #475569;
        --accent-glow: rgba(30, 111, 159, 0.25);
        --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 6px 24px rgba(0, 0, 0, 0.06);
        --card-shadow-hover: 0 4px 12px rgba(0, 0, 0, 0.06), 0 20px 40px rgba(0, 0, 0, 0.12);
        --radius-sm: 12px;
        --radius-md: 18px;
        --radius-lg: 24px;
        --radius-xl: 30px;
        --transition-smooth: 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --transition-bounce: 0.45s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      * {
        font-family: "Inter", system-ui, -apple-system, sans-serif;
        box-sizing: border-box;
      }

      html {
        scroll-behavior: smooth;
        scroll-padding-top: 90px;
      }

      body {
        background-color: #fafcfd;
        color: var(--text-primary);
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        line-height: 1.65;
      }

      body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        background:
          radial-gradient(ellipse at 15% 10%, rgba(30, 111, 159, 0.03) 0%, transparent 60%),
          radial-gradient(ellipse at 85% 70%, rgba(33, 152, 151, 0.03) 0%, transparent 60%),
          radial-gradient(ellipse at 50% 40%, rgba(11, 43, 92, 0.02) 0%, transparent 70%);
        background-size: 100% 100%;
      }

      .navbar {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.04), 0 8px 24px rgba(0, 0, 0, 0.04);
        padding: 0.8rem 0;
        transition: all var(--transition-smooth);
        border-bottom: 1px solid rgba(30, 111, 159, 0.07);
        z-index: 1030;
      }

      .btn-nav-cta {
        background: linear-gradient(135deg, #1e6f9f, #1a5f8a);
        border: none;
        padding: 0.6rem 1.7rem;
        font-weight: 600;
        border-radius: 40px;
        transition: all var(--transition-bounce);
        box-shadow: 0 4px 14px rgba(30, 111, 159, 0.25);
        color: #fff;
        font-size: 0.9rem;
        letter-spacing: 0.2px;
        white-space: nowrap;
        text-decoration: none;
        display: inline-block;
      }

      .btn-nav-cta:hover {
        background: linear-gradient(135deg, #1a5f8a, #0e4d6e);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(30, 111, 159, 0.35);
        color: #fff;
      }

      .service-icon-circle {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        background: linear-gradient(135deg, #e8f4f9, #dceef8);
        color: #1e6f9f;
        margin-bottom: 1.3rem;
        transition: all var(--transition-bounce);
      }

      .reveal-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.7s ease-out, transform 0.7s ease-out;
      }

      .reveal-on-scroll.revealed {
        opacity: 1;
        transform: translateY(0);
      }

      /* Product Custom Layout Styles */
      .product-card {
        border-radius: 24px;
        overflow: hidden;
        transition: 0.4s ease;
      }

      .product-card:hover {
        transform: translateY(-5px);
      }

      .product-image-box {
        background: #f8fafc;
        border-radius: 20px;
        padding: 20px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(0,0,0,0.02);
      }

      .product-img {
        width: 100%;
        max-height: 380px;
        object-fit: contain;
      }

      .product-title {
        color: var(--deep-navy);
        font-size: 36px;
      }

      .product-brand-badge {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--teal-accent);
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: block;
      }

      @media (max-width: 991px) {
        .product-title {
          font-size: 28px;
        }
        .product-img {
          max-height: 280px;
        }
      }
      @media (max-width: 768px) {
        .product-title {
          font-size: 24px;
        }
      }
    </style>
  </head>
  <body>
    
    <?php include('header.php'); ?>

    <section id="products" class="py-5 bg-white">
      <div class="container py-4">
        
        <div class="card border-0 shadow-sm mb-5 reveal-on-scroll product-card">
          <div class="card-body p-4 p-lg-5">
            <div class="row align-items-center g-5">
              
              <div class="col-lg-5">
                <div class="product-image-box">
                  <?php if(!empty($pro_img)): ?>
                    <img src="<?php echo $site; ?>admin/assets/img/uploads/<?php echo htmlspecialchars($pro_img); ?>" alt="<?php echo htmlspecialchars($pro_name); ?>" class="img-fluid product-img" />
                  <?php else: ?>
                    <img src="images/default-product.jpg" alt="No image available" class="img-fluid product-img" />
                  <?php endif; ?>
                </div>
              </div>

              <div class="col-lg-7">
                
                <?php if(!empty($brand_name)): ?>
                  <span class="product-brand-badge"><?php echo htmlspecialchars($brand_name); ?></span>
                <?php endif; ?>

                <div class="service-icon-circle mb-3">
                  <i class="bi bi-box-seam-fill"></i>
                </div>

                <h1 class="fw-bold mb-3 product-title">
                  <?php echo htmlspecialchars($pro_name); ?>
                </h1>

                <div class="text-secondary product-description-area mb-4">
                  <?php if(!empty($short_desc)): ?>
                <?php echo $short_desc; ?>
                  <?php endif; ?>
                  
                  <?php echo $description; ?>
                </div>

                <a href="<?php echo $site; ?>contact.php" class="btn btn-nav-cta mt-2">
                  Get in Touch
                </a>
                
              </div>

            </div>
          </div>
        </div>

      </div>
    </section>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Scroll functionality logic for navbar
      const navbar = document.getElementById("mainNavbar");
      if(navbar) {
        window.addEventListener("scroll", () => {
          if (window.scrollY > 40) navbar.classList.add("scrolled");
          else navbar.classList.remove("scrolled");
        });
      }

      // Scroll Reveal triggers
      const revealElements = document.querySelectorAll(".reveal-on-scroll");
      const observerOptions = {
        root: null,
        rootMargin: "0px 0px -40px 0px",
        threshold: 0.12,
      };
      
      const revealCallback = (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const delay = Array.from(revealElements).indexOf(entry.target) * 40;
            setTimeout(() => {
              entry.target.classList.add("revealed");
            }, Math.min(delay, 300));
            observer.unobserve(entry.target);
          }
        });
      };
      
      const observer = new IntersectionObserver(revealCallback, observerOptions);
      revealElements.forEach((el) => observer.observe(el));
      
      window.addEventListener("load", () => {
        revealElements.forEach((el) => {
          const rect = el.getBoundingClientRect();
          if (rect.top < window.innerHeight && rect.bottom > 0)
            el.classList.add("revealed");
        });
      });
    </script>
  </body>
</html>