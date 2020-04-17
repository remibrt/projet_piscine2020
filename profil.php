<?php
    $reqprofil = $conn->prepare('SELECT * FROM user WHERE id = ?');
    $reqprofil->execute(array($_SESSION['id']));
    $userinfo = $reqprofil->fetch();
?>
