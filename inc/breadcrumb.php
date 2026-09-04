<?php
$title = isset($pageTitle) ? $pageTitle : "SHB Technologies";
$parent = isset($parentPage) ? $parentPage : "Home";
$parentLink = isset($parentLink) ? $parentLink : $site . "index.php";
?>

<!-- =========================================
     PREMIUM DYNAMIC BREADCRUMB
========================================= -->
<div class="shb-breadcrumb-section">
    <!-- Decorative background glows -->
    <div class="shb-breadcrumb-glow-1"></div>
    <div class="shb-breadcrumb-glow-2"></div>
    <div class="shb-breadcrumb-grid"></div>

    <div class="container position-relative z-3">
        <div class="shb-breadcrumb-content">
            <!-- Dynamic Page Title -->
            <h1 class="shb-breadcrumb-title"><?php echo htmlspecialchars($title); ?></h1>
            
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb">
                <ol class="shb-breadcrumb-list">
                    <li class="shb-breadcrumb-item">
                        <a href="<?php echo htmlspecialchars($parentLink); ?>">
                            <i class="bi bi-house-door-fill me-1"></i> <?php echo htmlspecialchars($parent); ?>
                        </a>
                    </li>
                    <li class="shb-breadcrumb-item active" aria-current="page">
                        <?php echo htmlspecialchars($title); ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>