<?php include 'config.php'; ?>
<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Khám phá miền Nam</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_SESSION['login_success'])): ?>
<script>
    Swal.fire({
        title: 'Đăng nhập thành công!',
        text: 'Chào mừng <?php echo $_SESSION["username"]; ?> đến với website.',
        icon: 'success',
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: true
    });
</script>
<?php unset($_SESSION['login_success']); ?>
<?php endif; ?>

    
    <div class="dashboard">
        <!-- Thanh menu -->
        <?php include 'pages/navbar.php'; ?>

        <!-- Slide ảnh -->
        <div class="slider-container">
            <button class="prev">&#10094;</button>
            <div class="slider">
                <div class="slide"><img src="assets/image/provinces/ca_mau.jpg" alt="Cà Mau"></div>
                <div class="slide"><img src="assets/image/provinces/dong_nai.jpg" alt="Đồng Nai"></div>
                <div class="slide"><img src="assets/image/provinces/vung_tau.jpg" alt="Vũng Tàu"></div>
                <div class="slide"><img src="assets/image/provinces/an_giang.jpg" alt="An Giang"></div>
                <div class="slide"><img src="assets/image/provinces/ben_tre.jpg" alt="Bến Tre"></div>
                <div class="slide"><img src="assets/image/provinces/phu_quoc.jpg" alt="Phú Quốc"></div>
                <div class="slide"><img src="assets/image/provinces/tra_vinh.jpg" alt="Trà Vinh"></div>
                <div class="slide"><img src="assets/image/provinces/can_tho.jpg" alt="Cần Thơ"></div>
            </div>
            <button class="next">&#10095;</button>
        </div>

        <!-- Danh sách tỉnh -->
        <div class="content">
            <div class="title">
                <h2>Các tỉnh miền Nam:</h2>
            </div>

            <?php
            $sql = "SELECT * FROM provinces";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href="detail.php?id=' . $row['id'] . '" class="card-link">';
                echo '<div class="card">';
                echo '  <div class="card-banner">';
                echo '      <img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                echo '  </div>';
                echo '  <div class="card-body">';
                echo '      <h2>' . htmlspecialchars($row['name']) . '</h2>';
                echo '  </div>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>

        <!-- Footer -->
        <?php include 'pages/footer.php'; ?>
    </div>

    <!-- Slide script -->
    <script src="assets/js/luot_slide.js"></script>
</body>
</html>
