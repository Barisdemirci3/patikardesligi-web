<?php include "sidebar.php"; 
if(isset($_GET["yasakla"])){
   if(!is_numeric($_GET["yasakla"])){
    echo "Hatalı parametre! Üyeler sayfasına yönlendiriliyor.";
    header("Location:datatables.php");
    die();
   }
   else{
    $memberid= trim($_GET["yasakla"]);
    $updatedata = $db->prepare("UPDATE uyeler SET uye_durum=0 WHERE uye_id=$memberid");
    $updatedata->execute();
   }
}
if(isset($_GET["yasakac"])){
    if(!is_numeric($_GET["yasakac"])){
     echo "Hatalı parametre! Üyeler sayfasına yönlendiriliyor.";
     header("Location:datatables.php");
     die();
    }
    else{
     $memberid= trim($_GET["yasakac"]);
     $updatedata = $db->prepare("UPDATE uyeler SET uye_durum=1 WHERE uye_id=$memberid");
     $updatedata->execute();
    }
 }
 if(isset($_GET["doadmin"])){
    if(!is_numeric($_GET["doadmin"])){
     echo "Hatalı parametre! Üyeler sayfasına yönlendiriliyor.";
     header("Location:datatables.php");
     die();
    }
    else{
     $memberid= trim($_GET["doadmin"]);
     $updatedata = $db->prepare("UPDATE uyeler SET uye_yetki=1 WHERE uye_id=$memberid");
     $updatedata->execute();
    }
 }
 if(isset($_GET["domember"])){
    if(!is_numeric($_GET["domember"])){
     echo "Hatalı parametre! Üyeler sayfasına yönlendiriliyor.";
     header("Location:datatables.php");
     die();
    }
    else{
     $memberid= trim($_GET["domember"]);
     $updatedata = $db->prepare("UPDATE uyeler SET uye_yetki=0 WHERE uye_id=$memberid");
     $updatedata->execute();
    }
 }
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Üyeler</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Üyeler</li>
        </ol>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- Datatables -->

        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="input-group">
                        <input style="max-width: 200px; justify-content:right;" type="text"
                            class="form-control bg-light border-1 small" placeholder="Üye bul" aria-label="Search"
                            aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                    <small class="form-text text-muted">Kullanıcı bulmak için lütfen kullanıcı adını yazınız!</small>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>İsim</th>
                                <th>Kullanıcı adı</th>
                                <th>Mail adresi</th>
                                <th>Yetki</th>
                                <th>IP adresi</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>İsim</th>
                                <th>Kullanıcı adı</th>
                                <th>Mail adresi</th>
                                <th>Yetki</th>
                                <th>IP adresi</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $dataget= $db->query("select * from uyeler");
                      while($datawrite= $dataget->fetch(PDO::FETCH_ASSOC)){
                      ?>
                            <tr role="row" class="odd">
                                <td> #<?= $datawrite["uye_id"]; ?></td>
                                <td class="sorting_1"><?= $datawrite["uye_isim"]; ?></td>
                                <td><?= $datawrite["uye_nick"]; ?></td>
                                <td><?= $datawrite["uye_mail"]; ?></td>
                                <?php switch ($datawrite["uye_yetki"]) {
                          case 1:
                            ?> <td><span class="badge badge-primary">Admin</span></td><?php
                            break;
                          
                          case 0:
                            ?> <td><span class="badge badge-secondary">Üye</span></td> <?php
                            break;
                        } ?>

                                <td><?= $datawrite["uye_ip"]; ?></td>
                                <?php 
                                switch ($datawrite["uye_durum"]) {
                                    case 0:
                                        echo '<td><span class="badge badge-danger">Yasaklı Üye</span></td>';
                                        break;
                                        case 1:
                                            echo '<td><span class="badge badge-success">Aktif Üye</span></td>';
                                            break;
                                }
                                ?>
                            <td><a href="?doadmin=<?= $datawrite["uye_id"]; ?>" title="Admin Yap"class="btn btn-primary">Admin yap</a> <a href="?domember=<?= $datawrite["uye_id"]; ?>" title="Üye Yap"class="btn btn-secondary  ">Üye yap</a>  <a href="?yasakla=<?= $datawrite["uye_id"]; ?>" title="Yasakla"class="btn btn-danger">Yasakla</a> <a href="?yasakac=<?= $datawrite["uye_id"]; ?>" title="Yasak Aç"class="btn btn-success">Yasağı Aç</a></td> 
                            
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>

<!---Container Fluid-->
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="#" target="_blank">Patikardesligi</a></b>
        </div>
    </div>
</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="../js/jquery.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
<!-- Page level plugins -->

<!-- Page level custom scripts -->


</body>

</html>