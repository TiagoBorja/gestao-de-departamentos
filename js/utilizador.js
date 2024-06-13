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
                $("#errorMessage").removeClass("d-none");
                $("#errorMessage").text(resultado.message);
            } else if (resultado.status == 200) {
                $("#errorMessage").addClass("d-none");
                $("#utilizadorAddModal").modal("hide");
                $("#saveUtilizador")[0].reset();
                alertify.success(resultado.message);
                $("#myTable").load(location.href + " #myTable");
            } else if (resultado.status == 500) {
                alertify.error(resultado.message);
            }
        },
    });
});

  $(document).on("click", ".editFuncionarioBtn", function (e) {
    var id_funcionario = $(this).val();
  
    $.ajax({
      type: "GET",
      url: "./funcionario/code.php?id_funcionario=" + id_funcionario,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);
        if (resultado.status == 404) {
          alert(resultado.message);
        } else if (resultado.status == 200) {
          $("#id_funcionario").val(resultado.data.id);
          $("#nome").val(resultado.data.nome);
          $("#email").val(resultado.data.email);
          $("#data_nascimento").val(resultado.data.data_nascimento);
          $("#morada").val(resultado.data.morada);
          $("#departamento").val(resultado.data.departamento);
          alertify.success(resultado.message);
          $("#funcionarioEditModal").modal("show");
        }
      },
    });
  });
  
  $(document).on("submit", "#updateFuncionario", function (e) {
    e.preventDefault();
  
    //Cria um objeto formdata com os dados do formulario.
    var formData = new FormData(this);
  
    //Acrescenta aos dados do formulário o parâmetro como true.
    formData.append("update_funcionario", true);
    $.ajax({
      type: "POST",
      url: "./funcionario/code.php",
      data: formData,
      processData: false,
      contentType: false,
  
      //Em caso de sucesso, recebe em 'response' os dodos devolvidos pelo servidor.
      success: function (response) {
        var resultado = jQuery.parseJSON(response);
  
        if (resultado.status == 422) {
          $("#errorMessageUpdate").removeClass("d-none");
          $("#errorMessageUpdate").text(resultado.message);
        } else if (resultado.status == 200) {
          $("#errorMessageUpdate").addClass("d-none");
          $("#funcionarioEditModal").modal("hide");
          $("#updateFuncionario")[0].reset();
          alertify.success(resultado.message);
  
          $("#myTable").load(location.href + " #myTable");
        }
      },
    });
  });
  
  $(document).on("click", ".viewFuncionarioBtn", function (e) {
    var id_funcionario = $(this).val();
    $.ajax({
      type: "GET",
      url: "./funcionario/code.php?id_funcionario=" + id_funcionario,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);
        if (resultado.status == 404) {
          alert(resultado.message);
        } else if (resultado.status == 200) {
          $("#view_nome").text(resultado.data.nome);
          $("#view_email").text(resultado.data.email);
          $("#view_data_nascimento").text(resultado.data.data_nascimento);
          $("#view_morada").text(resultado.data.morada);
          $("#view_departamento").text(resultado.data.departamento);
  
          // alertify.success(resultado.message);
          $("#funcionarioViewModal").modal("show");
        }
      },
    });
  });
  
  $(document).on("click", ".deleteFuncionarioBtn", function (e) {
    var id_funcionario = $(this).val();
  
    $.ajax({
      type: "GET",
      url: "./funcionario/code.php?id_funcionario=" + id_funcionario,
      success: function (response) {
        var resultado = jQuery.parseJSON(response);
        if (resultado.status == 404) {
          alert(resultado.message);
        } else if (resultado.status == 200) {
          $("#funcionarioDeleteModal #id_funcionario").val(resultado.data.id);
          $("#delete_nome").text(resultado.data.nome);
          $("#delete_email").text(resultado.data.email);
          $("#delete_data_nascimento").text(resultado.data.data_nascimento);
          $("#delete_morada").text(resultado.data.morada);
          $("#delete_departamento").text(resultado.data.departamento);
  
          // alertify.success(resultado.message);
          $("#funcionarioDeleteModal").modal("show");
        }
      },
    });
  });
  
  $(document).on("submit", "#deleteFuncionario", function (e) {
    e.preventDefault();
  
    //Cria um objeto formdata com os dados do formulario.
    var formData = new FormData(this);
  
    //Acrescenta aos dados do formulário o parâmetro como true.
    formData.append("delete_funcionario", true);
    $.ajax({
      type: "POST",
      url: "./funcionario/code.php",
      data: formData,
      processData: false,
      contentType: false,
  
      //Em caso de sucesso, recebe em 'response' os dodos devolvidos pelo servidor.
      success: function (response) {
        var resultado = jQuery.parseJSON(response);
  
        if (resultado.status == 422) {
          $("#errorMessageUpdate").removeClass("d-none");
          $("#errorMessageUpdate").text(resultado.message);
        } else if (resultado.status == 200) {
          $("#errorMessageUpdate").addClass("d-none");
          $("#funcionarioDeleteModal").modal("hide");
          $("#deleteFuncionario")[0].reset();
          alertify.success(resultado.message);
  
          $("#myTable").load(location.href + " #myTable");
        }
      },
    });
  });
  
  $(document).ready(function () {
    $("#myTable").DataTable();
  });
  