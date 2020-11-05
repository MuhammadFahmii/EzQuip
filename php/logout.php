<?php 
    session_start();
    // hapus session
    $_SESSION=[];
    session_unset();
    session_destroy();
    
    // hapus cookie
    setcookie('id','',time()-3600);
    setcookie('key','',time()-3600);
    header("location: login.php");
    exit;
?>