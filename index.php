<?php
    include 'connection.php';
    
    $query = "SELECT * FROM entertainment_reviews";
    $result = mysqli_query($conn, $query);
    $no = 1;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Review Hiburan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <h2>Review Hiburanmu!</h2>
    <a href="addEntertain.php">Tambah</a>
    <table class="table table-hover">
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Rating</th>
        <th>Komentar</th>
        <th>Aksi</th>
      </tr>
      <?php while ($entertain = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $entertain['name'] ?></td>
          <td><?= $entertain['category'] ?></td>
          <td><?= $entertain['rating'] ?></td>
          <td><?= $entertain['review'] ?></td>
          <td>
            <a href="editEntertain.php?entertain_id=<?= $entertain['id'] ?>">Edit</a>
            <a href="deleteEntertain.php?entertain_id=<?= $entertain['id'] ?>" onclick='return confirm("Hapus data ini?")'>Delete</a>
          </td>
        </tr>
        <?php $no++; ?>
      <?php endwhile; ?>
    </table>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
