<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
if (!$_SESSION["uye_nick"]) {
    header("Location:index.php");
}
//Üye idsi
$member_id = $_SESSION["id"];
//Get ticket data
$getdata = $db->query("SELECT * FROM basvurular where basvuru_yapan=$member_id");
?>

<div id="contact-page" class="container">
    <div class="row">
        <div class="col-sm-12">

            <table class="table caption-top">
                <h2 class="title text-center">Başvurular</h2>
                <thead>
                    <tr>
                        <th scope="col">Başvuru ID</th>
                        <th scope="col">Başvuru Sebebi</th>
                        <th scope="col">Başvuru Açıklama</th>
                        <th scope="col">Başvuru İl</th>
                        <th scope="col">Başvuru İlçe</th>
                        <th scope="col">Başvuru Adres</th>
                        <th scope="col">Başvuru Durum</th>
                        <th scope="col">Başvuru İşlemleri</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($getdata->rowCount() == 0) {
                        echo "Ticketiniz bulunmamaktadır!";
                    }
                    while ($writedata = $getdata->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <th scope="row"><?= $writedata["basvuru_id"]; ?></th>
                            <td><?= kisalt($writedata["basvuru_sebebi"]); ?></td>
                            <td><?= kisalt($writedata["basvuru_aciklama"]) ?></td>
                            <td><?= kisalt($writedata["basvuru_sehir"]); ?></td>
                            <td><?= kisalt($writedata["basvuru_ilce"]); ?></td>
                            <td><?= kisalt($writedata["basvuru_adres"]); ?></td>
                            <?php switch ($writedata["basvuru_durum"]) {
                                case 0:
                                    echo '<td><span class="badge" style="background-color: #26C9C3;">Başvuru yapıldı.</span></td>';
                                    break;
                                case 1:
                                    echo '<td><span class="badge" style="background-color: #FF3600;">Başvuru inceleniyor.</span></td>';
                                    break;
                                case 2:
                                    echo '<td><span class="badge" style="background-color: green;">Başvuru onaylandı.</span></td>';
                                    break;
                                    case 3:
                                        echo '<td><span class="badge" style="background-color: red;">Başvuru red edildi.</span></td>';
                                        break;
                            } ?>
                            <?php if ($writedata["basvuru_durum"] == 2 || $writedata["basvuru_durum"]==3) {
                                echo '<td><a href="" title="Detay" class="btn btn-primary">Bilgi Al</a></td>';
                            } else {
                                echo "<td>Başvuru sonuçlanmadı!</td>";
                            } ?>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>


    </div>
</div>
</div>
<?php include "footer.php"; ?>
</body>

</html>