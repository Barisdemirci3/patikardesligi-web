<?php require_once "sidebar.php"; 
$id=$_GET["basvuruid"]; 
checkget($id,"index.php");
$get_ticket_data=$db->query("select * from basvurular where basvuru_id=$id");
$write_data=$get_ticket_data->fetch(PDO::FETCH_ASSOC);
if($write_data["basvuru_durum"]==0){
  $updatedata=$db->query("UPDATE basvurular SET basvuru_durum=1");
  goto a;
}
a:
$member_id=$write_data["basvuru_yapan"];
$get_user_data=$db->query("select * from uyeler where uye_id=$member_id");
$user_write=$get_user_data->fetch(PDO::FETCH_ASSOC);

?>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Başvuru detayları</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
              <li class="breadcrumb-item">Menüler</li>
              <li class="breadcrumb-item active" aria-current="page">Başvuru detayları</li>
            </ol>
          </div>

          <div class="text-center">
            <h4 class="pt-3">Başvuru <b>Detayları</b></h4>
          </div>
          <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <div class="text-center"></div>
                </div>
                <div class="card-body">
            
                    <div class="form-group">
                      <label for="exampleInputEmail1">Başvuru Sebebi</label>
                      <input type="email" disabled value="<?= $write_data["basvuru_sebebi"]; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Başvuru Detayı (Opsiyonel)</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled><?= $write_data["basvuru_aciklama"]; ?></textarea>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Başvuru yapan kişinni ID'si</label>
                      <input type="email" disabled value="#<?= $write_data["basvuru_yapan"]; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Başvuruyu gönderen kişinin kullanıcı adı</label>
                      <input type="email" disabled value="<?= $user_write["uye_nick"]; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Başvuru yapılan il<label for=""></label></label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled><?= $write_data["basvuru_sehir"]; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Başvuru yapılan ilçe</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled><?= $write_data["basvuru_ilce"]; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Başvuru yapılan adres</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled><?= $write_data["basvuru_adres"]; ?></textarea>
                    </div>
                  </form>
                  <a href="work.php?basvuruonay=<?= $write_data["basvuru_id"] ?>" class="btn btn-sm btn-success">Kabul et</a> <a href="work.php?basvurured=<?= $write_data["basvuru_id"] ?>" class="btn btn-sm btn-danger">Reddet</a>
                </div>
              </div>
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

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="js/admin-control.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>