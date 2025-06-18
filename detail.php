<?php 
include 'config.php';

if (isset($_GET['id'])) {
  $province_id = intval($_GET['id']);

  $province_query = "SELECT * FROM provinces WHERE id = $province_id";
  $province_result = mysqli_query($conn, $province_query);
  $province = mysqli_fetch_assoc($province_result);

  if (!$province) {
    echo "Không tìm thấy tỉnh.";
    exit;
  }

  $dest_query = "SELECT * FROM destinations WHERE province_id = $province_id";
  $dest_result = mysqli_query($conn, $dest_query);

  $food_query = "SELECT * FROM food WHERE province_id = $province_id";
  $food_result = mysqli_query($conn, $food_query);

  $event_query = "SELECT * FROM events WHERE province_id = $province_id";
  $event_result = mysqli_query($conn, $event_query);

  $modal_query = "SELECT * FROM modal_content WHERE province_id = $province_id";
  $modal_result = mysqli_query($conn, $modal_query);

} else {
  echo "Không có tỉnh nào được chọn.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($province['name']); ?></title>
  <link rel="stylesheet" href="assets/css/Tinh.css">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>

<?php include 'pages/navbar.php'; ?>

<section class="province-detail">
  <h1><?php echo htmlspecialchars($province['name']); ?></h1>
  <img src="<?php echo htmlspecialchars($province['image_path']); ?>" alt="<?php echo htmlspecialchars($province['name']); ?>" width="800">

  <h2>Giới thiệu</h2>
  <p><?php echo nl2br($province['description']); ?></p>

  <h2>Địa điểm nổi bật</h2>
  <div class="grid">
    <?php while ($row = mysqli_fetch_assoc($dest_result)): ?>
      <div class="card">
        <img src="<?php echo $row['image_path']; ?>" alt="">
        <h3><?php echo $row['name']; ?></h3>
        <p>Đánh giá: <?php echo $row['rating']; ?>/5</p>
      </div>
    <?php endwhile; ?>
  </div>

  <h2>Ẩm thực địa phương</h2>
  <div class="grid">
    <?php while ($row = mysqli_fetch_assoc($food_result)): ?>
      <div class="card">
        <img src="<?php echo $row['image_path']; ?>" alt="">
        <h3><?php echo $row['name']; ?></h3>
      </div>
    <?php endwhile; ?>
  </div>

  <h2>Sự kiện</h2>
  <div class="grid">
    <?php while ($row = mysqli_fetch_assoc($event_result)): ?>
      <div class="card">
        <img src="<?php echo $row['image_path']; ?>" alt="">
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['date']; ?> - <?php echo $row['location']; ?></p>
        <p><?php echo $row['description']; ?></p>
      </div>
    <?php endwhile; ?>
  </div>

  <h2>Thông tin thêm</h2>
  <ul>
    <?php while ($row = mysqli_fetch_assoc($modal_result)): ?>
      <li><strong><?php echo $row['title']; ?>:</strong> <?php echo $row['content']; ?></li>
    <?php endwhile; ?>
  </ul>
</section>

<?php include 'pages/footer.php'; ?>

</body>
</html>
