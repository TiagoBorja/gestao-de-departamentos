$(document).ready(function () {
  // Salvar Departamento
  $(document).on("submit", "#saveDepartamento", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_departamento", true);

    $.ajax({
      type: "POST",
      url: "../db/departamento/code.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);

        if (resultado.status == 422) {
          $("#errorMessage").removeClass("d-none");
          $("#errorMessage").text(resultado.message);
        } else if (resultado.status == 200) {
          $("#errorMessage").addClass("d-none");
          $("#departamentoAddModal").modal("hide");
          $("#saveDepartamento")[0].reset();
          alertify.success(resultado.message);
          $("#myTable").load(location.href + " #myTable");
        }
      },
    });
  });

  // Visualizar Departamento
  $(document).on("click", ".viewDepartamentoBtn", function (e) {
    var id_departamento = $(this).val();

    $.ajax({
      type: "GET",
      url: "../db/departamento/code.php?id_departamento=" + id_departamento,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);
        if (resultado.status == 404) {
          alert(resultado.message);
        } else if (resultado.status == 200) {
          $("#view_id").text(resultado.data.id);
          $("#view_departamento").text(resultado.data.nome);
          $("#departamentoViewModal").modal("show");
        }
      },
    });
  });

  // Editar Departamento
  $(document).on("click", ".editDepartamentoBtn", function (e) {
    var id_departamento = $(this).val();

    $.ajax({
      type: "GET",
      url: "../db/departamento/code.php?id_departamento=" + id_departamento,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);
        if (resultado.status == 404) {
          alert(resultado.message);
        } else if (resultado.status == 200) {
          $("#edit_id_departamento").val(resultado.data.id);
          $("#edit_nome").val(resultado.data.nome);
          $("#departamentoEditModal").modal("show");
        }
      },
    });
  });

  // Atualizar Departamento
  $(document).on("submit", "#updateDepartamento", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_departamento", true);

    $.ajax({
      type: "POST",
      url: "../db/departamento/code.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);

        if (resultado.status == 422) {
          $("#errorMessageUpdate").removeClass("d-none");
          $("#errorMessageUpdate").text(resultado.message);
        } else if (resultado.status == 200) {
          $("#errorMessageUpdate").addClass("d-none");
          $("#departamentoEditModal").modal("hide");
          $("#updateDepartamento")[0].reset();
          alertify.success(resultado.message);
          $("#myTable").load(location.href + " #myTable");
        }
      },
    });
  });

  // Excluir Departamento
  $(document).on("click", ".deleteDepartamentoBtn", function (e) {
    var id_departamento = $(this).val();

    $.ajax({
      type: "GET",
      url: "../db/departamento/code.php?id_departamento=" + id_departamento,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);
        if (resultado.status == 404) {
          alert(resultado.message);
        } else if (resultado.status == 200) {
          $("#delete_id_departamento").val(resultado.data.id);
          $("#delete_nome").text(resultado.data.nome);
          $("#departamentoDeleteModal").modal("show");
        }
      },
    });
  });

  // Confirmar exclusão do departamento
  $(document).on("submit", "#deleteDepartamento", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("delete_departamento", true);

    $.ajax({
      type: "POST",
      url: "../db/departamento/code.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);

        if (resultado.status == 422) {
          $("#errorMessageUpdate").removeClass("d-none");
          $("#errorMessageUpdate").text(resultado.message);
        } else if (resultado.status == 200) {
          $("#errorMessageUpdate").addClass("d-none");
          $("#departamentoDeleteModal").modal("hide");
          $("#deleteDepartamento")[0].reset();
          alertify.success(resultado.message);
          $("#myTable").load(location.href + " #myTable");
        }
      },
    });
  });

  $(document).ready(function () {
    $("#myTable").DataTable();
  });
});
