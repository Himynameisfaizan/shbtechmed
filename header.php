<?php include('config/connect.php'); ?>

<nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
  <div class="container">

    <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo $site; ?>index.php">
      <img src="<?php echo $site; ?>images/logo.jpg" alt="SHB Technologies Logo" class="main-logo" />
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-1">

        <li class="nav-item">
          <a class="nav-link active" href="<?php echo $site; ?>index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $site; ?>about.php">About Us</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $site; ?>solution.php">Solution</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $site; ?>It-services.php">IT services</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="<?php echo $site; ?>products.php" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>

          <ul class="dropdown-menu shadow-lg border-0 p-2 main-scroll-menu">
            <?php 
            // 1. Fetch all active categories from your database
            $cat_query = "SELECT * FROM `categories` WHERE `status` = 1 ORDER BY `categories` ASC";
            $cat_result = mysqli_query($conn, $cat_query);

            if ($cat_result && mysqli_num_rows($cat_result) > 0) {
                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                    $cate_id   = $cat_row['cate_id'];
                    $cat_name  = $cat_row['categories'];
                    $cat_slug  = $cat_row['slug_url'];

                    // 2. Fetch active products matching categories.cate_id = products.pro_cate
                    $pro_query = "SELECT * FROM `products` WHERE `pro_cate` = '$cate_id' AND `status` = 1 AND `is_disabled` = 0 ORDER BY `pro_name` ASC";
                    $pro_result = mysqli_query($conn, $pro_query);
                    $has_products = mysqli_num_rows($pro_result);

                    if ($has_products > 0) {
                        // Category with sub-menu items (Flyout Products List)
                        ?>
                        <li class="dropdown-submenu-left">
                          <a class="dropdown-item dropdown-toggle" href="<?php echo $site; ?>category/<?php echo $cat_slug; ?>">
                            <?php echo strtoupper($cat_name); ?>
                          </a>
                          <ul class="dropdown-menu child-left-menu shadow border-0">
                            <?php 
                            while ($pro_row = mysqli_fetch_assoc($pro_result)) {
                                $pro_name = $pro_row['pro_name'];
                                $pro_slug = $pro_row['slug_url'];
                                ?>
                                <li>
                                  <a class="dropdown-item" href="<?php echo $site; ?>product/<?php echo $pro_slug; ?>">
                                    <?php echo $pro_name; ?>
                                  </a>
                                </li>
                                <?php 
                            } 
                            ?>
                          </ul>
                        </li>
                        <?php
                    } else {
                        // Category without sub-menu items (Standalone fallback link)
                        ?>
                        <li>
                          <a class="dropdown-item" href="<?php echo $site; ?>category/<?php echo $cat_slug; ?>">
                            <?php echo strtoupper($cat_name); ?>
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
          <a class="nav-link" href="<?php echo $site; ?>contact.php">Contact</a>
        </li>

      </ul>

      <a href="<?php echo $site; ?>contact.php" class="btn btn-nav-cta ms-lg-3 mt-2 mt-lg-0">
        Get in Touch
      </a>

    </div>
  </div>
</nav>

<style>
/* =========================
   NAVBAR BASE
========================= */
#mainNavbar {
  background: #ffffff;
  box-shadow: 0 4px 20px rgba(0,0,0,0.05);
  padding: 10px 0;
  z-index: 999;
}

.main-logo {
  height: 75px;
  width: auto;
}

.navbar .nav-link {
  color: #0b2b5c;
  font-weight: 600;
  padding: 10px 16px !important;
  transition: 0.3s ease;
}

.navbar .nav-link:hover,
.navbar .nav-link.active {
  color: #0d6efd;
}

.btn-nav-cta {
  background: linear-gradient(135deg, #0d6efd, #0b5ed7);
  color: #fff;
  padding: 12px 24px;
  border-radius: 50px;
  font-weight: 600;
  text-decoration: none;
  transition: 0.3s ease;
}

/* =========================
   MAIN DROPDOWN WITH SCROLL
========================= */
.navbar .main-scroll-menu {
  border-radius: 18px;
  min-width: 300px;   
  max-height: 350px;  
  overflow-y: auto;   
  overflow-x: hidden; 
  padding: 10px;
  border: none;
}

/* Slim Custom Scrollbar */
.navbar .main-scroll-menu::-webkit-scrollbar {
  width: 6px;
}
.navbar .main-scroll-menu::-webkit-scrollbar-track {
  background: #f8fafc;
}
.navbar .main-scroll-menu::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 10px;
}

.navbar .dropdown-item {
  padding: 12px 18px;
  border-radius: 12px;
  font-weight: 500;
  color: #0f172a;
  transition: 0.3s ease;
  white-space: normal;
}

.navbar .dropdown-item:hover {
  background: #f1f5ff;
  color: #0d6efd;
}

/* =========================
   CHILD MENU FLYOUT (DESKTOP)
========================= */
@media (min-width: 992px) {
  .dropdown-submenu-left {
    position: relative;
  }

  .dropdown-submenu-left > .child-left-menu {
    position: fixed !important; 
    display: none;
    min-width: 280px;
    max-height: 400px;
    overflow-y: auto;
    border-radius: 16px;
    box-shadow: -10px 10px 30px rgba(0,0,0,0.15) !important;
    padding: 10px;
    z-index: 1050;
  }

  .dropdown-submenu-left > .dropdown-toggle::after {
    float: right;
    margin-top: 7px;
    transform: rotate(90deg);
  }
}

/* =========================
   MOBILE RESPONSIVE
========================= */
@media (max-width: 991px) {
  .main-logo {
    height: 60px;
  }
  .navbar-collapse {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    margin-top: 15px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    max-height: 75vh;
    overflow-y: auto;
  }
  .navbar .main-scroll-menu {
    max-height: none;
    overflow-y: visible;
    box-shadow: none !important;
  }
  .dropdown-submenu-left > .child-left-menu {
    position: static !important;
    display: block !important;
    margin-left: 15px;
    margin-top: 10px;
    box-shadow: none !important;
    background: #f8fafc;
  }
  .dropdown-submenu-left > .dropdown-toggle::after {
    transform: rotate(0deg);
  }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth >= 992) {
    const submenus = document.querySelectorAll('.dropdown-submenu-left');

    submenus.forEach(submenu => {
      const toggle = submenu.querySelector('.dropdown-toggle');
      const menu = submenu.querySelector('.child-left-menu');

      submenu.addEventListener('mouseenter', function () {
        menu.style.display = 'block';
        const rect = toggle.getBoundingClientRect();
        menu.style.top = rect.top + 'px';
        menu.style.left = (rect.left - menu.offsetWidth - 10) + 'px'; 
      });

      submenu.addEventListener('mouseleave', function () {
        menu.style.display = 'none';
      });
    });
  }
});
</script>