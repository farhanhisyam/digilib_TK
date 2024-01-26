$("input[name='mhs[]']").keyup(function () {
  mhs_nama = $(this).val();
  console.log("nama: " + mhs_nama);

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
    })
    .fail(function (msg) {
      console.log("error: " + msg);
    });
});
