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
  <body class="bg-light">
    <div class="container py-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Review Hiburanmu</h2>
        <a href="addEntertain.php" class="btn btn-primary">+ Tambah Review</a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white">
          <thead class="table-dark">
            <tr>
              <th style="width: 50px;">#</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Rating</th>
              <th>Komentar</th>
              <th style="width: 150px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($entertain = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= htmlspecialchars($entertain['name']) ?></td>
                <td><?= htmlspecialchars($entertain['category']) ?></td>
                <td>
                  <span class="badge bg-<?= $entertain['rating'] >= 4 ? 'success' : ($entertain['rating'] >= 3 ? 'warning text-dark' : 'danger') ?>">
                    <?= $entertain['rating'] ?> / 5
                  </span>
                </td>
                <td><?= nl2br(htmlspecialchars($entertain['review'])) ?></td>
                <td>
                  <a href="editEntertain.php?entertain_id=<?= $entertain['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="deleteEntertain.php?entertain_id=<?= $entertain['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
              </tr>
              <?php $no++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
