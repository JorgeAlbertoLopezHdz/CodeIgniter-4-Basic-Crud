$(document).ready(function () {
  getUsers();

  $(".datepicker").datepicker({
    language: "es",
    autoclose: true,
  });

  $("#users-form").validate({
    language: "es",
    rules: {
      name: {
        required: true,
        minlength: 4,
        maxlength: 50,
      },
      email: {
        required: true,
        minlength: 4,
        maxlength: 100,
      },
      birthDate: {
        required: true,
      },
      roleId: {
        required: true,
      },
    },
    submitHandler: function (form) {
      $("#id").val() == null || $("#id").val() == ""
        ? createUser()
        : updateUser();
    },
  });
});

function getUsers() {
  $.ajax({
    type: "GET",
    url: "users",
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $("#users-list").empty();

        return response.data.map((user) => {
          $("#users-list").append(
            $("<tr>", { id: user.id }).append(
              $("<td>", { text: user.name }),
              $("<td>", { text: user.email }),
              $("<td>", {
                text: moment(user.birth_date, "YYYY-MM-DD").format(
                  "DD/MM/YYYY"
                ),
              }),
              $("<td>", { text: user.role_name }),
              $("<td>", { text: user.status == 1 ? "Activo" : "Inactivo" }),
              $("<td>").append(
                $("<a>", {
                  click: () => readUser(user.id),
                  href: "javascript:void(0);",
                  class: "btn btn-warning btn-sm action-btn deleteRecord",
                  text: "Editar",
                }),
                $("<a>", {
                  click: () => removeUser(user.id),
                  href: "javascript:void(0);",
                  class: "btn btn-danger btn-sm action-btn deleteRecord",
                  text: "Borrar",
                })
              )
            )
          );
        });
      }

      return alert(response.message);
    },
    error: function (jqXHR, exception) {
      alert(jqXHR.responseJSON.message);
    },
  });
}

function createUser() {
  const user = {
    name: $("#name").val(),
    email: $("#email").val(),
    birthDate: $("#birthDate").val(),
    roleId: $("#roleId").val(),
    status: $("#status").prop("checked") == true ? 1 : 0,
  };

  $.ajax({
    url: "users",
    method: "POST",
    data: user,
    dataType: "json",
    success: function (response) {
      if (response.success) {
        getUsers();
        $("#form-modal").modal("hide");

        $("#id").val("");
        $("#name").val("");
        $("#email").val("");
        $("#birthDate").val("");
        $("#roleId").val("");
        $("#status").prop("checked", false);
      }
    },
    error: function (jqXHR, exception) {
      if (jqXHR.status == 400) {
        alert(
          "Ocurrió uno o más errores de validación, revisa en consola los detalles"
        );
        console.error(
          "Ocurrieron los siguientes errores",
          jqXHR.responseJSON.message
        );

        return;
      }

      alert(jqXHR.responseJSON.message);
    },
  });
}

function readUser(id) {
  $.ajax({
    type: "GET",
    url: "users/" + id,
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $("#form-modal-title").text("Editar usuario");

        var validator = $("#users-form").validate();
        validator.resetForm();

        const user = response.data;

        $("#id").val(user.id);
        $("#name").val(user.name);
        $("#email").val(user.email);
        $("#birthDate").val(
          moment(user.birth_date, "YYYY-MM-DD").format("DD/MM/YYYY")
        );
        $("#roleId").val(user.role_id);
        $("#status").prop("checked", user.status === "1" ? true : false);

        $("#form-modal").modal("show");

        return;
      }
    },
    error: function (jqXHR, exception) {
      alert(jqXHR.responseJSON.message);
    },
  });
}

function updateUser() {
  const user = {
    name: $("#name").val(),
    email: $("#email").val(),
    birthDate: $("#birthDate").val(),
    roleId: $("#roleId").val(),
    status: $("#status").prop("checked") == true ? 1 : 0,
  };

  $.ajax({
    url: "users/" + $("#id").val(),
    method: "PUT",
    data: user,
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $("#id").val("");

        getUsers();
        $("#form-modal").modal("hide");

        return;
      }
    },
    error: function (jqXHR, exception) {
      if (jqXHR.status == 400) {
        alert(
          "Ocurrió uno o más errores de validación, revisa en consola los detalles"
        );
        console.error(
          "Ocurrieron los siguientes errores",
          jqXHR.responseJSON.message
        );

        return;
      }

      alert(jqXHR.responseJSON.message);
    },
  });
}

function removeUser(id) {
  $("#remove-user-id").val(id);
  $("#remove-modal").modal("show");
}

function deleteUser() {
  $.ajax({
    type: "DELETE",
    url: "users/" + $("#remove-user-id").val(),
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $("#remove-user-id").val("");

        getUsers();
        $("#remove-modal").modal("hide");

        return;
      }
    },
    error: function (jqXHR, exception) {
      alert(jqXHR.responseJSON.message);
    },
  });
}

function showCreateUserModal() {
  $("#form-modal-title").text("Nuevo usuario");

  var validator = $("#users-form").validate();
  validator.resetForm();

  $("#id").val("");
  $("#name").val("");
  $("#email").val("");
  $("#birthDate").val("");
  $("#roleId").val("");
  $("#status").prop("unchecked");
  $("#form-modal").modal("show");
}
