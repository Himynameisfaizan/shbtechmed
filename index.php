<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('config/connect.php');

// 1. Handle Inquiry Form Submission (Saves to 'inquiries' table)
$inquiry_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_home_inquiry'])) {
    $inq_name    = mysqli_real_escape_string($conn, trim($_POST['name'] ?? ''));
    $inq_email   = mysqli_real_escape_string($conn, trim($_POST['email'] ?? ''));
    $inq_phone   = substr(preg_replace('/[^0-9]/', '', $_POST['phone'] ?? ''), -11);
    $inq_subject = mysqli_real_escape_string($conn, trim($_POST['subject'] ?? 'Home Page Inquiry'));
    $inq_message = mysqli_real_escape_string($conn, trim($_POST['message'] ?? ''));

    if ($inq_name !== '' && $inq_email !== '' && $inq_message !== '') {
        $insert_inq = "INSERT INTO `inquiries` (`name`, `email`, `phone`, `subject`, `message`, `status`) 
                       VALUES ('$inq_name', '$inq_email', '$inq_phone', '$inq_subject', '$inq_message', 0)";
        if (mysqli_query($conn, $insert_inq)) {
            $inquiry_msg = '<div class="alert alert-success mb-4">Thank you for reaching out! SHB team will contact you soon.</div>';
        } else {
            $inquiry_msg = '<div class="alert alert-danger mb-4">Something went wrong. Please try again.</div>';
        }
    }
}

// 2. Fetch Dynamic Contact & Location Details from 'contacts' table
$contact_query = mysqli_query($conn, "SELECT * FROM `contacts` ORDER BY `id` DESC LIMIT 1");
$contact_data  = ($contact_query && mysqli_num_rows($contact_query) > 0) ? mysqli_fetch_assoc($contact_query) : [];

$dyn_company = !empty($contact_data['name']) ? $contact_data['name'] : 'SHB Technologies and Medical Systems';
$dyn_address = !empty($contact_data['address']) ? $contact_data['address'] : 'B-96, 1st Floor G.D. Colony, Mayur Vihar Phase -3, Delhi - 110096';
$dyn_addr2   = !empty($contact_data['address2']) ? $contact_data['address2'] : '';
$dyn_phone1  = !empty($contact_data['phone']) ? $contact_data['phone'] : '+91-8178037626';
$dyn_phone2  = !empty($contact_data['telephone']) ? $contact_data['telephone'] : '';
$dyn_email   = !empty($contact_data['email']) ? $contact_data['email'] : (!empty($contact_data['contact_email']) ? $contact_data['contact_email'] : 'technoshb@gmail.com');
$dyn_hours   = !empty($contact_data['working_hours']) ? $contact_data['working_hours'] : 'Mon–Sat, 9:00 AM – 7:00 PM';

// Smart Dynamic Map Logic (Supports iframe, embed link, or auto-generates from dynamic address)
$raw_map = trim($contact_data['map'] ?? '');
$google_maps_link = 'https://maps.google.com/?q=' . urlencode($dyn_address);

if (!empty($raw_map)) {
    if (stripos($raw_map, '<iframe') !== false) {
        $dyn_map_iframe = $raw_map;
    } else {
        $dyn_map_iframe = '<iframe src="' . htmlspecialchars($raw_map) . '" width="100%" height="100%" style="border:0; min-height: 360px; border-radius: 16px;" allowfullscreen="" loading="lazy"></iframe>';
    }
} else {
    $dyn_map_iframe = '<iframe src="https://maps.google.com/maps?q=' . urlencode($dyn_address) . '&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0; min-height: 360px; border-radius: 16px;" allowfullscreen="" loading="lazy"></iframe>';
}

include('inc/header.php'); 
?>

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
          <div class="col-lg-5 slider-text-col">
            <div class="slider-content">
              <span class="badge-custom">Critical Life Support</span>
              <h1 class="slider-title">Medical Gas Pipeline Systems (MGPS)</h1>
              <p class="slider-desc">The lifeline of modern healthcare. Ensuring a continuous, safe, and flawless
                delivery of life-saving medical gases right to the patient's bedside without interruption.</p>
              <a href="<?php echo $site; ?>products" class="btn btn-primary-custom">Explore System</a>
            </div>
          </div>
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
              <a href="<?php echo $site; ?>products" class="btn btn-primary-custom">View OT Solutions</a>
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
              <a href="<?php echo $site; ?>products" class="btn btn-primary-custom">Discover Technology</a>
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
              <a href="<?php echo $site; ?>products" class="btn btn-primary-custom">Ensure Safety</a>
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
              <a href="<?php echo $site; ?>products" class="btn btn-primary-custom">Browse Catalog</a>
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

    <div class="text-center mb-5">
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
        $product_image = !empty($row['pro_img'])
          ? $site . 'admin/assets/img/uploads/' . $row['pro_img']
          : 'images/no-image.png';

        $product_link = $site . 'product/' . urlencode(trim($row['slug_url']));
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
        <a href="<?php echo $site; ?>products" class="shb-btn-primary">
          View Entire Catalog
        </a>
      </div>
    </div>

  </div>
</section>

<!-- PREMIUM STATS SECTION -->
<section class="shb-stats-section py-5">
  <div class="container py-5">
    <div class="row g-4 text-center">

      <div class="col-6 col-md-3">
        <div class="shb-stat-box">
          <div class="shb-stat-num">120<span class="shb-text-red">+</span></div>
          <p class="shb-stat-text">Hospitals Served</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="shb-stat-box">
          <div class="shb-stat-num">350<span class="shb-text-red">+</span></div>
          <p class="shb-stat-text">Installations</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="shb-stat-box">
          <div class="shb-stat-num">24<span class="shb-text-red">/</span>7</div>
          <p class="shb-stat-text">Field Support</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="shb-stat-box">
          <div class="shb-stat-num">10<span class="shb-text-red">+</span></div>
          <p class="shb-stat-text">Years Experience</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- PREMIUM SERVICES / EXPERTISE SECTION -->
<section id="services" class="shb-services-section py-5 bg-white">
  <div class="container py-5">

    <div class="text-center mb-5">
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

    <div class="row g-5 mt-2">

      <div class="col-md-6 col-lg-4">
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

      <div class="col-md-6 col-lg-4">
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

      <div class="col-md-6 col-lg-4">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-activity"></i>
          </div>
          <h4 class="shb-service-title">Surgical & Lab Tech</h4>
          <p class="shb-service-desc">
            Modular OT equipment, ventilators, lab analyzers and calibration services.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-shield-check"></i>
          </div>
          <h4 class="shb-service-title">Biomedical Engineering</h4>
          <p class="shb-service-desc">
            Installation, maintenance, and lifecycle management for clinical assets.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-cloud-arrow-up"></i>
          </div>
          <h4 class="shb-service-title">Health IT Integration</h4>
          <p class="shb-service-desc">
            Seamless EHR connectivity, medical device data systems (MDDS) and analytics.
          </p>
          <div class="shb-service-line"></div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="shb-service-card">
          <div class="shb-service-icon">
            <i class="bi bi-headset"></i>
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

<!-- SECTION 1: HEALTHCARE IT INFORMATION -->
<section class="shb-it-intro-section py-5">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <div class="col-lg-6">
        <span class="shb-subtitle">
          <span class="shb-dot"></span> Digital Transformation
        </span>
        <h2 class="shb-main-heading mt-2 mb-4">
          Next-Generation <br><span style="color: #cc0000;">Healthcare IT</span> Solutions
        </h2>
        <p class="shb-it-desc mb-4">
          In the modern medical landscape, reliable hardware is only half the equation. Our robust Healthcare IT infrastructure seamlessly connects your clinical workflows, ensuring data security, rapid patient care, and zero downtime.
        </p>

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

        <a href="<?php echo $site; ?>It-services" class="shb-btn-primary">
          Explore IT Services
        </a>
      </div>

      <div class="col-lg-6">
        <div class="shb-it-image-wrapper">
          <img src="assets/images/cctv-fire/cctv.png" alt="Healthcare IT Solutions" class="img-fluid shb-it-main-img">

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

<!-- SECTION 2: DYNAMIC IT PRODUCTS -->
<section class="shb-it-products-section py-5 bg-white">
  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-end mb-5">
      <div>
        <h3 class="shb-sub-heading mb-0">Our Tech Portfolio</h3>
      </div>
      <div>
        <a href="<?php echo $site; ?>category/it" class="shb-text-link">
          View All IT Products <span></span>
        </a>
      </div>
    </div>

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

    if ($it_query && mysqli_num_rows($it_query) > 0) {
    ?>
      <div class="row g-4">
        <?php while ($it_row = mysqli_fetch_assoc($it_query)) {
          $it_image = !empty($it_row['pro_img'])
            ? $site . 'admin/assets/img/uploads/' . $it_row['pro_img']
            : 'images/no-image.png';
          $it_link = $site . 'product/' . urlencode(trim($it_row['slug_url']));
        ?>
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
      echo '<div class="alert alert-light text-center border">New IT Infrastructure Products Coming Soon.</div>';
    }
    ?>
  </div>
</section>

<!-- ABOUT / WHY SHB SECTION -->
<section id="about" class="shb-about-section py-5 bg-white">
  <div class="container py-5">
    <div class="row align-items-center g-5">

      <div class="col-lg-6">
        <div class="shb-about-image-wrapper">
          <div class="shb-image-backdrop"></div>
          <img src="assets/images/mgp/air-plant.png" alt="SHB Technologies MGPS" class="img-fluid shb-main-image" />

          <div class="shb-experience-badge">
            <span class="badge-number">10+</span>
            <span class="badge-text">Years of<br>Excellence</span>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
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

<!-- CLIENTS & PORTFOLIO -->
<section id="clients-portfolio" class="shb-portfolio-slider-section py-5">
  <div class="container py-5">
    
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-5">
      <div class="shb-portfolio-header-text">
        <span class="shb-subtitle">
          <span class="shb-dot"></span> Our Track Record
        </span>
        <h2 class="shb-main-heading mt-2 mb-0">
          Trusted <span style="color: #cc0000;">Clients</span> & Portfolio
        </h2>
      </div>
      
      <div class="shb-slider-nav mt-3 mt-md-0">
        <button class="shb-nav-btn" id="shb-prev-btn"><i class="fas fa-chevron-left"></i></button>
        <button class="shb-nav-btn" id="shb-next-btn"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>

    <div class="shb-slider-container" id="shb-brand-slider">
      <div class="shb-slider-track">
        <?php
          $brand_query = mysqli_query($conn, "SELECT * FROM `brands` ORDER BY `id` DESC");
          if ($brand_query && mysqli_num_rows($brand_query) > 0) {
              while ($brand = mysqli_fetch_assoc($brand_query)) {
                  $brand_name = htmlspecialchars($brand['brand_name']);
                  $brand_image_path = !empty($brand['logo_path']) ? $site . 'admin/' . $brand['logo_path'] : '';
        ?>
                  <div class="shb-slide-item">
                    <div class="shb-brand-card">
                      <?php if (!empty($brand_image_path) && !empty($brand['logo_path'])) { ?>
                        <div class="shb-brand-logo-wrap">
                          <img src="<?php echo $brand_image_path; ?>" alt="<?php echo $brand_name; ?>" class="shb-brand-img">
                        </div>
                      <?php } else { ?>
                        <div class="shb-brand-icon shb-green-fallback">
                          <?php echo strtoupper(substr($brand_name, 0, 1)); ?>
                        </div>
                      <?php } ?>
                      
                      <h5 class="shb-brand-name" title="<?php echo $brand_name; ?>">
                        <?php echo strlen($brand_name) > 25 ? substr($brand_name, 0, 25) . '...' : $brand_name; ?>
                      </h5>
                      <div class="shb-brand-line"></div>
                    </div>
                  </div>
        <?php 
              }
          } else {
              echo '<div class="alert alert-light w-100 text-center">No portfolio brands found. Please add them from the admin panel.</div>';
          }
        ?>
      </div>
    </div>

    <div class="shb-portfolio-stats-strip mt-5">
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
    
  </div>
</section>

<!-- HOME PAGE - LATEST BLOGS SECTION -->
<section class="shb-home-blog-section py-5 bg-light">
    <div class="container py-5">
        
        <div class="row mb-5 align-items-end">
            <div class="col-lg-8 mb-4 mb-lg-0 text-center text-lg-start">
                <span class="shb-subtitle justify-content-center justify-content-lg-start">
                    <span class="shb-dot"></span> Knowledge Base
                </span>
                <h2 class="shb-main-heading mt-2 mb-0">
                    Latest <span style="color: #cc0000;">Insights</span> & News
                </h2>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <a href="<?php echo $site; ?>blog" class="btn btn-outline-dark px-4 py-2 fw-bold">
                    View All Articles <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $home_blog_query = mysqli_query($conn, "SELECT * FROM `blogs` WHERE `status` = 1 ORDER BY `blog_id` DESC LIMIT 3");

            if ($home_blog_query && mysqli_num_rows($home_blog_query) > 0) {
                while ($h_blog = mysqli_fetch_assoc($home_blog_query)) {
                    $h_blog_img = !empty($h_blog['image']) 
                        ? $site . 'admin/assets/img/uploads/blogs/' . htmlspecialchars($h_blog['image']) 
                        : $site . 'assets/images/no-image.png';

                    $h_blog_link = $site . 'blog/' . urlencode(trim($h_blog['slug']));
                    $h_blog_date = !empty($h_blog['created_at']) ? date("M j, Y", strtotime($h_blog['created_at'])) : date("M j, Y");
            ?>
            
            <div class="col-lg-4 col-md-6">
                <article class="shb-blog-card h-100 d-flex flex-column bg-white">
                    <div class="shb-blog-img-box" style="height: 220px;">
                        <a href="<?php echo $h_blog_link; ?>">
                            <img src="<?php echo $h_blog_img; ?>" alt="<?php echo htmlspecialchars($h_blog['title']); ?>" class="img-fluid w-100 h-100" style="object-fit: cover;">
                        </a>
                        <div class="shb-blog-date">
                            <i class="bi bi-calendar3 me-1"></i> <?php echo $h_blog_date; ?>
                        </div>
                    </div>

                    <div class="shb-blog-content flex-grow-1 d-flex flex-column p-4">
                        <div class="shb-blog-meta mb-2">
                            <span class="text-uppercase fw-bold letter-spacing-1" style="color: #cc0000; font-size: 0.8rem;">
                                <i class="bi bi-person me-1"></i> <?php echo htmlspecialchars($h_blog['author']); ?>
                            </span>
                        </div>
                        
                        <h4 class="shb-blog-title mb-3 fs-5 fw-bold">
                            <a href="<?php echo $h_blog_link; ?>" class="text-dark text-decoration-none hover-danger">
                                <?php echo htmlspecialchars($h_blog['title']); ?>
                            </a>
                        </h4>
                        
                        <p class="shb-blog-excerpt flex-grow-1 text-muted small mb-4">
                            <?php 
                            $desc_clean = strip_tags($h_blog['description']);
                            echo strlen($desc_clean) > 100 ? substr($desc_clean, 0, 100) . '...' : $desc_clean;
                            ?>
                        </p>
                        
                        <div class="mt-auto border-top pt-3">
                            <a href="<?php echo $h_blog_link; ?>" class="shb-minimal-link text-decoration-none fw-bold" style="color: #1a1a1a; font-size: 0.9rem;">
                                Read Article <i class="fas fa-arrow-right ms-1 text-danger"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <?php 
                }
            } else { 
            ?>
                <div class="col-12 text-center py-4">
                    <p class="text-muted">New insights coming soon.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- =========================================
     DYNAMIC CONTACT US SECTION (PREMIUM FORM)
========================================= -->
<section id="contact" class="shb-contact-section py-5">
  <div class="container py-5">
    
    <div class="text-center mb-5">
      <span class="shb-subtitle justify-content-center">
        <span class="shb-dot"></span> Get In Touch
      </span>
      <h2 class="shb-main-heading mt-2 mb-3">
        Contact Our <span style="color: #cc0000;">Team</span>
      </h2>
      <p class="shb-sub-text col-lg-6 mx-auto">
        Reach out for inquiries, technical support, or global partnership opportunities. Our experts are ready to assist you.
      </p>
    </div>

    <div class="row g-5 align-items-center">
      
      <!-- Dynamic Contact Information (Left) -->
      <div class="col-lg-5">
        <div class="shb-contact-info-wrapper">
          
          <div class="d-flex align-items-center gap-3 mb-5">
            <div class="shb-icon-square">
              <i class="bi bi-building"></i>
            </div>
            <div>
              <h4 class="mb-0 fw-bold" style="color: #1a1a1a;"><?php echo htmlspecialchars($dyn_company); ?></h4>
              <p class="text-muted mb-0 small text-uppercase letter-spacing-1">Medical Systems — Head Office</p>
            </div>
          </div>

          <!-- Dynamic Address -->
          <div class="shb-info-row">
            <div class="shb-icon-circle"><i class="bi bi-geo-alt-fill"></i></div>
            <div class="shb-info-content">
              <span class="shb-info-label">Corporate Address</span>
              <p class="shb-info-text mb-0">
                <?php echo nl2br(htmlspecialchars($dyn_address)); ?>
                <?php if (!empty($dyn_addr2)) { echo '<br>' . nl2br(htmlspecialchars($dyn_addr2)); } ?>
              </p>
            </div>
          </div>

          <!-- Dynamic Phone -->
          <div class="shb-info-row">
            <div class="shb-icon-circle"><i class="bi bi-telephone-fill"></i></div>
            <div class="shb-info-content">
              <span class="shb-info-label">Direct Line</span>
              <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $dyn_phone1); ?>" class="shb-info-link d-block">
                <?php echo htmlspecialchars($dyn_phone1); ?>
              </a>
              <?php if (!empty($dyn_phone2)): ?>
              <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $dyn_phone2); ?>" class="shb-info-link d-block mt-1">
                <?php echo htmlspecialchars($dyn_phone2); ?>
              </a>
              <?php endif; ?>
            </div>
          </div>

          <!-- Dynamic Email -->
          <div class="shb-info-row">
            <div class="shb-icon-circle"><i class="bi bi-envelope-fill"></i></div>
            <div class="shb-info-content">
              <span class="shb-info-label">Email Support</span>
              <a href="mailto:<?php echo htmlspecialchars($dyn_email); ?>" class="shb-info-link">
                <?php echo htmlspecialchars($dyn_email); ?>
              </a>
            </div>
          </div>

          <div class="shb-divider"></div>
          
          <!-- Dynamic Support Hours -->
          <div class="shb-support-hours">
            <i class="bi bi-clock-history"></i>
            <span><strong>Support Hours:</strong> <?php echo htmlspecialchars($dyn_hours); ?></span>
          </div>

        </div>
      </div>

      <!-- Dynamic Contact Form (Right) -->
      <div class="col-lg-7">
        <div class="shb-form-card">
          <h4 class="fw-bold mb-4" style="color: #1a1a1a;">Send a Quick Message</h4>
          <?php echo $inquiry_msg; ?>
          <form action="#contact" method="post">
            <div class="row g-4">
              <div class="col-md-6">
                <label class="shb-form-label">Full Name *</label>
                <input type="text" name="name" class="shb-input-premium" placeholder="Dr. / Ms. / Mr." required />
              </div>
              <div class="col-md-6">
                <label class="shb-form-label">Email Address *</label>
                <input type="email" name="email" class="shb-input-premium" placeholder="name@hospital.com" required />
              </div>
              <div class="col-md-6">
                <label class="shb-form-label">Phone Number *</label>
                <input type="tel" name="phone" class="shb-input-premium" placeholder="+91" required />
              </div>
              <div class="col-md-6">
                <label class="shb-form-label">Subject</label>
                <input type="text" name="subject" class="shb-input-premium" placeholder="Equipment / MGPS Inquiry" />
              </div>
              <div class="col-12">
                <label class="shb-form-label">Message / Inquiry *</label>
                <textarea rows="4" name="message" class="shb-input-premium" placeholder="Tell us about your requirement..." required></textarea>
              </div>
              <div class="col-12 pt-2">
                <button type="submit" name="submit_home_inquiry" class="shb-btn-primary w-100 py-3">
                  Send Message <i class="bi bi-arrow-right ms-2"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================
     DYNAMIC HEADQUARTERS / LOCATION & MAP SECTION
========================================= -->
<section id="location" class="shb-location-section py-5">
  <div class="container py-5">
    <div class="row g-5 align-items-center">
      
      <!-- Dynamic Text & Map Button (Left) -->
      <div class="col-lg-5">
        <span class="shb-subtitle">
          <span class="shb-dot"></span> Global Reach
        </span>
        <h3 class="shb-main-heading mt-2 mb-4" style="font-size: 2.2rem;">
          Our <span style="color: #cc0000;">Headquarters</span>
        </h3>
        
        <div class="shb-location-card mt-4">
          <h5 class="fw-bold mb-3" style="color: #1a1a1a;"><?php echo htmlspecialchars($dyn_company); ?></h5>
          <p class="text-secondary mb-4" style="font-size: 1.05rem; line-height: 1.6;">
            <?php echo nl2br(htmlspecialchars($dyn_address)); ?>
            <?php if (!empty($dyn_addr2)) { echo '<br>' . nl2br(htmlspecialchars($dyn_addr2)); } ?>
          </p>
          <a href="<?php echo htmlspecialchars($google_maps_link); ?>" target="_blank" class="shb-btn-outline">
            <i class="bi bi-map me-2"></i> Open in Google Maps
          </a>
        </div>
      </div>

      <!-- Dynamic Google Map Embed (Right) -->
      <div class="col-lg-7">
        <div class="shb-animated-map-wrapper shadow-sm rounded-4 overflow-hidden border" style="min-height: 360px;">
          <?php echo $dyn_map_iframe; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('inc/footer.php'); ?>

<!-- SHB Unified Javascript -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.getElementById("mainNavbar");
    if(navbar) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 40) navbar.classList.add("scrolled");
            else navbar.classList.remove("scrolled");
        });
    }

    const sliderContainer = document.getElementById('shb-brand-slider');
    const nextBtn = document.getElementById('shb-next-btn');
    const prevBtn = document.getElementById('shb-prev-btn');
    
    if(sliderContainer && nextBtn && prevBtn) {
        function getScrollAmount() {
            const item = sliderContainer.querySelector('.shb-slide-item');
            return item ? item.offsetWidth + 24 : 300; 
        }
        nextBtn.addEventListener('click', () => {
            sliderContainer.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
        });
        prevBtn.addEventListener('click', () => {
            sliderContainer.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
        });
        
        let autoPlayInterval = setInterval(() => {
            if (sliderContainer.scrollLeft + sliderContainer.clientWidth >= sliderContainer.scrollWidth - 10) {
                sliderContainer.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                sliderContainer.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
            }
        }, 3500);

        sliderContainer.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
        sliderContainer.addEventListener('mouseleave', () => {
            autoPlayInterval = setInterval(() => {
                if (sliderContainer.scrollLeft + sliderContainer.clientWidth >= sliderContainer.scrollWidth - 10) {
                    sliderContainer.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    sliderContainer.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
                }
            }, 3500);
        });
    }
  });
</script>