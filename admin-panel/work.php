<?php 
require_once "../connect.php";
require_once "../functions.php";
if(isset($_GET["closeticketid"]) && is_numeric($_GET["closeticketid"])){
    $closeticket = $db->prepare("UPDATE ticket SET ticket_durum =2 WHERE ticket_id= {$_GET['closeticketid']}");
    $closeticket->execute();
    header("Location: tickets.php");
}
elseif(isset($_GET["openticketid"]) && is_numeric($_GET["openticketid"])){
    $openticket = $db->prepare("UPDATE ticket SET ticket_durum =0 , ticket_cevap='' WHERE ticket_id= {$_GET['openticketid']}");
    $openticket->execute();
    header("Location: tickets.php");
}
elseif(!is_numeric($_GET["openticketid"]) || !is_numeric($_GET["closeticketid"])){
    header("Location: index.php");
}
if(isset($_GET[""])){
    header("Location: index.php");
}
if(isset($_GET["basvuruonay"]) && is_numeric($_GET["basvuruonay"])){
    $updatebasvuru= $db->query("UPDATE basvurular SET basvuru_durum=2");
    header("Location: adminbasvuru-detail.php");
}
if(isset($_GET["basvurured"]) && is_numeric($_GET["basvurured"])){
    $updatebasvuru= $db->query("UPDATE basvurular SET basvuru_durum=3");
    header("Location: adminbasvuru-detail.php");
}
?>