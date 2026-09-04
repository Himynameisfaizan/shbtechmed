  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=yes"
    />
    <title>
      SHB Technologies & Medical Systems | Innovation in Healthcare Tech
    </title>
  </head>
  <body>
    
<?php 
$pageTitle = "Contact Us";
include('inc/header.php');
include ('inc/breadcrumb.php');
?>
   
<!-- =========================================
     CONTACT US SECTION (PREMIUM THEME)
========================================= -->
<section id="contact" class="shb-contact-section py-5">
    <div class="container py-5">
        
        <!-- Section Header -->
        <div class="text-center mb-5 pb-3">
            <span class="shb-subtitle justify-content-center">
                <span class="shb-dot"></span> Get In Touch
            </span>
            <h2 class="shb-main-heading mt-2 mb-3">
                Contact Our <span style="color: #cc0000;">Team</span>
            </h2>
            <p class="shb-sub-text col-lg-6 mx-auto">
                Reach out for inquiries, technical support, or global partnership opportunities. Our engineering and support experts are ready to assist you.
            </p>
        </div>

        <div class="row g-5 align-items-stretch">
            
            <!-- Contact Information (Left Column) -->
            <div class="col-lg-5">
                <div class="shb-contact-info-wrapper h-100">
                    
                    <!-- Main Company Heading -->
                    <div class="d-flex align-items-center gap-3 mb-5">
                        <div class="shb-icon-square">
                            <i class="bi bi-buildings"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold" style="color: #1a1a1a;">SHB Technologies</h4>
                            <p class="text-muted mb-0 small text-uppercase letter-spacing-1 fw-bold">Medical Systems — Head Office</p>
                        </div>
                    </div>

                    <!-- Info Rows -->
                    <div class="shb-info-row">
                        <div class="shb-icon-circle"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="shb-info-content">
                            <span class="shb-info-label">Corporate Address</span>
                            <p class="shb-info-text">
                                B-96, 1st Floor G.D. Colony,<br />
                                Mayur Vihar Phase-3,<br />
                                Delhi - 110096
                            </p>
                        </div>
                    </div>

                    <div class="shb-info-row">
                        <div class="shb-icon-circle"><i class="bi bi-telephone-fill"></i></div>
                        <div class="shb-info-content">
                            <span class="shb-info-label">Direct Line</span>
                            <a href="tel:+918178037626" class="shb-info-link">+91 8178037626</a>
                        </div>
                    </div>

                    <div class="shb-info-row mb-0">
                        <div class="shb-icon-circle"><i class="bi bi-envelope-fill"></i></div>
                        <div class="shb-info-content">
                            <span class="shb-info-label">Email Support</span>
                            <a href="mailto:technoshb@gmail.com" class="shb-info-link">technoshb@gmail.com</a>
                        </div>
                    </div>

                    <div class="shb-divider"></div>
                    
                    <div class="shb-support-hours">
                        <i class="bi bi-clock-history"></i>
                        <span><strong>Support Hours:</strong> Mon–Sat, 9:00 AM – 7:00 PM</span>
                    </div>

                </div>
            </div>

            <!-- Contact Form (Right Column) -->
            <div class="col-lg-7">
                <div class="shb-form-card h-100">
                    <h4 class="fw-bold mb-4" style="color: #1a1a1a; letter-spacing: -0.5px;">
                        Send a Quick Message
                    </h4>
                    
                    <form action="#" method="post">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="shb-form-label">Full Name *</label>
                                <input type="text" class="shb-input-premium" placeholder="Dr. / Ms. / Mr." required />
                            </div>
                            <div class="col-md-6">
                                <label class="shb-form-label">Email Address *</label>
                                <input type="email" class="shb-input-premium" placeholder="name@hospital.com" required />
                            </div>
                            <div class="col-12">
                                <label class="shb-form-label">Phone Number *</label>
                                <input type="tel" class="shb-input-premium" placeholder="+91" required />
                            </div>
                            <div class="col-12">
                                <label class="shb-form-label">Message / Inquiry *</label>
                                <textarea rows="5" class="shb-input-premium" placeholder="Tell us about your requirement or project..." required></textarea>
                            </div>
                            <div class="col-12 pt-2">
                                <button type="button" class="shb-btn-primary w-100 py-3" onclick="alert('Thank you for reaching out! The SHB team will contact you shortly.')">
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

  <?php include('inc/footer.php');?>

  </body>
</html>
