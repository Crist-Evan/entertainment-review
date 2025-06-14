<?php
  include 'connection.php';

  if (!isset($_GET['entertain_id']) || !is_numeric($_GET['entertain_id'])) {
    die('ID tidak valid');
  }
  $entertain_id = $_GET['entertain_id'];

  $query = "SELECT * FROM entertainment_reviews WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'i', $entertain_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $entertain = mysqli_fetch_assoc($result);

  if (!$entertain) {
    die('Data tidak ditemukan');
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $query = "UPDATE entertainment_reviews SET name = ?, category = ?, rating = ?, review = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssisi', $name, $category, $rating, $review, $entertain_id);
    mysqli_stmt_execute($stmt);

    header("Location: dashboard.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Hiburan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="container py-4">
    <h2>Edit Hiburan</h2>
    <form method="post" class="mt-3">
      <div class="mb-3">
        <label for="name" class="form-label">Nama:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($entertain['name']) ?>" class="form-control" required />
      </div>

      <div class="mb-3">
        <label for="category" class="form-label">Kategori:</label>
        <select name="category" id="category" class="form-select" required>
          <option value="">-- Pilih Kategori --</option>
          <?php
            $categories = ['Anime', 'Komik', 'Film', 'Novel', 'Manga', 'Animation'];
            foreach ($categories as $cat) {
              $selected = ($entertain['category'] === $cat) ? 'selected' : '';
              echo "<option value=\"$cat\" $selected>$cat</option>";
            }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="rating" class="form-label">Rating:</label>
        <select name="rating" id="rating" class="form-select" required>
          <option value="">-- Pilih Rating --</option>
          <?php
            $ratings = [1, 2, 3, 4, 5];
            $labels = ['Buruk', 'Kurang', 'Cukup', 'Bagus', 'Sangat Bagus'];
            foreach ($ratings as $i => $rate) {
              $selected = ($entertain['rating'] == $rate) ? 'selected' : '';
              echo "<option value=\"$rate\" $selected>$rate - {$labels[$i]}</option>";
            }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="review" class="form-label">Komentar:</label>
        <textarea name="review" id="review" class="form-control" rows="4" required><?= htmlspecialchars($entertain['review']) ?></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      <a href="dashboard.php" class="btn btn-secondary">Batal</a>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

