<?php
// Kết nối đến cơ sở dữ liệu
$link = mysqli_connect("localhost", "root", "", "databooking");

if (!$link) {
    die("Không thể kết nối đến máy chủ: " . mysqli_connect_error());
}

// Kiểm tra nếu ID phòng được cung cấp
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Lấy dữ liệu từ cơ sở dữ liệu
    $sql = "
        SELECT 
            ra.home_admin_id, 
            r.home_type, 
            r.capacity, 
            r.price, 
            r.home_image, 
            r.home_description, 
            l.location_image, 
            h.homestay_name, 
            h.description AS homestay_description, 
            h.image AS homestay_image, 
            r.home_status, 
            h.status, 
            l.city 
        FROM 
            home_admin ra
        INNER JOIN homes r ON ra.home_id = r.home_id
        INNER JOIN homestay h ON r.homestay_id = h.homestay_id
        INNER JOIN locations l ON h.location_id = l.location_id
        WHERE ra.home_admin_id = $id
    ";

    $result = mysqli_query($link, $sql);

    if (!$result || mysqli_num_rows($result) === 0) {
        die("Dữ liệu không tồn tại hoặc truy vấn thất bại: " . mysqli_error($link));
    }

    $room = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form
        $home_type = mysqli_real_escape_string($link, $_POST['home_type'] ?? '');
        $homestay_name = mysqli_real_escape_string($link, $_POST['homestay_name'] ?? '');
        $capacity = (int)($_POST['capacity'] ?? 0);
        $price = (float)($_POST['price'] ?? 0);
        $description = mysqli_real_escape_string($link, $_POST['description'] ?? '');
        $home_description = mysqli_real_escape_string($link, $_POST['home_description'] ?? '');
        $status = mysqli_real_escape_string($link, $_POST['status'] ?? '');
        $home_status = mysqli_real_escape_string($link, $_POST['home_status'] ?? '');

        $uploaded_homestay_image = $room['homestay_image'];
        $uploaded_home_image = $room['home_image'];
        $uploaded_location_image = $room['location_image'];

        // Xử lý ảnh homestay
        if (isset($_FILES['homestay_image']) && $_FILES['homestay_image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["homestay_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["homestay_image"]["tmp_name"], $target_file)) {
                    $uploaded_homestay_image = $target_file;
                }
            }
        }

        // Xử lý ảnh home
        if (isset($_FILES['home_image']) && $_FILES['home_image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["home_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["home_image"]["tmp_name"], $target_file)) {
                    $uploaded_home_image = $target_file;
                }
            }
        }

        // Xử lý ảnh location
        if (isset($_FILES['location_image']) && $_FILES['location_image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["location_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["location_image"]["tmp_name"], $target_file)) {
                    $uploaded_location_image = $target_file;
                }
            }
        }

        // Cập nhật cơ sở dữ liệu
        $update_homestay_sql = "
            UPDATE homestay 
            SET 
                homestay_name = '$homestay_name',
                description = '$description',
                image = '$uploaded_homestay_image',
                status = '$status'
            WHERE homestay_id = (
                SELECT homestay_id 
                FROM homes 
                WHERE home_id = (
                    SELECT home_id 
                    FROM home_admin 
                    WHERE home_admin_id = $id
                )
            )
        ";

        $update_home_sql = "
            UPDATE homes 
            SET 
                home_type = '$home_type',
                capacity = $capacity,
                price = $price,
                home_description = '$home_description',
                home_image = '$uploaded_home_image',
                home_status = '$home_status'
            WHERE home_id = (
                SELECT home_id 
                FROM home_admin 
                WHERE home_admin_id = $id
            )
        ";

        $update_location_sql = "
            UPDATE locations 
            SET 
                location_image = '$uploaded_location_image'
            WHERE location_id = (
                SELECT location_id 
                FROM homestay 
                WHERE homestay_id = (
                    SELECT homestay_id 
                    FROM homes 
                    WHERE home_id = (
                        SELECT home_id 
                        FROM home_admin 
                        WHERE home_admin_id = $id
                    )
                )
            )
        ";

        if (
            mysqli_query($link, $update_homestay_sql) &&
            mysqli_query($link, $update_home_sql) &&
            mysqli_query($link, $update_location_sql)
        ) {
            echo "Cập nhật thành công.";
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật: " . mysqli_error($link);
        }
    }
} else {
    echo "ID không hợp lệ.";
}

mysqli_close($link);
?>


<html>
<head>
    <title>Chỉnh sửa phòng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
        }
        input, textarea, select {
            width: 70%;
            margin-bottom: 10px;
            padding: 5px;
        }
        img {
            max-width: 150px;
            max-height: 100px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Chỉnh sửa phòng</h1>
    <form method="POST" enctype="multipart/form-data">
        Loại home: <input type="text" name="home_type" value="<?php echo htmlspecialchars($room['home_type'] ?? ''); ?>"><br>
        Tên homestay: <input type="text" name="homestay_name" value="<?php echo htmlspecialchars($room['homestay_name'] ?? ''); ?>"><br>
        Số người: <input type="number" name="capacity" value="<?php echo $room['capacity'] ?? ''; ?>"><br>
        Giá phòng: <input type="text" name="price" value="<?php echo $room['price'] ?? ''; ?>"><br>
        Mô tả homestay: <textarea name="description"><?php echo htmlspecialchars($room['homestay_description'] ?? ''); ?></textarea><br>
        Mô tả home: <textarea name="home_description"><?php echo htmlspecialchars($room['home_description'] ?? ''); ?></textarea><br>
        
        <!-- Hiển thị ảnh homestay -->
        <label>Ảnh hiện tại của Homestay:</label><br>
        <img src="<?php echo htmlspecialchars($room['homestay_image']); ?>" alt="Homestay Image"><br>
        Tải lên ảnh mới: <input type="file" name="homestay_image"><br>
        
        <!-- Hiển thị ảnh home -->
        <label>Ảnh hiện tại của Home:</label><br>
        <img src="<?php echo htmlspecialchars($room['home_image']); ?>" alt="Home Image"><br>
        Tải lên ảnh mới: <input type="file" name="home_image"><br>
        
        <!-- Hiển thị ảnh location -->
        <label>Ảnh hiện tại của Location:</label><br>
        <img src="<?php echo htmlspecialchars($room['location_image']); ?>" alt="Location Image"><br>
        Tải lên ảnh mới: <input type="file" name="location_image"><br>
        
        Trạng thái homestay:
        <select name="status">
            <option value="active" <?php echo ($room['status'] === 'active') ? 'selected' : ''; ?>>Hoạt động </option>
            <option value="unactive" <?php echo ($room['status'] === 'unactive') ? 'selected' : ''; ?>>Không hoạt động</option>
        </select><br>
        
        Trạng thái home:
        <select name="home_status">
            <option value="available" <?php echo ($room['home_status'] === 'available') ? 'selected' : ''; ?>>Có sẵn</option>
            <option value="unavailable" <?php echo ($room['home_status'] === 'unavailable') ? 'selected' : ''; ?>>Không có sẵn</option>
        </select><br>
        
        <input type="submit" value="Cập nhật phòng">
    </form>
</body>
</html>
