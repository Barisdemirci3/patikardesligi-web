<?php require_once "sidebar.php"; ?>
      <div id="content">
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tickets</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Anasayfa</a></li>
              <li class="breadcrumb-item">Menüler</li>
              <li class="breadcrumb-item active" aria-current="page">Başvurular</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tickets</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Başvuru ID</th>
                        <th>Başvuru gönderen kişinin ID'si</th>
                        <th>Başvuru sebebi</th>
                        <th>Başvuru detayı</th>
                        <th>Başvuru il</th>
                        <th>Başvuru ilçe</th>
                        <th>Başvuru adres</th>
                        <th>Başvuru durum</th>
                        <th></th>
                        <th>Etkileşimler</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $get_ticket_data=$db->query("select * from basvurular");
                      while($ticket_data_write=$get_ticket_data->fetch(PDO::FETCH_ASSOC)){
                      ?>
                      <tr>
                        <td>#<?= kisalt($ticket_data_write["basvuru_id"]); ?></td>
                        <td>#<?= kisalt($ticket_data_write["basvuru_yapan"]); ?></td>
                        <td><?= kisalt($ticket_data_write["basvuru_sebebi"]); ?></td>
                        <td><?= kisalt($ticket_data_write["basvuru_aciklama"]); ?></td>
                        <td><?= kisalt($ticket_data_write["basvuru_sehir"]); ?></td>
                        <td><?= kisalt($ticket_data_write["basvuru_ilce"]); ?></td>
                        <td><?= kisalt($ticket_data_write["basvuru_adres"]); ?></td>
                        
                        <?php switch ($ticket_data_write["basvuru_durum"]) {
                          case 0: ?> <td><span class="badge badge-primary">Başvuruya bakılmadı.</span></td>
                             <?php
                            break;
                          
                          case 1:
                            ?> <td><span class="badge badge-warning">Başvuruya bakıldı, onay veya red beklemekte.</span></td> <?php
                            break;
                          
                          case 2:
                            ?> <td><span class="badge badge-success">Başvuru kabul edildi.</span></td> <?php break; ?>
                          <?php case 3:
                             ?> <td><span class="badge badge-danger">Başvuru red edildi.</span></td> <?php break; } ?>
                        <td><a href="work.php?basvuruonay=<?= $ticket_data_write["basvuru_id"]; ?>" class="btn btn-sm btn-success">Kabul et</a></td>
                        <td><a href="adminbasvuru-detail.php?basvuruid=<?= $ticket_data_write["basvuru_id"]; ?>" class="btn btn-sm btn-primary">Detaylar</a></td>
                        <td><a href="work.php?basvurured=<?= $ticket_data_write["basvuru_id"]; ?>" class="btn btn-sm btn-danger">Reddet</a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
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
              <b>Patikardesligi</a></b>
            </span>
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

</body>

</html>