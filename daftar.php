<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Buku</h1>
    <ul>
        <?php
        $file = 'data.json';
        if (file_exists($file)) {
            $books = json_decode(file_get_contents($file), true);
            foreach ($books as $index => $book) {
                $coverImg = !empty($book['cover']) ? '<img src="' . htmlspecialchars($book['cover']) . '" alt="Sampul Buku" style="max-width: 100px; height: auto; margin-right: 10px;">' : '';
                $deleteUrl = "delete.php?index=" . $index;
                echo "<li>{$coverImg}{$book['title']} oleh {$book['author']} ({$book['year']}) <a href=\"$deleteUrl\" onclick=\"return confirm('Apakah Anda yakin ingin menghapus buku ini?');\">Hapus</a></li>";
            }
        } else {
            echo "<li>Tidak ada buku.</li>";
        }
        ?>
    </ul>
    <a href="Tambah.php">Tambah Buku</a> <br><br>
    <a href="Home.html">Kembali ke Home</a>
</body>
</html>
