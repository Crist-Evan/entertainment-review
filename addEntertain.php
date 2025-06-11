<?php
  include 'connection.php';

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $query = "INSERT INTO entertainment_reviews (name, category, rating, review) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssis', $name, $category, $rating, $review);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Review Hiburan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
  </head>
  <body class="bg-light">
    <div class="container py-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-4">Tambah Review Hiburan</h3>
          <form method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" name="name" id="name" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Kategori</label>
              <select name="category" id="category" class="form-select" required>
                <option value="" selected disabled>-- Pilih Kategori --</option>
                <?php
                  $categories = ['Anime', 'Komik', 'Film', 'Novel', 'Manga', 'Animation'];
                  foreach ($categories as $cat) {
                    echo "<option value=\"$cat\">$cat</option>";
                  }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="rating" class="form-label">Rating</label>
              <select name="rating" id="rating" class="form-select" required>
                <option value="" selected disabled>-- Pilih Rating --</option>
                <?php
                  $ratings = [1, 2, 3, 4, 5];
                  $labels = ['Buruk', 'Kurang', 'Cukup', 'Bagus', 'Sangat Bagus'];
                  foreach ($ratings as $i => $rate) {
                    echo "<option value=\"$rate\">$rate - {$labels[$i]}</option>";
                  }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="review" class="form-label">Komentar</label>
              <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
            </div>

            <div class="d-flex justify-content-between">
              <a href="index.php" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
