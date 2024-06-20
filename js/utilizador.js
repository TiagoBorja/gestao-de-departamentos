$(document).on("submit", "#saveUtilizador", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("save_utilizador", true);

  $.ajax({
    type: "POST",
    url: "./utilizador/code.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var resultado = jQuery.parseJSON(response);
      if (resultado.status == 422) {
        $("#errorMessage").removeClass("d-none").text(resultado.message);
      } else if (resultado.status == 200) {
        $("#errorMessage").addClass("d-none");
        alertify.success(resultado.message);
        $("#utilizadorAddModal").modal("hide");
        $("#saveUtilizador")[0].reset();
        $("#myTable").load(location.href + " #myTable");
      }
    },
  });
});

$(document).on("click", ".editUtilizadorBtn", function () {
  var id_utilizador = $(this).val();

  $.ajax({
    type: "GET",
    url: "./utilizador/code.php?id_utilizador=" + id_utilizador,
    success: function (response) {
      var resultado = jQuery.parseJSON(response);
      if (resultado.status == 200) {
        $("#id_utilizador").val(resultado.data.id);
        $("#nome").val(resultado.data.nome);
        $("#username").val(resultado.data.username);
        $("#tipo").val(resultado.data.tipo);
        $("#utilizadorEditModal").modal("show");
      } else {
        alert(resultado.message);
      }
    },
  });
});

$(document).on("submit", "#updateUtilizador", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("update_utilizador", true);

  $.ajax({
    type: "POST",
    url: "./utilizador/code.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var resultado = jQuery.parseJSON(response);
      if (resultado.status == 422) {
        $("#errorMessageUpdate").removeClass("d-none").text(resultado.message);
      } else if (resultado.status == 200) {
        $("#errorMessageUpdate").addClass("d-none");
        alertify.success(resultado.message);
        $("#utilizadorEditModal").modal("hide");
        $("#updateUtilizador")[0].reset();
        $("#myTable").load(location.href + " #myTable");
      }
    },
  });
});

$(document).on("click", ".viewUtilizadorBtn", function () {
  var id_utilizador = $(this).val();

  $.ajax({
    type: "GET",
    url: "./utilizador/code.php?id_utilizador=" + id_utilizador,
    success: function (response) {
      var resultado = jQuery.parseJSON(response);
      if (resultado.status == 200) {
        $("#view_nome").text(resultado.data.nome);
        $("#view_username").text(resultado.data.username);
        $("#view_tipo").text(resultado.data.tipo);
        $("#utilizadorViewModal").modal("show");
      } else {
        alert(resultado.message);
      }
    },
  });
});

$(document).on("click", ".deleteUtilizadorBtn", function () {
  var id_utilizador = $(this).val();

  $.ajax({
    type: "GET",
    url: "./utilizador/code.php?id_utilizador=" + id_utilizador,
    success: function (response) {
      var resultado = jQuery.parseJSON(response);
      if (resultado.status == 200) {
        $("#delete_id_utilizador").val(resultado.data.id);
        $("#delete_nome").text(resultado.data.nome);
        $("#delete_username").text(resultado.data.username);
        $("#delete_tipo").text(resultado.data.tipo);
        $("#utilizadorDeleteModal").modal("show");
      } else {
        alert(resultado.message);
      }
    },
  });
});

$(document).on("submit", "#deleteUtilizador", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("delete_utilizador", true);

  $.ajax({
    type: "POST",
    url: "./utilizador/code.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var resultado = jQuery.parseJSON(response);
      if (resultado.status == 422) {
        $("#errorMessageDelete").removeClass("d-none").text(resultado.message);
      } else if (resultado.status == 200) {
        $("#errorMessageDelete").addClass("d-none");
        alertify.success(resultado.message);
        $("#utilizadorDeleteModal").modal("hide");
        $("#deleteUtilizador")[0].reset();
        $("#myTable").load(location.href + " #myTable");
      }
    },
  });
});

$(document).ready(function () {
  $("#myTable").DataTable();
});
