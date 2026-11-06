<?php
// Backend se contact details fetch karein (Agar header mein pehle se set nahi hai)
if (!isset($contactInfo) || empty($contactInfo)) {
    $contactQuery = mysqli_query($conn, "SELECT * FROM contacts LIMIT 1");
    $contactInfo = $contactQuery ? mysqli_fetch_assoc($contactQuery) : [];
}

// Variables set karein taaki easily HTML mein use ho sakein
$f_facebook  = !empty($contactInfo['facebook']) ? $contactInfo['facebook'] : '';
$f_twitter   = !empty($contactInfo['twitter']) ? $contactInfo['twitter'] : '';
$f_instagram = !empty($contactInfo['instagram']) ? $contactInfo['instagram'] : '';
$f_linkedin  = !empty($contactInfo['linkdin']) ? $contactInfo['linkdin'] : ''; // Note: Database mein spelling 'linkdin' hai
$f_email     = !empty($contactInfo['email']) ? $contactInfo['email'] : 'technoshb@gmail.com';
$f_phone1    = !empty($contactInfo['phone']) ? $contactInfo['phone'] : '';
$f_phone2    = !empty($contactInfo['telephone']) ? $contactInfo['telephone'] : '';
$f_address   = !empty($contactInfo['address']) ? $contactInfo['address'] : 'B-96, 1st Floor G.D. Colony, Mayur Vihar Phase-3, Delhi - 110096';
?>

<footer class="shb-premium-footer pt-5 pb-4">
  <!-- Subtle top accent line -->
  <div class="shb-footer-accent-line"></div>
  
  <div class="container position-relative z-2">
    <div class="row gy-5 mb-5">
      
      <!-- Column 1: Brand & About -->
      <div class="col-lg-4 col-md-6 pe-lg-5">
        <h4 class="shb-footer-brand mb-3">
          SHB <span class="shb-footer-highlight" style="color: #e30613;">Technologies</span>
        </h4>
        <p class="shb-footer-desc mb-4">
          Innovative medical technology solutions empowering healthcare providers with reliable, advanced systems. We engineer for life.
        </p>
        <div class="shb-footer-social">
          <?php if($f_linkedin): ?>
            <a href="<?= htmlspecialchars($f_linkedin); ?>" target="_blank" class="shb-social-link"><i class="bi bi-linkedin"></i></a>
          <?php endif; ?>
          <?php if($f_twitter): ?>
            <a href="<?= htmlspecialchars($f_twitter); ?>" target="_blank" class="shb-social-link"><i class="bi bi-twitter-x"></i></a>
          <?php endif; ?>
          <?php if($f_facebook): ?>
            <a href="<?= htmlspecialchars($f_facebook); ?>" target="_blank" class="shb-social-link"><i class="bi bi-facebook"></i></a>
          <?php endif; ?>
          <?php if($f_instagram): ?>
            <a href="<?= htmlspecialchars($f_instagram); ?>" target="_blank" class="shb-social-link"><i class="bi bi-instagram"></i></a>
          <?php endif; ?>
          <a href="mailto:<?= htmlspecialchars($f_email); ?>" class="shb-social-link"><i class="bi bi-envelope-fill"></i></a>
        </div>
      </div>

      <!-- Column 2: Quick Links -->
      <div class="col-lg-2 col-md-6">
        <h6 class="shb-footer-heading mb-4">Explore</h6>
        <ul class="shb-footer-links list-unstyled">
          <li><a href="<?php echo $site ?? ''; ?>">Home</a></li>
          <li><a href="<?php echo $site ?? ''; ?>about">About Us</a></li>
          <li><a href="<?php echo $site ?? ''; ?>solution">Our Solutions</a></li>
          <li><a href="<?php echo $site ?? ''; ?>products">Equipment Catalog</a></li>
          <li><a href="<?php echo $site ?? ''; ?>location">Service Locations</a></li>
          <li><a href="<?php echo $site ?? ''; ?>contact">Contact Support</a></li>
        </ul>
      </div>

      <!-- Column 3: Dynamic Expertise / Categories -->
      <div class="col-lg-2 col-md-6">
        <h6 class="shb-footer-heading mb-4">Expertise</h6>
        <ul class="shb-footer-links list-unstyled">
          <?php
          // Database se active categories fetch karein
          $footerCatQuery = mysqli_query($conn, "SELECT categories, slug_url FROM categories WHERE status = 1 ORDER BY id DESC LIMIT 5");
          if ($footerCatQuery && mysqli_num_rows($footerCatQuery) > 0) {
              while ($fCat = mysqli_fetch_assoc($footerCatQuery)) {
                  $catName = htmlspecialchars($fCat['categories']);
                  $catUrl = ($site ?? '') . 'category/' . urlencode(trim($fCat['slug_url']));
                  echo '<li><a href="' . $catUrl . '">' . $catName . '</a></li>';
              }
          } else {
              // Fallback agar koi category nahi milti
              echo '<li><a href="'.($site ?? '').'products">Medical Equipment</a></li>';
          }
          ?>
        </ul>
      </div>

      <!-- Column 4: Dynamic Contact Info -->
      <div class="col-lg-4 col-md-6">
        <h6 class="shb-footer-heading mb-4">Headquarters</h6>
        <div class="shb-footer-contact-item mb-3 d-flex gap-3">
          <div class="icon-box text-danger"><i class="bi bi-geo-alt-fill"></i></div>
          <div>
            <span><?= nl2br(htmlspecialchars($f_address)); ?></span>
          </div>
        </div>
        
        <?php if($f_phone1 || $f_phone2): ?>
        <div class="shb-footer-contact-item mb-3 d-flex gap-3">
          <div class="icon-box text-danger"><i class="bi bi-telephone-fill"></i></div>
          <div>
            <?php if($f_phone1): ?>
              <a href="tel:<?= preg_replace('/[^0-9+]/', '', $f_phone1); ?>" class="d-block mb-1 text-decoration-none text-light"><?= htmlspecialchars($f_phone1); ?></a>
            <?php endif; ?>
            <?php if($f_phone2): ?>
              <a href="tel:<?= preg_replace('/[^0-9+]/', '', $f_phone2); ?>" class="d-block text-decoration-none text-light"><?= htmlspecialchars($f_phone2); ?></a>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>

        <div class="shb-footer-contact-item d-flex gap-3">
          <div class="icon-box text-danger"><i class="bi bi-envelope-fill"></i></div>
          <div>
            <a href="mailto:<?= htmlspecialchars($f_email); ?>" class="text-decoration-none text-light"><?= htmlspecialchars($f_email); ?></a>
          </div>
        </div>
      </div>

    </div>

    <!-- Policy Links -->
    <div class="row">
        <div class="col-12">
            <div class="shb-footer-policy-links text-center border-top pt-4 pb-3" style="border-color: rgba(255,255,255,0.1) !important;">
                <a href="<?php echo $site ?? ''; ?>privacy-policy" class="text-decoration-none text-light opacity-75 mx-2 small hover-opacity-100">Privacy Policy</a> | 
                <a href="<?php echo $site ?? ''; ?>terms-condition" class="text-decoration-none text-light opacity-75 mx-2 small hover-opacity-100">Terms & Conditions</a> | 
                <a href="<?php echo $site ?? ''; ?>refund-policy" class="text-decoration-none text-light opacity-75 mx-2 small hover-opacity-100">Refund Policy</a> | 
                <a href="<?php echo $site ?? ''; ?>shipping-return" class="text-decoration-none text-light opacity-75 mx-2 small hover-opacity-100">Shipping Policy</a>
            </div>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div class="shb-footer-bottom pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <p class="mb-0 small text-light opacity-75">
            &copy; <?php echo date('Y'); ?> SHB Technologies & Medical Systems. All rights reserved.
          </p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <span class="shb-footer-tagline small text-light opacity-75">Design by  <a href="https://www.digitalwebtrackers.com/" target="_blank" style="color: #e30613; text-decoration: none; font-weight: 600;">Digital Web Trackers</a></span>
        </div>
      </div>
    </div>
    
  </div>
</footer>