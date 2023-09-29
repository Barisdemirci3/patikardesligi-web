<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
SessionCheck();
$dataget = $db->prepare("select * from uyeler where uye_id=:id");
$dataget->execute(["id" => $_SESSION["id"]]);
$datawrite = $dataget->fetch(PDO::FETCH_ASSOC);
$checkbasvurudata= $db->prepare("SELECT * FROM basvurular WHERE basvuru_yapan=?");
$checkbasvurudata->execute([$_SESSION["id"]]);
$veriyaz=$checkbasvurudata->fetch(PDO::FETCH_ASSOC);
if($veriyaz["basvuru_durum"]==2){
header("Location:index.php?basvurudurum=2"); 
}elseif($veriyaz["basvuru_durum"]==3){
    header("Location:index.php?basvurudurum=3"); 
}
?>

<div id="contact-page" class="container">


    <div class="row">
        <div class="col-sm-12">
            <div class="contact-form">
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" class="contact-form row" name="contact-form" onsubmit="return false;" enctype="multipart/form-data" method="post">
                    <div class="form-group col-md-12">
                        <h2 class="title text-center">Başvuru yap!</h2>
                        <b style="font-size: 12pt;">Başvuru sebebi</b>
                        <input type="text" name="" id="sebep" class="form-control" required="required">
                    </div>
                    <div class="form-group col-md-12">
                        <b style="font-size: 12pt;">Detay eklemek isterseniz buraya ekleyebilirsiniz (İsteğe Bağlı)</b>
                        <textarea class="form-control" id="detay" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <b style="font-size: 12pt;">Başvuru yapılan il</b>
                        <input type="text" name="" id="il" class="form-control" required="required">
                    </div>
                    <div class="form-group col-md-12">
                        <b style="font-size: 12pt;">Başvuru yapılan ilçe</b>
                        <input type="text" name="" id="ilce" class="form-control" required="required">
                    </div>
                    <div class="form-group col-md-12">
                        <b style="font-size: 12pt;">Adres</b>
                        <textarea class="form-control" id="adres" rows="3"></textarea>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary pull-right" onclick="bepatiapp();" value="Gönder">
                </form>
            </div>
        </div>

    </div>
</div>
<?php include "footer.php";
$dataget = null;
$db = null;
?>
</body>

</html>