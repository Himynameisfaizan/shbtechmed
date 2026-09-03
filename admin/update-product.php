<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db-conn.php";

// FIX: Form POST method aur Product ID check karo (Button name fail ho sakta hai)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pro_id'])) {
    
    // Get all form data
    $pro_id         = intval($_POST['pro_id']);
    $pro_name       = mysqli_real_escape_string($conn, $_POST['pro_name']);
    $brand_name     = mysqli_real_escape_string($conn, $_POST['brand_name'] ?? '');
    $pro_cate       = intval($_POST['pro_cate']);
    $pro_sub_cate   = intval($_POST['pro_sub_cate'] ?? 0);
    $short_desc     = mysqli_real_escape_string($conn, $_POST['short_desc']);
    $description    = mysqli_real_escape_string($conn, $_POST['pro_desc']);
    $new_arrival    = intval($_POST['new_arrival']);
    $trending       = intval($_POST['trending'] ?? 0);
    $qty            = intval($_POST['qty'] ?? 0);
    $whole_sale_price = mysqli_real_escape_string($conn, $_POST['whole_sale_selling_price'] ?? '');
    $mrp            = floatval($_POST['mrp']);
    $selling_price  = floatval($_POST['selling_price']);
    $stock          = intval($_POST['stock']);
    $status         = intval($_POST['status']);
    $meta_title     = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_desc      = mysqli_real_escape_string($conn, $_POST['meta_desc']);
    $meta_key       = mysqli_real_escape_string($conn, $_POST['meta_key']);
    $added_on       = date('Y-m-d H:i:s');
    
    // Generate slug URL
    $slug_url = strtolower(str_replace(" ", "-", $pro_name));

    // ==========================================
    // IMAGE UPLOAD LOGIC
    // ==========================================
    
    $target_dir = "assets/img/uploads/";

    // Create directory if not exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $img_updated = false; // Flag to track if image was updated

    // Check if new image is uploaded
    if (isset($_FILES['pro_img']) && $_FILES['pro_img']['error'] === UPLOAD_ERR_OK && !empty($_FILES['pro_img']['name'])) {
        
        $filename = $_FILES['pro_img']['name'];
        $tempname = $_FILES['pro_img']['tmp_name'];
        
        $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        
        if (in_array($file_extension, $allowed_extensions)) {
            $uniqueFilename = time() . "_" . rand(1000, 9999) . "." . $file_extension;
            $target_file = $target_dir . $uniqueFilename;

            if (move_uploaded_file($tempname, $target_file)) {
                $pro_img = $uniqueFilename; 
                $img_updated = true;
                
                // Delete old image if exists
                $old_img_query = "SELECT pro_img FROM products WHERE pro_id = '$pro_id'";
                $old_result = mysqli_query($conn, $old_img_query);
                if ($old_result && mysqli_num_rows($old_result) > 0) {
                    $old_data = mysqli_fetch_assoc($old_result);
                    $old_image = $old_data['pro_img'];
                    if (!empty($old_image)) {
                        $old_image_path = $target_dir . $old_image;
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path);
                        }
                    }
                }
            } else {
                echo "<script>alert('Failed to upload image.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, GIF, WEBP allowed.');</script>";
        }
    }

    // ==========================================
    // BUILD UPDATE QUERY
    // ==========================================
    
    if ($img_updated) {
        $query = "UPDATE `products` SET 
            `pro_name` = '$pro_name',
            `brand_name` = '$brand_name',
            `pro_cate` = '$pro_cate',
            `pro_sub_cate` = '$pro_sub_cate',
            `short_desc` = '$short_desc',
            `description` = '$description',
            `new_arrival` = '$new_arrival',
            `trending` = '$trending',
            `qty` = '$qty',
            `mrp` = '$mrp',
            `selling_price` = '$selling_price',
            `whole_sale_selling_price` = '$whole_sale_price',
            `stock` = '$stock',
            `pro_img` = '$pro_img',
            `status` = '$status',
            `slug_url` = '$slug_url',
            `meta_title` = '$meta_title',
            `meta_desc` = '$meta_desc',
            `meta_key` = '$meta_key',
            `added_on` = '$added_on'
            WHERE `pro_id` = '$pro_id'";
    } else {
        $query = "UPDATE `products` SET 
            `pro_name` = '$pro_name',
            `brand_name` = '$brand_name',
            `pro_cate` = '$pro_cate',
            `pro_sub_cate` = '$pro_sub_cate',
            `short_desc` = '$short_desc',
            `description` = '$description',
            `new_arrival` = '$new_arrival',
            `trending` = '$trending',
            `qty` = '$qty',
            `mrp` = '$mrp',
            `selling_price` = '$selling_price',
            `whole_sale_selling_price` = '$whole_sale_price',
            `stock` = '$stock',
            `status` = '$status',
            `slug_url` = '$slug_url',
            `meta_title` = '$meta_title',
            `meta_desc` = '$meta_desc',
            `meta_key` = '$meta_key',
            `added_on` = '$added_on'
            WHERE `pro_id` = '$pro_id'";
    }

    // ==========================================
    // EXECUTE QUERY
    // ==========================================
    
    if (mysqli_query($conn, $query)) {
        echo "<script type='text/javascript'>
                alert('Product successfully updated!');
                window.location.href = 'show-products.php';
              </script>";
        exit;
    } else {
        echo "<div style='padding: 20px; font-family: sans-serif;'>";
        echo "<h3 style='color: red;'>Error updating product!</h3>";
        echo "<p>" . mysqli_error($conn) . "</p>";
        echo "<p><strong>Query:</strong> " . $query . "</p>";
        echo "<a href='show-products.php'>Go Back</a>";
        echo "</div>";
    }

    mysqli_close($conn);

} else {
    // Agar koi is page ko directly URL daal kar open kare, toh waapas bhej do
    echo "<script>
            alert('Invalid Request! Direct access not allowed.');
            window.location.href = 'show-products.php';
          </script>";
    exit;
}
?>