<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=yes"
    />
    <title>
      It services - SHB Technologies & Medical Systems | Innovation in Healthcare Tech
    </title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap"
      rel="stylesheet"
    />
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
        --card-shadow:
          0 1px 3px rgba(0, 0, 0, 0.04), 0 6px 24px rgba(0, 0, 0, 0.06);
        --card-shadow-hover:
          0 4px 12px rgba(0, 0, 0, 0.06), 0 20px 40px rgba(0, 0, 0, 0.12);
        --radius-sm: 12px;
        --radius-md: 18px;
        --radius-lg: 24px;
        --radius-xl: 30px;
        --transition-smooth: 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        --transition-bounce: 0.45s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      * {
        font-family:
          "Inter",
          system-ui,
          -apple-system,
          sans-serif;
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
          radial-gradient(
            ellipse at 15% 10%,
            rgba(30, 111, 159, 0.03) 0%,
            transparent 60%
          ),
          radial-gradient(
            ellipse at 85% 70%,
            rgba(33, 152, 151, 0.03) 0%,
            transparent 60%
          ),
          radial-gradient(
            ellipse at 50% 40%,
            rgba(11, 43, 92, 0.02) 0%,
            transparent 70%
          );
        background-size: 100% 100%;
      }

      .navbar {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow:
          0 1px 0 rgba(0, 0, 0, 0.04),
          0 8px 24px rgba(0, 0, 0, 0.04);
        padding: 0.8rem 0;
        transition: all var(--transition-smooth);
        border-bottom: 1px solid rgba(30, 111, 159, 0.07);
        z-index: 1030;
      }

      .navbar.scrolled {
        padding: 0.5rem 0;
        box-shadow:
          0 1px 0 rgba(0, 0, 0, 0.05),
          0 12px 30px rgba(0, 0, 0, 0.07);
        background: rgba(255, 255, 255, 0.95);
      }

      .navbar-brand {
        font-weight: 800;
        font-size: 1.55rem;
        letter-spacing: -0.4px;
        background: linear-gradient(
          140deg,
          #0b2b5c 0%,
          #1e6f9f 55%,
          #219897 100%
        );
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        line-height: 1.1;
        transition: var(--transition-smooth);
      }

      .navbar-brand small {
        background: none;
        color: var(--ocean);
        font-weight: 600;
        letter-spacing: 0.3px;
      }

      .nav-link {
        font-weight: 500;
        color: var(--gray-700) !important;
        padding: 0.55rem 1.1rem !important;
        border-radius: 30px;
        transition: all var(--transition-smooth);
        position: relative;
        font-size: 0.93rem;
        letter-spacing: 0.1px;
      }

      .nav-link:hover,
      .nav-link.active {
        color: var(--ocean) !important;
        background: rgba(30, 111, 159, 0.06);
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
      }

      .btn-nav-cta:hover {
        background: linear-gradient(135deg, #1a5f8a, #0e4d6e);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(30, 111, 159, 0.35);
        color: #fff;
      }

      .hero-section {
        position: relative;
        background: linear-gradient(
          165deg,
          #ffffff 0%,
          #f0f7fb 30%,
          #e8f2f8 70%,
          #ffffff 100%
        );
        padding: 6rem 0 5rem 0;
        overflow: hidden;
        border-bottom: 1px solid rgba(30, 111, 159, 0.06);
      }

      .hero-section::before {
        content: "";
        position: absolute;
        top: -200px;
        right: -250px;
        width: 700px;
        height: 700px;
        background: radial-gradient(
          circle,
          rgba(30, 111, 159, 0.06) 0%,
          transparent 70%
        );
        border-radius: 50%;
        pointer-events: none;
        animation: heroPulse 12s ease-in-out infinite;
      }

      .hero-section::after {
        content: "";
        position: absolute;
        bottom: -150px;
        left: -200px;
        width: 600px;
        height: 600px;
        background: radial-gradient(
          circle,
          rgba(33, 152, 151, 0.05) 0%,
          transparent 70%
        );
        border-radius: 50%;
        pointer-events: none;
        animation: heroPulse 15s ease-in-out infinite 3s;
      }

      @keyframes heroPulse {
        0%,
        100% {
          transform: scale(1);
          opacity: 0.7;
        }
        50% {
          transform: scale(1.18);
          opacity: 1;
        }
      }

      .hero-badge {
        background: linear-gradient(135deg, #e6f2fb, #dceef8);
        color: #0b5e7e;
        border-radius: 40px;
        padding: 0.4rem 1.2rem;
        font-size: 0.84rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 1.2rem;
        letter-spacing: 0.2px;
        border: 1px solid rgba(30, 111, 159, 0.12);
        animation: fadeInUp 0.7s ease-out;
      }

      .hero-title {
        font-weight: 900;
        font-size: 3.2rem;
        line-height: 1.15;
        background: linear-gradient(
          145deg,
          #061428 0%,
          #0b2b5c 30%,
          #1a5f8a 65%,
          #1e6f9f 100%
        );
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 1.3rem;
        letter-spacing: -0.6px;
        animation: fadeInUp 0.8s ease-out 0.1s both;
      }

      .hero-subtitle {
        animation: fadeInUp 0.8s ease-out 0.2s both;
      }

      .hero-buttons {
        animation: fadeInUp 0.8s ease-out 0.3s both;
      }

      .hero-contact-row {
        animation: fadeInUp 0.8s ease-out 0.35s both;
      }

      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(24px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .btn-primary-premium {
        background: linear-gradient(135deg, #1e6f9f 0%, #1a5f8a 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 44px;
        transition: all var(--transition-bounce);
        box-shadow: 0 6px 20px rgba(30, 111, 159, 0.22);
        color: #fff;
        letter-spacing: 0.2px;
        position: relative;
        overflow: hidden;
      }

      .btn-primary-premium::after {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(
          circle,
          rgba(255, 255, 255, 0.2) 0%,
          transparent 60%
        );
        opacity: 0;
        transition: opacity 0.5s;
      }

      .btn-primary-premium:hover::after {
        opacity: 1;
      }
      .btn-primary-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(30, 111, 159, 0.32);
        color: #fff;
      }

      .btn-outline-premium {
        border: 2px solid #1e6f9f;
        color: #1e6f9f;
        border-radius: 44px;
        padding: 0.7rem 1.8rem;
        font-weight: 600;
        transition: all var(--transition-bounce);
        background: transparent;
        letter-spacing: 0.2px;
      }

      .btn-outline-premium:hover {
        background: #1e6f9f;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 26px rgba(30, 111, 159, 0.2);
      }

      .hero-illustration-wrapper {
        position: relative;
        animation: floatSlow 7s ease-in-out infinite;
      }

      @keyframes floatSlow {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-16px);
        }
      }

      .hero-illustration-inner {
        background: #ffffff;
        border-radius: var(--radius-xl);
        padding: 0.6rem;
        box-shadow: var(--card-shadow-hover);
        border: 1px solid rgba(30, 111, 159, 0.08);
        position: relative;
        overflow: hidden;
      }

      .hero-illustration-inner::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: var(--radius-xl);
        padding: 2px;
        background: linear-gradient(
          135deg,
          rgba(30, 111, 159, 0.2),
          rgba(33, 152, 151, 0.2),
          rgba(30, 111, 159, 0.05)
        );
        -webkit-mask:
          linear-gradient(#fff 0 0) content-box,
          linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
      }

      .hero-illustration-inner img {
        border-radius: 20px;
        display: block;
        width: 100%;
        height: auto;
        max-height: 380px;
        object-fit: cover;
      }

      .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(30, 111, 159, 0.07);
        color: #1a5f8a;
        border-radius: 40px;
        padding: 0.4rem 1.3rem;
        font-weight: 600;
        font-size: 0.84rem;
        letter-spacing: 0.2px;
        border: 1px solid rgba(30, 111, 159, 0.1);
        margin-bottom: 0.8rem;
      }

      .section-heading {
        font-weight: 800;
        font-size: 2.4rem;
        color: var(--deep-navy);
        position: relative;
        display: inline-block;
        letter-spacing: -0.4px;
        margin-bottom: 0.5rem;
      }

      .section-heading::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3.5px;
        background: linear-gradient(90deg, #1e6f9f, #8fcbff);
        border-radius: 4px;
      }

      .section-heading.text-center::after {
        left: 50%;
        transform: translateX(-50%);
      }

      .service-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: var(--radius-lg);
        padding: 2rem 1.6rem;
        transition: all var(--transition-smooth);
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
        height: 100%;
        cursor: default;
      }

      .service-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #1e6f9f, #8fcbff);
        opacity: 0;
        transition: opacity var(--transition-smooth);
        border-radius: 0 0 4px 4px;
      }

      .service-card:hover::before {
        opacity: 1;
      }
      .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--card-shadow-hover);
        border-color: rgba(30, 111, 159, 0.12);
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

      .service-card:hover .service-icon-circle {
        background: linear-gradient(135deg, #1e6f9f, #1a5f8a);
        color: #fff;
        transform: scale(1.06);
        box-shadow: 0 8px 22px rgba(30, 111, 159, 0.28);
      }

      .stats-section {
        background: linear-gradient(180deg, #ffffff 0%, #f6fafd 100%);
        border-top: 1px solid rgba(30, 111, 159, 0.06);
        border-bottom: 1px solid rgba(30, 111, 159, 0.06);
      }

      .stat-card {
        text-align: center;
        padding: 1.8rem 1rem;
        border-radius: var(--radius-lg);
        background: #fff;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0, 0, 0, 0.04);
        transition: all var(--transition-smooth);
      }

      .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--card-shadow-hover);
      }
      .stat-number {
        font-weight: 900;
        font-size: 2.8rem;
        letter-spacing: -1px;
        background: linear-gradient(135deg, #0b2b5c, #1e6f9f);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        line-height: 1;
      }
      .stat-icon-dot {
        font-size: 2rem;
        color: #1e6f9f;
        margin-bottom: 0.3rem;
      }

      .why-us-image-wrapper {
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--card-shadow-hover);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
      }
      .why-us-image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
      }
      .check-list-item {
        display: flex;
        align-items: flex-start;
        gap: 0.7rem;
        margin-bottom: 0.9rem;
        color: var(--text-secondary);
        font-weight: 500;
      }
      .check-list-item i {
        color: #1e6f9f;
        font-size: 1.15rem;
        flex-shrink: 0;
        margin-top: 2px;
      }

      .contact-premium-card {
        background: #fff;
        border-radius: var(--radius-xl);
        padding: 2rem;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
        transition: all var(--transition-smooth);
      }
      .contact-premium-card:hover {
        box-shadow: var(--card-shadow-hover);
      }
      .contact-icon-bullet {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: rgba(30, 111, 159, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1e6f9f;
        flex-shrink: 0;
        font-size: 1.1rem;
      }

      .form-premium {
        background: #fff;
        border-radius: var(--radius-xl);
        padding: 2rem;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0, 0, 0, 0.05);
      }
      .form-premium .form-control {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 0.7rem 1rem;
        font-size: 0.93rem;
        transition: all var(--transition-smooth);
        background: #fafcfd;
        font-weight: 500;
      }
      .form-premium .form-control:focus {
        border-color: #1e6f9f;
        box-shadow: 0 0 0 4px rgba(30, 111, 159, 0.08);
        background: #fff;
      }
      .form-premium .form-label {
        font-weight: 600;
        font-size: 0.84rem;
        color: var(--gray-700);
        letter-spacing: 0.2px;
        margin-bottom: 0.3rem;
      }

      .map-premium-card {
        background: #fff;
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0, 0, 0, 0.05);
      }
      .map-visual {
        background: linear-gradient(
          160deg,
          #e8f2f8 0%,
          #d6e8f5 30%,
          #e0ecf5 100%
        );
        height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
      }
      .map-visual::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
          radial-gradient(
            circle at 35% 40%,
            rgba(30, 111, 159, 0.2) 0%,
            transparent 25%
          ),
          radial-gradient(
            circle at 60% 55%,
            rgba(33, 152, 151, 0.15) 0%,
            transparent 20%
          );
        pointer-events: none;
      }
      .map-dot-pulse {
        width: 18px;
        height: 18px;
        background: #e74c3c;
        border-radius: 50%;
        position: absolute;
        top: 44%;
        left: 38%;
        box-shadow: 0 0 0 8px rgba(231, 76, 60, 0.25);
        animation: mapPulse 2s ease-in-out infinite;
        z-index: 2;
      }
      @keyframes mapPulse {
        0%,
        100% {
          box-shadow: 0 0 0 8px rgba(231, 76, 60, 0.25);
        }
        50% {
          box-shadow: 0 0 0 22px rgba(231, 76, 60, 0.05);
        }
      }
      .map-grid-lines {
        position: absolute;
        inset: 0;
        background-image:
          linear-gradient(rgba(30, 111, 159, 0.06) 1px, transparent 1px),
          linear-gradient(90deg, rgba(30, 111, 159, 0.06) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
        z-index: 1;
      }

      .footer-premium {
        background: linear-gradient(180deg, #0b1f3d 0%, #061428 100%);
        color: #c4d9ef;
        position: relative;
        overflow: hidden;
      }
      .footer-premium::before {
        content: "";
        position: absolute;
        top: -100px;
        right: -150px;
        width: 500px;
        height: 500px;
        background: radial-gradient(
          circle,
          rgba(30, 111, 159, 0.12) 0%,
          transparent 70%
        );
        border-radius: 50%;
        pointer-events: none;
      }
      .footer-premium a {
        color: #b4cfe8;
        text-decoration: none;
        transition: all 0.25s;
      }
      .footer-premium a:hover {
        color: #fff;
      }
      .footer-social-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: all var(--transition-bounce);
        margin-right: 0.6rem;
        color: #c4d9ef;
        border: 1px solid rgba(255, 255, 255, 0.08);
      }
      .footer-social-icon:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        transform: translateY(-3px);
        border-color: rgba(255, 255, 255, 0.2);
      }

      .reveal-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition:
          opacity 0.7s ease-out,
          transform 0.7s ease-out;
      }
      .reveal-on-scroll.revealed {
        opacity: 1;
        transform: translateY(0);
      }

      /* Product Table Styles */
      .product-table {
        font-size: 0.9rem;
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--card-shadow);
        background: #fff;
      }
      .product-table thead {
        background: linear-gradient(135deg, #e8f4f9, #dceef8);
      }
      .product-table th {
        font-weight: 700;
        color: var(--deep-navy);
        border-bottom: 2px solid rgba(30, 111, 159, 0.2);
        padding: 1rem;
      }
      .product-table td {
        padding: 0.9rem 1rem;
        vertical-align: middle;
        border-color: rgba(0, 0, 0, 0.03);
      }
      .product-highlight {
        color: #1e6f9f;
        font-weight: 700;
      }
      .spec-badge {
        background: rgba(30, 111, 159, 0.05);
        color: #1a5f8a;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
      }

      @media (max-width: 992px) {
        .hero-title {
          font-size: 2.4rem;
        }
        .section-heading {
          font-size: 2rem;
        }
        .stat-number {
          font-size: 2.2rem;
        }
      }
      @media (max-width: 768px) {
        .hero-title {
          font-size: 1.9rem;
        }
        .hero-section {
          padding: 4rem 0 3rem 0;
        }
        .section-heading {
          font-size: 1.7rem;
        }
        .service-card {
          padding: 1.4rem;
        }
        .navbar-brand {
          font-size: 1.3rem;
        }
        .hero-illustration-wrapper {
          animation: none;
        }
        .hero-illustration-inner img {
          max-height: 240px;
        }
      }
      @media (max-width: 576px) {
        .hero-title {
          font-size: 1.6rem;
        }
        .hero-section {
          padding: 3rem 0 2rem 0;
        }
        .btn-primary-premium,
        .btn-outline-premium {
          padding: 0.6rem 1.4rem;
          font-size: 0.85rem;
        }
      }
    </style>
  </head>
  <body>
    
<?php include('header.php');?>

   

         <!-- Existing Why SHB Section End -->
</section>

<!-- Additional Company Information Section -->
<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">
                <span class="text-danger">SHB TECHNOLOGIES</span>
                IT Services
            </h2>
        </div>

        <!-- ========== NEW CONTENT START ========== -->
        <!-- Row 1: IT Development Services (First 6 items) -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-code-slash text-danger display-4"></i>
                    <h4 class="mt-3">Website Design</h4>
                    <p>White hot website design. Step up to a more professional, more attractive company image. Elevating brands, converting customers.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-laptop text-danger display-4"></i>
                    <h4 class="mt-3">Website Development</h4>
                    <p>Creative, intuitive and amazing user experience designed and developed, all at one place by cutting on development costs and outplay.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-phone text-danger display-4"></i>
                    <h4 class="mt-3">Mobile Development</h4>
                    <p>White hot website design. Step up to a more professional, more attractive company image. Elevating brands, converting customers.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-cart text-danger display-4"></i>
                    <h4 class="mt-3">Ecommerce Development</h4>
                    <p>High-conversion ecommerce solutions for small business & enterprise clients from an industry leading development firm.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-people text-danger display-4"></i>
                    <h4 class="mt-3">Custom CRM Solution</h4>
                    <p>We specialize in a thorough workflow review with a superb client to consultant relationship. Our CRM system has amazing and easy-to-use web-based interfaces and features.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-wordpress text-danger display-4"></i>
                    <h4 class="mt-3">Wordpress Development</h4>
                    <p>We specialize in designing custom Wordpress themes and plugins. WordPress is a fully customizable CMS and offers a unique platform that can be easily altered for any need.</p>
                </div>
            </div>
        </div>

        <!-- Row 2: Mamento (Magento), IOT, IT Consultancy, SEO, SMO, Dedicated Developer -->
        <div class="row g-4 mt-2">
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-shop text-danger display-4"></i>
                    <h4 class="mt-3">Magento Development</h4>
                    <p>Magento development services provides online merchants with the much-desired unprecedented flexibility & control over the content, functionality of their e-commerce store.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-cpu text-danger display-4"></i>
                    <h4 class="mt-3">IOT Development</h4>
                    <p>Choose IoT app development services from HikeRobo and save your time & money. Also, get state-of-art infrastructure and a team of dedicated IoT app developers working solely on your projects.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-briefcase text-danger display-4"></i>
                    <h4 class="mt-3">IT Consultancy Services</h4>
                    <p>We provides Consultancy for Internet marketing, software, web design/development to help you stay out of clutter. Our expertise in system analysis, system development and IT.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-graph-up text-danger display-4"></i>
                    <h4 class="mt-3">SEO</h4>
                    <p>White hot website design. Step up to a more professional, more attractive company image. Elevating brands, converting customers.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-chat-dots text-danger display-4"></i>
                    <h4 class="mt-3">SMO</h4>
                    <p>High-conversion ecommerce solutions for small business & enterprise clients from an industry leading development firm.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100 text-center">
                    <i class="bi bi-person-workspace text-danger display-4"></i>
                    <h4 class="mt-3">Dedicated Developer</h4>
                    <p>We help you with all the beneficial solutions developing a customized ecommerce website for your brand. This helps you to get more sales and thus you can feel confident.</p>
                </div>
            </div>
        </div>

        <!-- Row 3: IT Hardware, Maintenance and Support + Manpower Outsourcing + HR Consulting -->
        <div class="row g-4 mt-2">
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <i class="bi bi-hdd-stack-fill text-danger display-4"></i>
                    <h4 class="mt-3">IT Hardware, Maintenance and Support</h4>
                    <p>HikeAutomation a large and varied set of product sales and services including a full range of hardware solutions from entry level Desktops/Laptop to high-end Servers for the needs of Corporate, Small Business and Home customers.</p>
                    <p class="mt-2 mb-0">We provide custom and leading manufacturer Desktops, Servers, all network appliances, all Printers, and security software options, as well as all computer accessories.</p>
                    <p class="mt-2 mb-0 fw-semibold text-danger">"Focus on what you do best, we'll handle the rest" — Customized IT Support Solutions to fit your business.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <i class="bi bi-people-fill text-danger display-4"></i>
                    <h4 class="mt-3">Manpower Outsourcing and Staffing Solutions</h4>
                    <p>Our staffing agency takes pride in building long term relationships with our employers and job seekers in order to fully understand their needs and goals. As one of the premier staffing and recruiting firms in the country, we have distinguished ourselves as a personable and professional firm.</p>
                    <p>Our success is directly dependent on the success of our employers and job seekers so we strive to use our industry expertise to make the perfect match in staffing, recruiting and candidate placement.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <i class="bi bi-bar-chart-steps text-danger display-4"></i>
                    <h4 class="mt-3">HR Consulting & Planning</h4>
                    <p>HikeAutomation has expertise in a wide range of HR areas and is targeting the emerging company market. HikeRobo will offer this market the ability to compensate client's employees with stock options from their company. This will be especially appealing to many start-up companies that find capital scarce.</p>
                    <p class="mt-2 mb-0">Human Capital Maximizers will show increasing profitability over the next three years.</p>
                </div>
            </div>
        </div>

        <!-- Row 4: GPS Tracking and Navigation Systems + Why Choose HikeAutomation for Corporate Consultancy -->
        <div class="row g-4 mt-2">
            <div class="col-lg-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <i class="bi bi-satellite text-danger display-4"></i>
                    <h4 class="mt-3">GPS Tracking and Navigation Systems</h4>
                    <p>Our GPS tracking solutions are designed to make your life simpler ... stay connected with all the things you love! HikeVTS offers you highly sophisticated GPS tracking system that allows you keep track of all your assets anywhere in India, at any time.</p>
                    <p>We offer a diverse range of services and package deals that offer real time tracking for personal assets as well as business resources. Some of the services offered by HikeVTS includes vehicle tracking, fleet operations system, waste management system, fuel monitoring, temperature monitoring, sales force tracking, employee roster, senior citizen, child and pet tracking and car security.</p>
                    <p>Our vehicle tracking system offers a wide variety of transport management solutions from simple location tracking for vehicles such as car, bus, two-wheelers and ambulance to taxi dispatch system and tracking of public transport. Once our GPS tracking device is installed, you can access it on any tracking device. Our GPS tracking software has already been integrated for easy use in smart phones and supports multiple languages. Many external hardware devices such as RFID, UHF reader and camera can be incorporated into the system. You also receive alerts and notifications for all your assets without having to open the application all the time.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <i class="bi bi-building text-danger display-4"></i>
                    <h4 class="mt-3">Why Choose HikeAutomation for Corporate Consultancy Services</h4>
                    <p>Our professionals with great industry knowledge & years of expertise ensure that your business reaches unrivalled position & sets a new level of success and Get An Edge To Your Business by using our one stop solution for all of your IT Needs.</p>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Prior to starting the development process, our project managers will thoroughly discuss your goals & requirements to ensure that you get the precise solution what you paid for.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Our project solutions offer seamless integration with other codes and APIs.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> You'll get a dedicated account manager and team for real time maintenance & support during entire project execution.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> We develop user friendly, all browser and all devices compatible websites.</li>
                    </ul>
                    <p class="mt-3 fst-italic">"Get An Edge To Your Business by using our one stop solution for all of your IT Needs."</p>
                </div>
            </div>
        </div>

        <!-- (Optional small note: the previous electronic security system content removed as requested) -->
        <!-- ========== NEW CONTENT END ========== -->

    </div>
</section>

  <?php include('footer.php');?>

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
