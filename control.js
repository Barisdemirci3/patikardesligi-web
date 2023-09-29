function register() {
  let name = $("#is01").val();
  name = name.trim();
  let username = $("#k01").val();
  username = username.trim();
  let mail = $("#m01").val();
  mail = mail.trim();
  let pass = $("#ps01").val();
  pass = pass.trim();
  let pass2 = $("#ps02").val();
  pass2 = pass2.trim();
  if (name == "" || username == "" || mail == "" || pass == "" || pass2 == "") {
    toastr.info("Boş alanlar doldurulmalıdır!", "Bilgi");
  } else {
    if (pass.length >= 8 && pass2.length >= 8) {
      if (username)
        if (pass == pass2) {
          $.ajax({
            type: "POST",
            url: "check.php",
            data: { username, mail, pass, pass2, name },
            dataType: "JSON",
            success: function (i) {
              if (i.kayit) {
                toastr.success(i.kayit);
              }
              if (i.zaten_kayitli) {
                toastr.error(i.zaten_kayitli, "Hata!");
              }
              if (i.mail_formati) {
                toastr.warning(i.mail_formati);
              }
              if (i.sayi) {
                toastr.error(i.sayi, "Hata!");
              }
            },
          });
        } else {
          toastr.error("Şifreleriniz birbiriyle uyuşmuyor!", "Hata!");
        }
    } else {
      toastr.warning("Şifrenizin uzunluğu en az 8 karakter olmalıdır!");
    }
  }
}
function login() {
  var user = $("#user").val();
  var password = $("#password").val();
  let usertrim = user.trim();
  let passwordtrim = password.trim();
  if (usertrim == "" || passwordtrim == "") {
    toastr.warning("Boş alanları doldurunuz!");
  } else {
    $.ajax({
      type: "POST",
      url: "check.php",
      data: { usertrim, passwordtrim },
      dataType: "JSON",
      success: function (feedback) {
        if (feedback.hata) {
          toastr.error(feedback.hata, "Hata!");
        }
        if (feedback.email) {
          toastr.error(feedback.email, "Hata!");
        }
        if (feedback.yasakli) {
          toastr.error(feedback.yasakli, "Hata!");
        }
        if (feedback.basarili) {
          toastr.success(feedback.basarili, "Başarılı!");
          setTimeout(() => {
            $(location).attr("href", "login.php");
          }, 1500);
        }
      },
    });
  }
}
function addanimal() {
  let animalname = $("#an01").val();
  animalname = animalname.trim();
  let animaltur = $("#sel01").val();
  let animalsubj = $("#subj").val();
  animalsubj = animalsubj.trim();
  let message = $("#message").val();
  message = message.trim();
  let animalyas = $("#yas").val();
  animalyas = animalyas.trim();
  let animalkisir = $("#kisir").val();
  animalkisir = animalkisir.trim();
  if (!$.isNumeric(animalyas)) {
    toastr.error("Yaş kısmında harf veya özel karakter kullanılamaz!", "Hata!");
  }
  if (
    animalname == "" ||
    animaltur == "" ||
    animalsubj == "" ||
    message == "" ||
    animalyas == "" ||
    animalkisir == ""
  ) {
    toastr.warning("Lütfen boş bıraktığınız alanları doldurunuz!");
  } else {
    if (message.length > 256) {
      toastr.error(
        "Açıklama 256 karakterden fazla olamaz! Şu an ki karakter sayısı:" +
          message.length
      );
    } else {
      $.ajax({
        type: "POST",
        url: "check.php",
        data: {
          animalname,
          animaltur,
          animalsubj,
          message,
          animalyas,
          animalkisir,
        },
        dataType: "json",
        success: function (feedback) {
          if (feedback.hata) {
            toastr.error(feedback.hata, "Hata!");
          }
          if (feedback.success_animal) {
            toastr.success(feedback.success_animal, "Başarılı!");
            setTimeout(() => {
              $(location).attr("href", "index.php");
            }, 3000);
          }
          if (feedback.basarili) {
            toastr.success(feedback.basarili, "Başarılı!");
          }
          if (feedback.uyari) {
            toastr.error(feedback.uyari, "Hata!");
          }
        },
      });
    }
  }
}
function ticket_send() {
  let ticket_subj = $("#ticket_subject").val();
  let ticket_message = $("#ticket_message").val();
  ticket_subj = ticket_subj.trim();
  ticket_message = ticket_message.trim();
  let ticket_checkb = $("#ticket_checkbox").prop("checked");
  if (ticket_subj == "" || ticket_message == "" || ticket_checkb == false) {
    alert(
      "Tüm alanları lütfen kontrol ediniz! Boş ve/veya işaretsiz alanları doldurunuz"
    );
  } else {
    $.ajax({
      type: "POST",
      url: "check.php",
      data: { ticket_subj, ticket_message },
      dataType: "JSON",
      success: function (response) {
        if (response.basarili) {
          toastr.success(response.basarili, "Başarılı!");
          setTimeout(() => {
            $(location).attr("href", "index.php");
          }, 3000);
        }
      },
    });
  }
}
function changePassword() {
  let passs = [$("#newpass").val(), $("#newpassagain").val()];
  passs[0] = passs[0].trim();
  passs[1] = passs[1].trim();
  if (passs[0] == "" || passs[1] == "") {
    toastr.error(
      "Şifre değiştirmek için şifre bölümündeki boş alanların doldurulması gerekmekte.",
      "Hata!"
    );
  } else {
    if (passs[0].length < 8 || passs[1].length < 8) {
      toastr.warning(
        "Girdiğiniz şifrelerin 8 karakter üstünde olması gerekmekte.",
        "Uyarı!"
      );
    } else {
      if (passs[0] != passs[1]) {
        toastr.error("Girdiğiniz şifreler aynı değil!", "Hata!");
      } else {
        $.ajax({
          type: "POST",
          url: "check.php",
          data: { newpassagain: passs[1] },
          dataType: "JSON",
          success: function (response) {
            if (response.sifrebasarisiz) {
              toastr.error(response.sifrebasarisiz, "Hata!");
            }

            if (response.sifrebasarili) {
              toastr.success(response.sifrebasarili, "Olumlu!");
            }
            if (response.sifreayni) {
              toastr.warning(response.sifreayni, "Uyarı!");
            }
          },
        });
      }
    }
  }
}
function changeUserProp() {
  let datas = [
    $("#nickname").val().trim(),
    $("#name").val().trim(),
    $("#mail").val().trim(),
  ];
  if (datas[0] == "" || datas[1] == "" || datas[2] == "") {
    toastr.error("Bilgilerinizde lütfen boşluk bırakmayın!", "Hata!");
  } else {
    $.ajax({
      type: "post",
      url: "check.php",
      data: { nickname: datas[0], name: datas[1], mail: datas[2] },
      dataType: "Json",
      success: function (response) {
        if (response.hata) {
          toastr.error(response.hata, "Hata!");
        }
        if (response.basarili) {
          toastr.success(response.basarili, "Başarılı!");
        }
      },
    });
  }
}
function responseticket() {
  let responseticketdata = $("#ticketmessage").val();
  let ticketid = $("#ticket_id").val();
  if (responseticketdata == "") {
    toastr.warning("Yanıt alanını boş bırakamazsınız!", "Uyarı");
  } else {
    $.ajax({
      type: "POST",
      url: "check.php",
      data: { responseticketdata, ticketid },
      dataType: "JSON",
      success: function (feedback) {
        if (feedback.basarili) {
          toastr.success(feedback.basarili, "Başarılı!");
        }
      },
    });
  }
}
function bepatiapp() {
let veriler=[$("#sebep").val().trim(),$("#detay").val().trim(),$("#il").val().trim(),$("#ilce").val().trim(),$("#adres").val().trim()];
    if(veriler[0]=="" || veriler[2]=="" || veriler[3] == "" || veriler[4] == ""){
        toastr.warning("Lütfen boş olan yerleri doldurunuz!", "Uyarı!");
        return false;
    }
    else{
        $.ajax({
            type: "POST",
            url: "check.php",
            data: {sebep:veriler[0],detay:veriler[1],il:veriler[2],ilce:veriler[3],adres:veriler[4]},
            dataType: "JSON",
            success: function (response) {
                if(response.basvuruvar){
                    toastr.error(response.basvuruvar,"Hata!");
                }
                if(response.basvurubasarili){
                  toastr.success(response.basvurubasarili,"Basarili!");
              }
            }
        });
    }

  }
function basvurured() {
  Swal.fire({
    icon: "error",
    title: "Hata",
    text: "Başvurunuz red edildi! Tekrar başvuru açmak için lütfen yöneticiyle iletişime geçip önceki başvurunuzu sildirilmesini iletiniz!",
    confirmButtonText: "Tamam",
    confirmButtonColor: "Green",
    footer: "<a href='contact-us.php'>İletişime Geç!</a>",
    })

}
function basvuruonay() {
  Swal.fire({
    icon: "success",
    title: "Başarılı",
    text: "Başvurunuz kabul edildi! Dostunu ekle sekmesinden veyahut aşağıdaki yönlendirme üzerinden ilan açabilirsin!",
    confirmButtonText: "Tamam",
    confirmButtonColor: "Green",
    footer: "<a href='add-animal.php'>Dostunu eklemek için tıkla!</a>",
    })

}
function addanimalfalse() {
  Swal.fire({
    icon: "error",
    title: "Hata",
    text: "Hayvan eklemek için ilk önce başvuru açmanız gerekmekte! Sistemde başvurunuz görünmüyor. Lütfen alt kısımdan başvuru yapınız.",
    confirmButtonText: "Tamam",
    confirmButtonColor: "Green",
    footer: "<a href='bepati.php'>Başvuru yap!</a>",
    })

}