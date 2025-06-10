<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuyển hướng</title>
    <style>
        body {
            text-align: center;
            color: #bde716;
        }

        p {
            font-size: 1.2rem;
        }

        a {
            text-decoration: none;
            color: #a7db4e;
            font-weight: bold;
            background-color: #007bff;
            padding: 1% 1%;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        span {
            font-weight: bold;
            font-size: 1.5rem;
            color: #ffeb3b;
        }
    </style>
</head>
<body>
    <script>
        let sogiay = 3;
        function countdown() {
            if (sogiay >= 0) {
                document.getElementById('sogiay').innerText = sogiay;
                sogiay--;
            }
        }

        setTimeout(() => {
            document.location = 'index.php';
        }, sogiay * 1000);

        setInterval(countdown, 1000);
    </script>

    <p>Giao dịch thành công</p>
    <p><a href="index.html">Quay lại trang chủ</a></p>
    <p>Sẽ quay lại trang chủ sau <span id="sogiay">3</span> giây nữa</p>
</body>
</html>
