<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Buku</h1>
    <form action="Tambah.php" method="post" enctype="multipart/form-data">
        <label for="title">Judul:</label>
        <input type="text" id="title" name="title" required>
        <br><br>
        <label for="author">Pengarang:</label>
        <input type="text" id="author" name="author" required>
        <br><br>
        <label for="year">Tahun:</label>
        <input type="number" id="year" name="year" required>
        <br><br>
        <label for="cover">Sampul Buku:</label>
        <input type="file" id="cover" name="cover" accept="image/*" required>
        <br><br>
        <button type="submit">Tambah Buku</button>
    </form>
    <br><br>
    <a href="Home.html">Kembali ke Home</a>

    <?php
ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    
    
    $cover = $_FILES['cover'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($cover['name']);
    
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    
    if (move_uploaded_file($cover['tmp_name'], $uploadFile)) {
        $coverPath = $uploadFile;
    } else {
        $coverPath = '';
    }

    $file = 'data.json';

   
    $books = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

   
    $books[] = [
        'title' => $title,
        'author' => $author,
        'year' => $year,
        'cover' => $coverPath
    ];

 
    file_put_contents($file, json_encode($books, JSON_PRETTY_PRINT));

    header('Location: Daftar.php');
    exit();
}
?>

<?php

ob_end_flush();
?>

</body>
</html>
