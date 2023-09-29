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
$getdata = $db->query("SELECT * FROM ticket where ticket_atan=$member_id");
?>

<div id="contact-page" class="container">
    <div class="row">
        <div class="col-sm-12">

            <table class="table caption-top">
                <h2 class="title text-center">Ticketler</h2>
                <thead>
                    <tr>
                        <th scope="col">Tıcket ID</th>
                        <th scope="col">Ticket Konu</th>
                        <th scope="col">Ticket durum</th>
                        <th scope="col">Ticket oluşturma tarihi</th>
                        <th scope="col">Etkileşimler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($getdata->rowCount() == 0) {
                        echo "Ticketiniz bulunmamaktadır!";
                    }
                    while ($writedata = $getdata->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <th scope="row"><?= $writedata["ticket_id"]; ?></th>
                        <td><?= $writedata["ticket_konu"]; ?></td>
                        <?php switch ($writedata["ticket_durum"]) {
                                case 0:
                            ?> <td><span class="badge" style="background-color: red;">Cevap verilmedi</span></td> <?php
                                                                                                break;

                                                                                            case 1:
                                                                                                ?> <td><span
                                class="badge" style="background-color: #F1C306;">Yönetici cevap verdi, yanıt
                                bekleniyor</span></td>
                        <?php
                                                                                                                            break;
                                                                                                                        case 2: ?> <td><span
                                class="badge" style="background-color: green;">Ticket sonuçlandı</span></td>
                        <?php break; ?><?php
                                                                                                                            break;
                                                                                                                        case 3: ?>
                        <td><span class="badge" style="background-color: #26C9C3;">Geri cevap verildi, yönetici cevabı
                                bekleniyor.</span></td>
                        <?php break;
                                                                                                                    } ?>
                        <td><?= $writedata["ticket_tarih"]; ?></td>
                        <td><a href="ticket-response.php?ticket-id=<?= $writedata["ticket_id"]; ?>"><button
                                    type="button" class="btn btn-info btn-sm" title="Ticket'i incele"><i
                                        class="far fa-edit"></i></button></a></td>
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