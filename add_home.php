<?php
// Kết nối cơ sở dữ liệu
$link = mysqli_connect("localhost", "root", "", "databooking");
if (!$link) {
    die("Không thể kết nối đến cơ sở dữ liệu: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $home_type = mysqli_real_escape_string($link, $_POST['home_type'] ?? '');
    $homestay_id = mysqli_real_escape_string($link, $_POST['homestay_id'] ?? '');
    $location = mysqli_real_escape_string($link, $_POST['location'] ?? '');
    $capacity = mysqli_real_escape_string($link, $_POST['capacity'] ?? 0);
    $price = mysqli_real_escape_string($link, $_POST['price'] ?? 0);
    $homestay_description = mysqli_real_escape_string($link, $_POST['homestay_description'] ?? '');
    $home_description = mysqli_real_escape_string($link, $_POST['home_description'] ?? '');
    $home_status = mysqli_real_escape_string($link, $_POST['home_status'] ?? '');
    $status = mysqli_real_escape_string($link, $_POST['status'] ?? '');

    // Xử lý ảnh tải lên
    $upload_dir = 'uploads/'; // Đường dẫn lưu ảnh
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Kiểm tra và xử lý ảnh Homestay
    $homestay_image = '';
    if (isset($_FILES['homestay_image']) && $_FILES['homestay_image']['error'] === UPLOAD_ERR_OK) {
        $homestay_image = $upload_dir . basename($_FILES['homestay_image']['name']);
        if (!move_uploaded_file($_FILES['homestay_image']['tmp_name'], $homestay_image)) {
            die("Lỗi khi tải lên ảnh Homestay.");
        }
    }

    // Kiểm tra và xử lý ảnh Home
    $home_image = '';
    if (isset($_FILES['home_image']) && $_FILES['home_image']['error'] === UPLOAD_ERR_OK) {
        $home_image = $upload_dir . basename($_FILES['home_image']['name']);
        if (!move_uploaded_file($_FILES['home_image']['tmp_name'], $home_image)) {
            die("Lỗi khi tải lên ảnh Home.");
        }
    }

    // Kiểm tra và xử lý ảnh Location
    $location_image = '';
    if (isset($_FILES['location_image']) && $_FILES['location_image']['error'] === UPLOAD_ERR_OK) {
        $location_image = $upload_dir . basename($_FILES['location_image']['name']);
        if (!move_uploaded_file($_FILES['location_image']['tmp_name'], $location_image)) {
            die("Lỗi khi tải lên ảnh Location.");
        }
    }

    // Kiểm tra homestay_id có tồn tại không
    $check_homestay = "SELECT homestay_id FROM homestay WHERE homestay_id = '$homestay_id' LIMIT 1";
    $homestay_result = mysqli_query($link, $check_homestay);
    if (mysqli_num_rows($homestay_result) == 0) {
        die("Homestay với ID '$homestay_id' không tồn tại.");
    }

    // Tạo home_admin_id
    $admin_query = "INSERT INTO home_admin () VALUES ()";
    if (mysqli_query($link, $admin_query)) {
        $home_admin_id = mysqli_insert_id($link);

        // Chèn dữ liệu vào bảng homes
        $home_query = "
            INSERT INTO homes (home_admin_id, home_type, capacity, price, home_image, home_description, home_status, homestay_id)
            VALUES ('$home_admin_id', '$home_type', '$capacity', '$price', '$home_image', '$home_description', '$home_status', '$homestay_id')
        ";
        if (!mysqli_query($link, $home_query)) {
            die("Lỗi khi thêm dữ liệu vào bảng homes: " . mysqli_error($link));
        }

        // Cập nhật home_id và homestay_id trong bảng home_admin
        $update_query = "
            UPDATE home_admin
            SET home_id = (SELECT home_id FROM homes WHERE home_admin_id = '$home_admin_id' LIMIT 1),
                homestay_id = '$homestay_id'
            WHERE home_admin_id = '$home_admin_id'
        ";
        if (!mysqli_query($link, $update_query)) {
            die("Lỗi khi cập nhật home_id và homestay_id: " . mysqli_error($link));
        }

        echo "Dữ liệu đã được thêm thành công!";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        die("Không thể tạo home_admin_id: " . mysqli_error($link));
    }
}

// Truy vấn để lấy danh sách homestay
$homestay_list_query = "SELECT homestay_id, homestay_name FROM homestay";
$homestay_list_result = mysqli_query($link, $homestay_list_query);
if (!$homestay_list_result) {
    die("Lỗi khi lấy danh sách homestay: " . mysqli_error($link));
}

// Truy vấn để lấy danh sách city
$location_list_query = "SELECT location_id, city FROM locations";
$location_list_result = mysqli_query($link, $location_list_query);
if (!$location_list_result) {
    die("Lỗi khi lấy danh sách location: " . mysqli_error($link));
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Home Mới</title>
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
    <h1>Thêm Home Mới</h1>
    <form action="add_home.php" method="post" enctype="multipart/form-data">
        <!-- Loại Home -->
        <label for="home_type">Loại Home:</label>
         <select name="home_type" id="home_type" required style="width: 70%;">
            <option value="Home tiêu chuẩn">Home tiêu chuẩn</option>
            <option value="Home cao cấp">Home cao cấp</option>
            <option value="Home siêu vip">Home siêu vip</option>
         </select><br>

        <!-- Chọn Homestay -->
        <label for="homestay_id">Chọn Homestay:</label>
        <select name="homestay_id" id="homestay_id" required>
            <option value="">Chọn Homestay</option>
            <?php
            // Hiển thị danh sách homestay
            while ($homestay = mysqli_fetch_assoc($homestay_list_result)) {
                echo "<option value='" . $homestay['homestay_id'] . "'>" . $homestay['homestay_name'] . "</option>";
            }
            ?>
        </select><br>
           <!-- Chọn City -->
            <label for="location_id">Chọn Location:</label>
            <select name="location_id" id="location_id">
            <option value="">Chọn city</option>
            <?php
            // Hiển thị danh sách city
            while ($locations = mysqli_fetch_assoc($location_list_result)) {
                echo "<option value='" . $locations['location_id'] . "'>" . $locations['city'] . "</option>";
            }
            ?>
        </select><br>

        <!-- Số Người -->
        <label for="capacity">Số Người:</label>
        <input type="number" name="capacity" id="capacity" required><br>

        <!-- Giá -->
        <label for="price">Giá (VND):</label>
        <input type="number" name="price" id="price" required><br>

        <!-- Mô Tả Home -->
        <label for="home_description">Mô Tả Home:</label>
        <textarea name="home_description" id="home_description" required></textarea><br>

        <!-- Ảnh Homestay -->
        <label for="homestay_image">Ảnh Homestay:</label>
        <input type="file" name="homestay_image" id="homestay_image" required><br>

        <!-- Ảnh Home -->
        <label for="home_image">Ảnh Home:</label>
        <input type="file" name="home_image" id="home_image" required><br>

        <!-- Ảnh Location -->
        <label for="location_image">Ảnh Location:</label>
        <input type="file" name="location_image" id="location_image" required><br>

        <!-- Trạng thái -->
        <label for="status">Trạng thái Homestay:</label>
        <select name="status" id="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select><br>

        <!-- Trạng thái Home -->
        <label for="home_status">Trạng thái Home:</label>
        <select name="home_status" id="home_status" required>
            <option value="available">Available</option>
            <option value="Unavailable">Unavailable</option>
        </select><br>

        <button type="submit">Thêm Home</button>
    </form>
</body>
</html>
