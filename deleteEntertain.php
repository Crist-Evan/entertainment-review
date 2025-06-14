<?php
    include 'connection.php';
    $entertain_id = $_GET['entertain_id'];

    $query = "DELETE FROM entertainment_reviews WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $entertain_id);
    mysqli_stmt_execute($stmt);

    header("Location: dashboard.php");
    exit;
?>