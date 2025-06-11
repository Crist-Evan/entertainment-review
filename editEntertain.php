<?php
  include 'connection.php';
  $entertain_id = $_GET['entertain_id'];

  $query = "SELECT * FROM entertainment_reviews WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'i', $entertain_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $entertain = mysqli_fetch_assoc($result);

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $query = "UPDATE entertainment_reviews SET name = ?, category = ?, rating = ?, review = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssisi', $name, $category, $rating, $review, $entertain_id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Hiburan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <form method="post">
      <label for="name">Nama: </label>
      <input type="text" name="name" id="name" value="<?= $entertain['name'] ?>" required/><br />
      <label for="category">Kategori: </label>
      <select name="category" id="category" required>
        <option value="">-- Pilih Kategori --</option>
        <?php
          $categories = ['Anime', 'Komik', 'Film', 'Novel', 'Manga', 'Animation'];
          foreach ($categories as $cat) {
            $selected = ($entertain['category'] === $cat) ? 'selected' : '';
            echo "<option value=\"$cat\" $selected>$cat</option>";
          }
        ?>
      </select><br />
      <label for="rating">Rating: </label>
      <select name="rating" id="rating" required>
        <option value="">-- Pilih Rating --</option>
        <?php
          $ratings = [1, 2, 3, 4, 5];
          $labels = ['Buruk', 'Kurang', 'Cukup', 'Bagus', 'Sangat Bagus'];
          foreach ($ratings as $i => $rate) {
            $selected = ($entertain['rating'] == $rate) ? 'selected' : '';
            echo "<option value=\"$rate\" $selected>$rate - {$labels[$i]}</option>";
          }
        ?>
      </select><br />
      <label for="review">Komentar: </label>
      <textarea name="review" id="review" required><?= $entertain['review'] ?></textarea><br />
      <input type="submit" value="Edit">
    </form>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
