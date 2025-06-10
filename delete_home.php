<?php
// Liên kết CSDL
$link = mysqli_connect("localhost", "root", "", "databooking");
if (!$link) {
    die("Không thể kết nối đến máy chủ: " . mysqli_connect_error());
}

// Kiểm tra id home có tồn tại
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; 

    // Lấy thông tin ảnh trước khi xóa
    $get_image_sql = "
        SELECT h.image
        FROM home_admin ha
        INNER JOIN homes r ON ha.home_id = r.home_id
        INNER JOIN homestay h ON r.homestay_id = h.homestay_id
        WHERE ha.home_admin_id = $id
    ";

    $image_result = mysqli_query($link, $get_image_sql);
    if ($image_result) {
        $image_data = mysqli_fetch_assoc($image_result);
        $image_path = "uploads/" . $image_data['image'];  // Đường dẫn ảnh

        // Nếu tồn tại ảnh và file tồn tại, xóa ảnh
        if (file_exists($image_path) && !empty($image_data['image'])) {
            unlink($image_path);  // Xóa ảnh
        }
    }

    // Bắt đầu giao dịch để đảm bảo tính toàn vẹn dữ liệu
    mysqli_begin_transaction($link);

    try {
        // Xóa dữ liệu trong bảng homes trước
        $delete_home_sql = "
            DELETE FROM homes 
            WHERE home_id = (SELECT home_id FROM home_admin WHERE home_admin_id = $id)
        ";
        if (!mysqli_query($link, $delete_home_sql)) {
            throw new Exception("Lỗi khi xóa dữ liệu trong bảng homes: " . mysqli_error($link));
        }

        // Xóa dữ liệu trong bảng home_admin
        $delete_sql = "DELETE FROM home_admin WHERE home_admin_id = $id";
        if (!mysqli_query($link, $delete_sql)) {
            throw new Exception("Lỗi khi xóa dữ liệu trong bảng home_admin: " . mysqli_error($link));
        }

        // Kiểm tra xem có còn phòng nào trong homestay không
        $check_homestay_sql = "
            SELECT homestay_id FROM homes 
            WHERE homestay_id = (SELECT homestay_id FROM homes WHERE home_id = (SELECT home_id FROM home_admin WHERE home_admin_id = $id))
        ";
        $homestay_result = mysqli_query($link, $check_homestay_sql);
        if (mysqli_num_rows($homestay_result) === 0) {
            // Nếu không còn phòng nào trong homestay, xóa homestay
            $delete_homestay_sql = "
                DELETE FROM homestay 
                WHERE homestay_id = (SELECT homestay_id FROM homes WHERE home_id = (SELECT home_id FROM home_admin WHERE home_admin_id = $id))
            ";
            if (!mysqli_query($link, $delete_homestay_sql)) {
                throw new Exception("Lỗi khi xóa dữ liệu trong bảng homestay: " . mysqli_error($link));
            }
        }

        // Commit giao dịch nếu không có lỗi
        mysqli_commit($link);
        header("Location: admin_dashboard.php"); // Chuyển trang
        exit;
    } catch (Exception $e) {
        // Rollback nếu có lỗi
        mysqli_rollback($link);
        echo "Lỗi: " . $e->getMessage();
    }
} else {
    echo "Không tìm thấy id phòng";
}

mysqli_close($link);
?>
