$(document).ready(function () {
  // hide div when option selected
  $("select[name='tipe']").on("change", function () {
    tipe = $(this).find(":selected").val();
    console.log("ke select " + tipe);
    if (tipe == "Magang") {
      $(
        "#hide_1, #hide_2, #hide_3, #hide_4, #hide_5, #hide_6, .add_button"
      ).fadeOut(500);
    } else {
      $(
        "#hide_1, #hide_2, #hide_3, #hide_4, #hide_5, #hide_6, .add_button"
      ).fadeIn(500);
    }
  });

  $(".add_button").click(function () {
    mhs1 = '<div class="row" id="mhs_del">';
    mhs2 = '<div class="col-sm-6 mb-3">';
    mhs3 = '<label for="nama" class="form-label">Nama Mahasiswa:</label>';
    mhs4 =
      '<input type="text" class="form-control" placeholder="Masukkan nama" name="mhs[]">';
    mhs5 = "</div>";
    mhs6 = '<div class="col mb-3 my-auto remove_button">';
    mhs7 =
      '<button type="button" name="tambahkan" id="tambahkan"class="btn"><i class="bi bi-x-square-fill text-danger"></i></button>';
    mhs8 = "</div>";
    mhs9 = "</div>";
    mhs_add = mhs1 + mhs2 + mhs3 + mhs4 + mhs5 + mhs6 + mhs7 + mhs8 + mhs9;

    $("#input_file").before(mhs_add);

    $(".remove_button").click(function () {
      console.log("remove button");
      $("#mhs_del").remove();
    });

    // syntax mencari nama dengan ajax
    $("input[name='mhs[]']").keyup(function () {
      mhs_nama = $(this).val();
      console.log("nama:" + mhs_nama);

      $.ajax({
        method: "POST",
        url: "data-ajax.php",
        data: {
          p: "mhs",
          nama: mhs_nama,
        },
        dataType: "json",
      })

        .done(function (data) {
          panjang = data.length;
          $("input[name='mhs[]']").autocomplete({
            source: data,
          });
          console.log("data" + panjang);
        })
        .fail(function (msg) {
          console.log("error" + msg);
        });
    });
  });

  $("select[name='pembimbing_1']").on("change", function () {
    pembimbing_1 = $(this).find(":selected").val();
    $("select[name='ketua_penguji']").val(pembimbing_1);
  });
  $("select[name='ketua_penguji']").on("change", function () {
    ketua_penguji = $(this).find(":selected").val();
    $("select[name='pembimbing_1']").val(ketua_penguji);
  });

  // syntax mencari nama dengan ajax
  $("input[name='mhs[]']").keyup(function () {
    mhs_nama = $(this).val();
    console.log("nama:" + mhs_nama);

    $.ajax({
      method: "POST",
      url: "data-ajax.php",
      data: {
        p: "mhs",
        nama: mhs_nama,
      },
      dataType: "json",
    })

      .done(function (data) {
        panjang = data.length;
        $("input[name='mhs[]']").autocomplete({
          source: data,
        });
        console.log("data" + panjang);
      })
      .fail(function (msg) {
        console.log("error" + msg);
      });
  });

  $("#form_pustaka").submit(function (e) {
    e.preventDefault(); // prevent default form submission

    // Get the form data
    var formData = new FormData(this);

    //Make an Ajax Request
    $.ajax({
      url: "data-ajax.php",
      type: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
    })
      .done(function () {
        console.log("oke");
      })
      .fail(function (msg) {
        console.log("error: " + msg);
      });
  });
});
