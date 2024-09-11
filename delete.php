<?php
$file = 'data.json';

if (file_exists($file)) {
    $books = json_decode(file_get_contents($file), true);
    
    
    if (isset($_GET['index']) && is_numeric($_GET['index']) && $_GET['index'] >= 0 && $_GET['index'] < count($books)) {
        $index = (int)$_GET['index'];
        
      
        array_splice($books, $index, 1);
        
    
        file_put_contents($file, json_encode($books, JSON_PRETTY_PRINT));
        
        
        header('Location: daftar.php');
        exit;
    }
}


header('Location: index.php');
exit;
