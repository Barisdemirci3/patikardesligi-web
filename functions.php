<?php 
function post($data){
$data= htmlspecialchars(trim($_POST[$data]));
return $data;
}
function checkget($number,$url){
 if(!is_numeric($number)){
     header("Location: $url");
 }
}
function SessionCheck(){
    if(!$_SESSION["uye_nick"]){
       return header("Location: index.php");
    }
} 
function adminSessionCheck(){
    if(!$_SESSION["uye_durum"]==1){
        return header("Location: ../index.php");
    }
}
function kisalt($data){
    if(strlen($data)>20){
        $lastdata= substr($data,0,20);
        return "$lastdata...";
    }else{
        return $data;
    }
}
?>