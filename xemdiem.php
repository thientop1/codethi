<!DOCTYPE html>
<html>
<head>
    <title>Xem Điểm</title>
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

    <?php
    // Kết nối đến cơ sở dữ liệu MySQL
    $servername = "localhost";
    $username = "tai_khoan_mysql";
    $password = "mat_khau_mysql";
    $database = "ten_database";

    $conn = new mysqli($servername, $username, $password, $database);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xử lý khi nhận form submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $masv = $_POST["masv"];
        $mamonhoc = $_POST["mamonhoc"];

        // Truy vấn điểm của sinh viên
        $sql = "SELECT Diem FROM Diem WHERE MaSV = '$masv' AND MaMonHoc = '$mamonhoc'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị điểm của sinh viên
            $row = $result->fetch_assoc();
            echo "Điểm của sinh viên có Mã SV: $masv và Mã Môn Học: $mamonhoc là " . $row["Diem"];
        } else {
            echo "Không tìm thấy điểm cho sinh viên có Mã SV: $masv và Mã Môn Học: $mamonhoc";
        }
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>
</html>
