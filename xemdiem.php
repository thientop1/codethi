<!DOCTYPE html>
<html>
<head>
    <title>Xem Điểm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: inline-block;
            width: 120px;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Xem Điểm Sinh Viên</h2>

    <form method="post" action="xemdiem.php">
        <label for="masv">Mã Sinh Viên:</label>
        <input type="text" id="masv" name="masv" required><br>

        <label for="mamonhoc">Mã Môn Học:</label>
        <input type="text" id="mamonhoc" name="mamonhoc" required><br>

        <input type="submit" value="Xem điểm">
    </form>

    <div class="result">
        <?php
        // Thông tin kết nối đến cơ sở dữ liệu
        $servername = "localhost";
        $username = "admin";
        $password = "Thien141747"; // Thay bằng mật khẩu thực tế của bạn
        $database = "Diem"; // Tên cơ sở dữ liệu là 'Diem'

        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli($servername, $username, $password, $database);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Xử lý khi nhận form submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $masv = $_POST["masv"];
            $mamonhoc = $_POST["mamonhoc"];

            // Sử dụng Prepared Statement để tránh SQL Injection
            $stmt = $conn->prepare("SELECT Diem FROM Diem WHERE MaSV = ? AND MaMonHoc = ?");
            $stmt->bind_param("ss", $masv, $mamonhoc);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Hiển thị điểm của sinh viên
                $row = $result->fetch_assoc();
                echo "Điểm của sinh viên có Mã SV: <b>$masv</b> và Mã Môn Học: <b>$mamonhoc</b> là <b>" . $row["Diem"] . "</b>";
            } else {
                echo "Không tìm thấy điểm cho sinh viên có Mã SV: <b>$masv</b> và Mã Môn Học: <b>$mamonhoc</b>";
            }

            $stmt->close();
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>
</body>
</html>
