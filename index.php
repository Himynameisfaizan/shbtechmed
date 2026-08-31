<?php include('header.php'); ?>
<!-- HERO SLIDER SECTION -->

<!-- HERO SLIDER SECTION -->
<div id="medicalHeroSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false">

  <!-- Indicators -->
  <div class="carousel-indicators custom-indicators">
    <button type="button" data-bs-target="#medicalHeroSlider" data-bs-slide-to="0" class="active"
      aria-current="true"></button>
    <button type="button" data-bs-target="#medicalHeroSlider" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#medicalHeroSlider" data-bs-slide-to="2"></button>
    <button type="button" data-bs-target="#medicalHeroSlider" data-bs-slide-to="3"></button>
    <button type="button" data-bs-target="#medicalHeroSlider" data-bs-slide-to="4"></button>
  </div>

  <div class="carousel-inner h-100">

    <!-- Slide 1: MGPS -->
    <div class="carousel-item active h-100" data-bs-interval="5000">
      <div class="container-fluid h-100 p-0">
        <div class="row h-100 g-0 align-items-center">
          <!-- Text Section (Left) -->
          <div class="col-lg-5 slider-text-col">
            <div class="slider-content">
              <span class="badge-custom">Critical Life Support</span>
              <h1 class="slider-title">Medical Gas Pipeline Systems (MGPS)</h1>
              <p class="slider-desc">The lifeline of modern healthcare. Ensuring a continuous, safe, and flawless
                delivery of life-saving medical gases right to the patient's bedside without interruption.</p>
              <a href="products.php" class="btn btn-primary-custom">Explore System</a>
            </div>
          </div>
          <!-- Image Section (Right) -->
          <div class="col-lg-7 h-100 slider-image-col">
            <div class="slider-bg split-bg" style="background-image: url('assets/images/mgp/air-plant.png');"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 2: Modular OT -->
    <div class="carousel-item h-100" data-bs-interval="5000">
      <div class="container-fluid h-100 p-0">
        <div class="row h-100 g-0 align-items-center">
          <div class="col-lg-5 slider-text-col">
            <div class="slider-content">
              <span class="badge-custom">Advanced Surgical Environments</span>
              <h1 class="slider-title">Modular Operation Theaters</h1>
              <p class="slider-desc">Precision meets sterility. Designed to minimize infection risks, control airflow
                (Laminar), and provide surgeons with an integrated, highly efficient workspace.</p>
              <a href="products.php" class="btn btn-primary-custom">View OT Solutions</a>
            </div>
          </div>
          <div class="col-lg-7 h-100 slider-image-col">
            <div class="slider-bg split-bg" style="background-image: url('assets/images/ot/opration.png');"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 3: Cryogenic Pump -->
    <div class="carousel-item h-100" data-bs-interval="5000">
      <div class="container-fluid h-100 p-0">
        <div class="row h-100 g-0 align-items-center">
          <div class="col-lg-5 slider-text-col">
            <div class="slider-content">
              <span class="badge-custom">High-Pressure Engineering</span>
              <h1 class="slider-title">Cryogenic Pumps</h1>
              <p class="slider-desc">Engineered for the safe, leak-proof, and highly efficient transfer of liquefied
                medical gases. Built for extreme conditions and absolute reliability.</p>
              <a href="products.php" class="btn btn-primary-custom">Discover Technology</a>
            </div>
          </div>
          <div class="col-lg-7 h-100 slider-image-col">
            <div class="slider-bg split-bg" style="background-image: url('assets/images/cryoginic/cryoginic.png');">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 4: CCTV & Fire Alarm -->
    <div class="carousel-item h-100" data-bs-interval="5000">
      <div class="container-fluid h-100 p-0">
        <div class="row h-100 g-0 align-items-center">
          <div class="col-lg-5 slider-text-col">
            <div class="slider-content">
              <span class="badge-custom">24/7 Security & Monitoring</span>
              <h1 class="slider-title">CCTV & Fire Alarm Systems</h1>
              <p class="slider-desc">Uncompromised safety for patients and staff. Rapid response fire detection and
                high-definition surveillance tailored for complex hospital infrastructures.</p>
              <a href="products.php" class="btn btn-primary-custom">Ensure Safety</a>
            </div>
          </div>
          <div class="col-lg-7 h-100 slider-image-col">
            <div class="slider-bg split-bg" style="background-image: url('assets/images/cctv-fire/cctv.png');"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 5: Hospital Furniture -->
    <div class="carousel-item h-100" data-bs-interval="5000">
      <div class="container-fluid h-100 p-0">
        <div class="row h-100 g-0 align-items-center">
          <div class="col-lg-5 slider-text-col">
            <div class="slider-content">
              <span class="badge-custom">Ergonomics & Recovery</span>
              <h1 class="slider-title">Premium Hospital Furniture</h1>
              <p class="slider-desc">From automated ICU beds to modular pendants. Designed for maximum patient
                comfort, easy sterilization, and long-lasting durability.</p>
              <a href="products.php" class="btn btn-primary-custom">Browse Catalog</a>
            </div>
          </div>
          <div class="col-lg-7 h-100 slider-image-col">
            <div class="slider-bg split-bg" style="background-image: url('assets/images/furniture/furniture.png');">
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<section id="products" class="py-5 bg-white shb-premium-section">
  <div class="container py-5">

    <!-- Section Heading -->
    <div class="text-center mb-5 reveal-on-scroll">
      <span class="shb-subtitle">
        <span class="shb-dot"></span> Equipment Catalog
      </span>
      <h2 class="shb-main-heading mt-2 mb-3">
        Laboratory & Medical Equipment
      </h2>
      <p class="shb-sub-text col-lg-6 mx-auto">
        High-precision autoclaves, incubators, and environmental control
        cabinets designed for absolute reliability and performance.
      </p>
    </div>

    <!-- PRODUCT GRID -->
    <?php
    $product_query = mysqli_query($conn, "
        SELECT * FROM products 
        WHERE status = 1 
        AND is_disabled = 0 
        ORDER BY id DESC 
        LIMIT 6
      ");
    ?>

    <div class="row g-5">
      <?php while ($row = mysqli_fetch_assoc($product_query)) {
        // Product Image Fallback
        $product_image = !empty($row['pro_img'])
          ? $site . 'admin/assets/img/uploads/' . $row['pro_img']
          : 'images/no-image.png';

        // Product Link
        $product_link = $site . 'product/' . $row['slug_url'];
      ?>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="shb-pro-item">

            <div class="shb-pro-image-box">
              <img src="<?php echo $product_image; ?>" alt="<?php echo htmlspecialchars($row['pro_name']); ?>" class="img-fluid">

              <div class="shb-pro-overlay">
                <a href="<?php echo $product_link; ?>" class="shb-circular-btn">
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>

            <div class="shb-pro-info">
              <h3 class="shb-pro-title">
                <a href="<?php echo $product_link; ?>">
                  <?php echo htmlspecialchars($row['pro_name']); ?>
                </a>
              </h3>

              <p class="shb-pro-desc">
                <?php
                echo !empty($row['short_desc'])
                  ? substr(strip_tags($row['short_desc']), 0, 90) . '...'
                  : 'Engineered for critical care environments with advanced technology.';
                ?>
              </p>

              <a href="<?php echo $product_link; ?>" class="shb-text-link">
                Explore Details <span></span>
              </a>
            </div>

          </div>
        </div>

      <?php } ?>
    </div>

    <div class="row mt-5 pt-3">
      <div class="col-md-12 text-center">
        <a href="<?php echo $site; ?>products.php" class="shb-btn-primary">
          View Entire Catalog
        </a>
      </div>
    </div>

  </div>
</section>

<!-- =========================================
     PREMIUM STATS SECTION (DARK THEME)
========================================= -->
<section class="shb-stats-section py-5">
  <div class="container py-5">
    <div class="row g-4 text-center">

      <!-- Stat 1 -->
      <div class="col-6 col-md-3">
        <div class="shb-stat-box reveal-on-scroll">
          <div class="shb-stat-num">120<span class="shb-text-red">+</span></div>
          <p class="shb-stat-text">Hospitals Served</p>
        </div>
      </div>

      <!-- Stat 2 -->
      <div class="col-6 col-md-3">
        <div class="shb-stat-box reveal-on-scroll">
          <div class="shb-stat-num">350<span class="shb-text-red">+</span></div>
          <p class="shb-stat-text">Installations</p>
        </div>
      </div>

      <!-- Stat 3 -->
      <div class="col-6 col-md-3">
        <div class="shb-stat-box reveal-on-scroll">
          <div class="shb-stat-num">24<span class="shb-text-red">/</span>7</div>
          <p class="shb-stat-text">Field Support</p>
        </div>
      </div>

      <!-- Stat 4 -->
      <div class="col-6 col-md-3">
        <div class="shb-stat-box reveal-on-scroll">
          <div class="shb-stat-num">10<span class="shb-text-red">+</span></div>
          <p class="shb-stat-text">Years Experience</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================
     PREMIUM SERVICES / EXPERTISE SECTION
========================================= -->
<section id="services" class="shb-services-section py-5 bg-white">
  <div class="container py-5">

    <!-- Section Header (Matched with Products Section) -->
    <div class="text-center mb-5 reveal-on-scroll">
      <span class="shb-subtitle">
        <span class="shb-dot"></span> Our Expertise
      </span>
      <h2 class="shb-main-heading mt-2 mb-3">
        Advanced Medical Systems
      </h2>
      <p class="shb-sub-text col-lg-7 mx-auto">
        End-to-end solutions for modern healthcare infrastructure — from
        high-precision imaging to smart monitoring devices.
      </p>
    </div>

    <!-- Services Grid -->
    <div class="row g-5 mt-2">

      <!-- Service 1 -->
      <div class="col-md-6 col-lg-4 reveal-on-scroll">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-heart-pulse"></i>
          </div>
          <h4 class="shb-service-title">Diagnostic Imaging</h4>
          <p class="shb-service-desc">
            State-of-the-art ultrasound, X-ray, MRI support systems and PACS integration.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="col-md-6 col-lg-4 reveal-on-scroll">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-clipboard2-pulse"></i>
          </div>
          <h4 class="shb-service-title">Patient Monitoring</h4>
          <p class="shb-service-desc">
            ICU central stations, wireless telemetry, and remote patient tracking.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="col-md-6 col-lg-4 reveal-on-scroll">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-activity"></i> <!-- Changed icon to look more modern -->
          </div>
          <h4 class="shb-service-title">Surgical & Lab Tech</h4>
          <p class="shb-service-desc">
            Modular OT equipment, ventilators, lab analyzers and calibration services.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

      <!-- Service 4 -->
      <div class="col-md-6 col-lg-4 reveal-on-scroll">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-shield-check"></i> <!-- Changed icon -->
          </div>
          <h4 class="shb-service-title">Biomedical Engineering</h4>
          <p class="shb-service-desc">
            Installation, maintenance, and lifecycle management for clinical assets.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

      <!-- Service 5 -->
      <div class="col-md-6 col-lg-4 reveal-on-scroll">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-cloud-arrow-up"></i> <!-- Changed icon -->
          </div>
          <h4 class="shb-service-title">Health IT Integration</h4>
          <p class="shb-service-desc">
            Seamless EHR connectivity, medical device data systems (MDDS) and analytics.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

      <!-- Service 6 -->
      <div class="col-md-6 col-lg-4 reveal-on-scroll">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-headset"></i> <!-- Changed icon to headset for support -->
          </div>
          <h4 class="shb-service-title">24/7 Rapid Support</h4>
          <p class="shb-service-desc">
            Rapid response biomedical engineering support and remote troubleshooting.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- =========================================
     SECTION 1: HEALTHCARE IT INFORMATION
========================================= -->
<section class="shb-it-intro-section py-5">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <!-- Text Content (Left) -->
      <div class="col-lg-6 reveal-on-scroll">
        <span class="shb-subtitle">
          <span class="shb-dot"></span> Digital Transformation
        </span>
        <h2 class="shb-main-heading mt-2 mb-4">
          Next-Generation <br><span style="color: #cc0000;">Healthcare IT</span> Solutions
        </h2>
        <p class="shb-it-desc mb-4">
          In the modern medical landscape, reliable hardware is only half the equation. Our robust Healthcare IT infrastructure seamlessly connects your clinical workflows, ensuring data security, rapid patient care, and zero downtime.
        </p>

        <!-- Premium Feature List -->
        <ul class="shb-it-features mb-5">
          <li>
            <div class="shb-it-icon"><i class="bi bi-hdd-network"></i></div>
            <div>
              <strong>Hospital Information Systems (HIS)</strong>
              <span>End-to-end management of patient records and hospital administration.</span>
            </div>
          </li>
          <li>
            <div class="shb-it-icon"><i class="bi bi-shield-lock"></i></div>
            <div>
              <strong>Secure Cloud & PACS</strong>
              <span>Encrypted, lightning-fast storage and retrieval of medical imaging.</span>
            </div>
          </li>
          <li>
            <div class="shb-it-icon"><i class="bi bi-router"></i></div>
            <div>
              <strong>Critical Care Networking</strong>
              <span>24/7 un-interrupted network infrastructure for ICUs and Modular OTs.</span>
            </div>
          </li>
        </ul>

        <a href="<?php echo $site; ?>It-services.php" class="shb-btn-primary">
          Explore IT Services
        </a>
      </div>

      <!-- Tech Image/Graphic (Right) -->
      <div class="col-lg-6 reveal-on-scroll">
        <div class="shb-it-image-wrapper">
          <!-- Add a modern server/networking/dashboard image here -->
          <img src="assets/images/cctv-fire/cctv.png" alt="Healthcare IT Solutions" class="img-fluid shb-it-main-img">

          <!-- Floating Tech Element (Adds 3D Modern Look) -->
          <div class="shb-floating-tech-card">
            <div class="d-flex align-items-center gap-3">
              <div class="tech-pulse"></div>
              <div>
                <h6 class="mb-0 fw-bold">99.9% Uptime</h6>
                <small class="text-muted">Secure Infrastructure</small>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================
     SECTION 2: DYNAMIC IT PRODUCTS
========================================= -->
<section class="shb-it-products-section py-5 bg-white">
  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-end mb-5 reveal-on-scroll">
      <div>
        <h3 class="shb-sub-heading mb-0">Our Tech Portfolio</h3>
      </div>
      <div>
        <!-- Link to the specific IT Category page -->
        <a href="<?php echo $site; ?>category/it-services" class="shb-text-link">
          View All IT Products <span></span>
        </a>
      </div>
    </div>

    <!-- DYNAMIC PHP QUERY FOR IT PRODUCTS -->
    <?php
    $it_query = mysqli_query($conn, "
        SELECT p.* FROM products p 
        JOIN categories c ON p.pro_cate = c.cate_id 
        WHERE (c.categories LIKE '%IT%' OR c.categories LIKE '%Information Technology%')
        AND p.status = 1 
        AND p.is_disabled = 0 
        ORDER BY p.id DESC 
        LIMIT 3
      ");

    // Check if IT products exist
    if (mysqli_num_rows($it_query) > 0) {
    ?>
      <div class="row g-4">
        <?php while ($it_row = mysqli_fetch_assoc($it_query)) {
          $it_image = !empty($it_row['pro_img'])
            ? $site . 'admin/assets/img/uploads/' . $it_row['pro_img']
            : 'images/no-image.png';
          $it_link = $site . 'product/' . $it_row['slug_url'];
        ?>
          <!-- IT Product Card -->
          <div class="col-lg-4 col-md-6">
            <div class="shb-tech-card h-100">
              <div class="shb-tech-img-box">
                <img src="<?php echo $it_image; ?>" alt="<?php echo htmlspecialchars($it_row['pro_name']); ?>">
              </div>
              <div class="shb-tech-info">
                <h4 class="shb-tech-title">
                  <a href="<?php echo $it_link; ?>"><?php echo htmlspecialchars($it_row['pro_name']); ?></a>
                </h4>
                <p class="shb-tech-desc">
                  <?php
                  echo !empty($it_row['short_desc'])
                    ? substr(strip_tags($it_row['short_desc']), 0, 85) . '...'
                    : 'Advanced digital solutions tailored for healthcare facilities.';
                  ?>
                </p>
                <a href="<?php echo $it_link; ?>" class="shb-tech-btn">
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php
    } else {
      // Fallback if no IT products are added yet
      echo '<div class="alert alert-light text-center border">New IT Infrastructure Products Coming Soon.</div>';
    }
    ?>
  </div>
</section>

<!-- =========================================
     ABOUT / WHY SHB SECTION
========================================= -->
<section id="about" class="shb-about-section py-5 bg-white">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <!-- Premium Image Section -->
      <div class="col-lg-6 reveal-on-scroll">
        <div class="shb-about-image-wrapper">
          <div class="shb-image-backdrop"></div>
          <img src="assets/images/B.O.D. Incubators Digital.png" alt="SHB Technologies MGPS" class="img-fluid shb-main-image" />

          <!-- Floating Experience Badge -->
          <div class="shb-experience-badge">
            <span class="badge-number">10+</span>
            <span class="badge-text">Years of<br>Excellence</span>
          </div>
        </div>
      </div>

      <!-- Content Section -->
      <div class="col-lg-6 reveal-on-scroll">
        <span class="shb-subtitle">
          <span class="shb-dot"></span> Why Choose SHB
        </span>

        <h2 class="shb-main-heading mt-2 mb-4">
          Leading Experts in <span style="color: #cc0000;">Medical Gas</span> Pipeline Systems
        </h2>

        <p class="shb-about-desc">
          SHB Technologies is one of the leading manufacturers and suppliers of Medical Gas Pipeline Systems (MGPS). We understand that MGPS is a critical life-support infrastructure in healthcare facilities, where precision in design, installation, and maintenance is essential for patient safety and operational reliability.
        </p>

        <p class="shb-about-desc mb-4">
          With continuous innovation, advanced technical expertise, and a strong focus on quality standards, we deliver reliable and efficient medical gas solutions for hospitals, diagnostic centers, and healthcare institutions globally.
        </p>

        <!-- Modern Checklist -->
        <ul class="shb-custom-checklist">
          <li>
            <i class="fas fa-check"></i>
            <span>Specialized expertise in MGPS design & installation</span>
          </li>
          <li>
            <i class="fas fa-check"></i>
            <span>Advanced technology with continual innovation</span>
          </li>
          <li>
            <i class="fas fa-check"></i>
            <span>Trusted by healthcare institutions across India</span>
          </li>
          <li>
            <i class="fas fa-check"></i>
            <span>Strong presence in international healthcare markets</span>
          </li>
        </ul>
      </div>

    </div>
  </div>
</section>


<!-- =========================================
     CLIENTS & PORTFOLIO SECTION
========================================= -->
<section id="clients-portfolio" class="shb-portfolio-section py-5">
  <div class="container py-5">

    <!-- Section Header -->
    <div class="text-center mb-5 reveal-on-scroll">
      <span class="shb-subtitle justify-content-center">
        <span class="shb-dot"></span> Our Track Record
      </span>
      <h2 class="shb-main-heading mt-2 mb-3">
        Trusted <span style="color: #cc0000;">Clients</span> & Portfolio
      </h2>
      <p class="shb-sub-text col-lg-6 mx-auto">
        Trusted by industry leaders, healthcare institutions, government bodies, and enterprise sectors across India.
      </p>
    </div>

    <!-- Sleek Client Directory Grid -->
    <div class="row g-4 mb-5 pb-4">

      <?php
      // Array of clients to make HTML clean and manageable
      $clients = [
        ['icon' => 'bi-building', 'name' => 'Bajaj Auto Ltd Rodrapur', 'sector' => 'Manufacturing & Industrial'],
        ['icon' => 'bi-hospital', 'name' => 'Krishna Orthopedic Center', 'sector' => 'Healthcare'],
        ['icon' => 'bi-heart-pulse', 'name' => 'Sirohi Maternity Clinic', 'sector' => 'Healthcare'],
        ['icon' => 'bi-bank', 'name' => 'Moradabad Administration', 'sector' => 'Government'],
        ['icon' => 'bi-gear', 'name' => 'Quality Enviro Engineers', 'sector' => 'Engineering & Environment'],
        ['icon' => 'bi-truck', 'name' => 'CNH Industrial Ltd', 'sector' => 'Industrial Equipment'],
        ['icon' => 'bi-camera-video', 'name' => 'Dhampur City Surveillance', 'sector' => 'Municipal / Smart City'],
        ['icon' => 'bi-book', 'name' => 'HSB Inter College', 'sector' => 'Educational Institution'],
        ['icon' => 'bi-star', 'name' => 'Star Rameshwaram Rajnagar', 'sector' => 'Real Estate / Society'],
        ['icon' => 'bi-shop', 'name' => 'Lata Enterprises', 'sector' => 'Business Enterprise'],
        ['icon' => 'bi-ev-station', 'name' => 'Anmol Motors Pvt Ltd', 'sector' => 'Automotive'],
        ['icon' => 'bi-globe', 'name' => 'HM International', 'sector' => 'International Trade'],
        ['icon' => 'bi-shield-lock', 'name' => 'City Surveillance Moradabad', 'sector' => 'Security & Surveillance'],
        ['icon' => 'bi-diagram-3', 'name' => 'NIC Moradabad', 'sector' => 'Government IT'],
        ['icon' => 'bi-mortarboard', 'name' => 'R N Inter College', 'sector' => 'Education'],
        ['icon' => 'bi-people', 'name' => 'Bal Karagrah Moradabad', 'sector' => 'Social / NGO'],
        ['icon' => 'bi-house-heart', 'name' => 'Civitech Society Noida', 'sector' => 'Residential Society']
      ];

      foreach ($clients as $client) { ?>
        <div class="col-lg-4 col-md-6 reveal-on-scroll">
          <div class="shb-client-item">
            <div class="shb-client-icon">
              <i class="bi <?php echo $client['icon']; ?>"></i>
            </div>
            <div class="shb-client-info">
              <h5 class="shb-client-name"><?php echo $client['name']; ?></h5>
              <p class="shb-client-sector"><?php echo $client['sector']; ?></p>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>

    <!-- Minimalist Portfolio Stats Strip -->
    <div class="shb-portfolio-stats-strip reveal-on-scroll">
      <div class="row text-center g-0">
        <div class="col-md-4 shb-stat-divider">
          <h3 class="shb-strip-num">18+</h3>
          <p class="shb-strip-text">Trusted Clients</p>
        </div>
        <div class="col-md-4 shb-stat-divider">
          <h3 class="shb-strip-num">5+</h3>
          <p class="shb-strip-text">Government Projects</p>
        </div>
        <div class="col-md-4">
          <h3 class="shb-strip-num">10+</h3>
          <p class="shb-strip-text">Cities Covered</p>
        </div>
      </div>
    </div>

    <div class="text-center mt-4">
      <p class="text-muted small">
        <i class="fas fa-check-circle text-danger me-1"></i>
        From city surveillance to healthcare, education to industrial — our portfolio reflects excellence and reliability.
      </p>
    </div>

  </div>
</section>

<style>
  /* Additional smooth hover effect */
  .client-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.03);
  }

  .client-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.08) !important;
    border-color: rgba(220, 53, 69, 0.1);
  }

  .section-badge {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
    padding: 6px 16px;
    border-radius: 40px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-block;
  }
</style>

<section id="contact" class="py-5" style="background: #f8fafc">
  <div class="container py-3">
    <div class="text-center mb-5 reveal-on-scroll">
      <span class="section-badge"><i class="bi bi-chat-dots"></i> Get In Touch</span>
      <h2 class="section-heading text-center mb-3">Contact Our Team</h2>
      <p class="text-secondary mt-4 col-lg-7 mx-auto">
        Reach out for inquiries, support, or partnership opportunities.
      </p>
    </div>
    <div class="row g-5">
      <div class="col-lg-5 reveal-on-scroll">
        <div class="contact-premium-card">
          <div class="d-flex align-items-center gap-3 mb-4">
            <div class="contact-icon-bullet">
              <i class="bi bi-building"></i>
            </div>
            <div>
              <h5 class="mb-0 fw-bold">SHB Technologies</h5>
              <p class="text-secondary mb-0 small">
                & Medical Systems — Head Office
              </p>
            </div>
          </div>
          <div class="mb-3 d-flex gap-3">
            <div class="contact-icon-bullet">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
              <span class="fw-semibold small text-muted">Address</span>
              <p class="mb-0 fw-medium" style="font-size: 0.93rem">
                B-96, 1st Floor G.D. Colony,<br />Mayur Vihar Phase -3,<br />Delhi
                - 110096
              </p>
            </div>
          </div>
          <div class="mb-3 d-flex gap-3 align-items-center">
            <div class="contact-icon-bullet">
              <i class="bi bi-telephone-fill"></i>
            </div>
            <div>
              <span class="fw-semibold small text-muted">Mobile</span><br /><a href="tel:+918178037626"
                class="text-decoration-none text-dark fw-medium">+91 8178037626</a>
            </div>
          </div>
          <div class="mb-3 d-flex gap-3 align-items-center">
            <div class="contact-icon-bullet">
              <i class="bi bi-envelope-fill"></i>
            </div>
            <div>
              <span class="fw-semibold small text-muted">Email</span><br /><a href="mailto:technoshb@gmail.com"
                class="text-decoration-none text-dark fw-medium">technoshb@gmail.com</a>
            </div>
          </div>
          <hr />
          <div>
            <p class="mb-1 small">
              <i class="bi bi-clock-history me-2" style="color: #1e6f9f"></i><strong>Support hours:</strong> Mon–Sat
              9:00 AM – 7:00 PM
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-7 reveal-on-scroll">
        <div class="form-premium">
          <h5 class="mb-3 fw-bold">
            <i class="bi bi-send me-2" style="color: #1e6f9f"></i>Send a
            Quick Message
          </h5>
          <form action="#" method="post">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Full name</label><input type="text" class="form-control"
                  placeholder="Dr. / Ms. / Mr." />
              </div>
              <div class="col-md-6">
                <label class="form-label">Email address</label><input type="email" class="form-control"
                  placeholder="name@example.com" />
              </div>
              <div class="col-12">
                <label class="form-label">Phone number</label><input type="tel" class="form-control"
                  placeholder="+91" />
              </div>
              <div class="col-12">
                <label class="form-label">Message / Inquiry</label><textarea rows="4" class="form-control"
                  placeholder="Tell us about your requirement..."></textarea>
              </div>
              <div class="col-12">
                <button type="button" class="btn btn-primary-premium" onclick="
                        alert(
                          'Thank you for reaching out! SHB team will contact you soon. (demo)',
                        )
                      ">
                  <i class="bi bi-send me-2"></i>Send message
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="location" class="py-5 bg-white">
  <div class="container py-3">
    <div class="row g-5">
      <div class="col-lg-6 reveal-on-scroll">
        <h3 class="fw-bold" style="color: #0b2b5c">
          <i class="bi bi-geo-alt-fill me-2" style="color: #1e6f9f"></i>Our
          Headquarters
        </h3>
        <div class="p-4 mt-3 rounded-4" style="background: #f9fbfd; border: 1px solid #e9edf2">
          <p class="mb-2 fw-semibold">
            SHB Technologies and Medical Systems
          </p>
          <p class="mb-2 text-secondary">
            B-96, 1st Floor G.D. Colony,<br />Mayur Vihar Phase -3, Delhi<br /><strong>PIN:</strong>
            110096
          </p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="https://maps.google.com/?q=B-96+G.D.+Colony+Mayur+Vihar+Phase+3+Delhi" target="_blank"
              class="btn btn-sm btn-outline-premium"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 reveal-on-scroll">
        <div class="map-premium-card">
          <div class="map-visual">
            <div class="map-grid-lines"></div>
            <div class="map-dot-pulse"></div>
            <div class="text-center position-relative z-3">
              <i class="bi bi-geo-alt-fill fs-1 mb-2" style="color: #1e6f9f; opacity: 0.6"></i>
              <p class="mb-0 fw-semibold" style="color: #0b2b5c">
                📍 B-96, G.D. Colony, Mayur Vihar Phase-3
              </p>
              <small class="text-muted">Delhi - 110096</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const navbar = document.getElementById("mainNavbar");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 40) navbar.classList.add("scrolled");
    else navbar.classList.remove("scrolled");
  });
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
        setTimeout(
          () => {
            entry.target.classList.add("revealed");
          },
          Math.min(delay, 300),
        );
        observer.unobserve(entry.target);
      }
    });
  };
  const observer = new IntersectionObserver(
    revealCallback,
    observerOptions,
  );
  revealElements.forEach((el) => observer.observe(el));
  window.addEventListener("load", () => {
    revealElements.forEach((el) => {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0)
        el.classList.add("revealed");
    });
  });
  const sections = document.querySelectorAll("section[id]");
  const navLinks = document.querySelectorAll(".nav-link");
  window.addEventListener("scroll", () => {
    let current = "";
    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 120;
      if (window.scrollY >= sectionTop)
        current = section.getAttribute("id");
    });
    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + current)
        link.classList.add("active");
    });
  });
</script>
</body>

</html>