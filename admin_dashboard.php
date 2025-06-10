<?php
// Kết nối đến cơ sở dữ liệu
$link = mysqli_connect("localhost", "root", "", "databooking");

if (!$link) {
    die("Không thể kết nối đến máy chủ: " . mysqli_connect_error());
}

// Lấy dữ liệu  từ cơ sở dữ liệu với JOIN các bảng homes, home_admin, homestay và locations
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
        h.image, 
        r.home_status,
        h.status, 
        l.city 
    FROM 
        home_admin ra
    INNER JOIN homes r ON ra.home_id = r.home_id
    INNER JOIN homestay h ON r.homestay_id = h.homestay_id
    INNER JOIN locations l ON h.location_id = l.location_id
";

$result = mysqli_query($link, $sql);

if (!$result) {
    die("Truy vấn thất bại: " . mysqli_error($link));
}

// Đóng kết nối
mysqli_close($link);
?>

<html>
<head>
    <title>Bảng Điều Khiển Admin - Quản Lý Phòng HOMESTAY </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .btn-add {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }
        .btn-add:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #343a40;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        img {
            width: 100px;
            height: auto;
        }
        .action-icons {
            color: #007bff;
            cursor: pointer;
            margin: 0 5px;
        }
        .action-icons:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>QUẢN LÝ PHÒNG HOMESTAY</h1>
    <a href="add_home.php" class="btn-add">Thêm Phòng</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Loại home</th>
                <th>Tên Homestay</th>
                <th>Vị trí</th>
                <th>Số Người</th>
                <th>Giá (VND)</th>
                <th>Mô Tả Homestay</th>
                <th>Mô Tả Home </th>
                <th>Ảnh homestay</th>
                <th>Ảnh home</th>
                <th>Ảnh Location</th>
                <th>Trạng thái</th>
                <th>Trạng thái Home</th>
                <th>Tùy chỉnh</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['home_admin_id']; ?></td>
                        <td><?php echo $row['home_type']; ?></td>
                        <td><?php echo $row['homestay_name']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['capacity']; ?></td>
                        <td><?php echo number_format($row['price'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo htmlspecialchars($row['homestay_description']); ?></td>
                        <td><?php echo htmlspecialchars($row['home_description']); ?></td> 
                        <td>
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="homestay Image">
                        </td>
                        <td>
                        <img src="<?php echo htmlspecialchars($row['home_image']); ?>" alt="home Image">
                        </td>
                        <td>
                        <img src="<?php echo htmlspecialchars($row['location_image']); ?>" alt="location Image">
                        </td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['home_status']; ?></td>
                        <td>
                            <span class="action-icons"><a href="edit_home.php?id=<?php echo $row['home_admin_id']; ?>">Sửa</a></span>
                            <span class="action-icons"><a href="delete_home.php?id=<?php echo $row['home_admin_id']; ?>">Xóa</a></span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">Không có phòng nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
