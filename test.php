<?php

require_once 'config/database.php';

$db = new Database();
$conn = $db->getConnection();

if ($conn) {
    echo "<h2>Kết nối Database thành công!</h2>";
} else {
    echo "<h2>Kết nối Database thất bại!</h2>";
}

?>