function init() {
  $("#frm_reservas").on("submit", function (e) {
    guardaryeditar(e);
  });
}

$().ready(() => {
  todos();
});

var cargaHoteles = () => {
  return new Promise((resolve, reject) => {
    $.post("../../Controllers/hoteles.controller.php?op=todos", (res) => {
      res = JSON.parse(res);
      var html = "";
      $.each(res, (index, val) => {
        html += `<option value="${val.ID_hotel}">${val.Nombre}</option>`;
      });
      $("#ID_hotel").html(html);
      resolve();
    }).fail((error) => {
      reject(error);
    });
  });
};

var todos = () => {
  var html = "";
  $.get("../../Controllers/reservas.controller.php?op=todos", (res) => {
    res = JSON.parse(res);
    $.each(res, (index, valor) => {
      html += `<tr>
              <td>${index + 1}</td>
              <td>${valor.Hotel}</td>
              <td>${valor.Fecha_entrada}</td>
              <td>${valor.Fecha_salida}</td>
              <td>
                <button class='btn btn-success' onclick='editar(${valor.ID_reserva})'>Editar</button>
                <button class='btn btn-danger' onclick='eliminar(${valor.ID_reserva})'>Eliminar</button>
                <button class='btn btn-info' onclick='ver(${valor.ID_reserva})'>Ver</button>
              </td>
          </tr>`;
    });
    $("#tabla_reservas").html(html);
  });
};

var guardaryeditar = (e) => {
  e.preventDefault();
  var dato = new FormData($("#frm_reservas")[0]);
  var ruta = '';
  var ID_reserva = document.getElementById("ID_reserva").value;
  if (ID_reserva > 0) {
    ruta = "../../Controllers/reservas.controller.php?op=actualizar";
  } else {
    ruta = "../../Controllers/reservas.controller.php?op=insertar";
  }

  $.ajax({
    url: ruta,
    type: "POST",
    data: dato,
    contentType: false,
    processData: false,
    success: function (res) {
      console.log(res);
      res = JSON.parse(res);
      if (res == "ok") {
        Swal.fire("Reserva", "Reserva Guardada", "success");
        todos();
        limpia_Cajas();
      } else {
        Swal.fire("Reserva", "Reserva no Guardada", "error");
      }
    },
  });
};

var editar = (ID_reserva) => {
  cargaHoteles();
  $.post(
    "../../Controllers/reservas.controller.php?op=uno",
    { ID_reserva: ID_reserva },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#ID_reserva").val(res.ID_reserva);
      $("#ID_hotel").val(res.ID_hotel);
      $("#Fecha_entrada").val(res.Fecha_entrada);
      $("#Fecha_salida").val(res.Fecha_salida);
    }
  );
  $("#Modal_reservas").modal("show");
};

var eliminar = (ID_reserva) => {
  Swal.fire({
    title: "Reserva",
    text: "¿Está seguro de eliminar la reserva?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../Controllers/reservas.controller.php?op=eliminar",
        { ID_reserva: ID_reserva },
        (res) => {
          res = JSON.parse(res);
          if (res === "ok") {
            Swal.fire("Reserva", "Reserva Eliminada", "success");
            todos();
          } else {
            Swal.fire("Error", res, "error");
          }
        }
      );
    }
  });
  limpia_Cajas();
};
var limpia_Cajas = () => {
  document.getElementById("ID_reserva").value = "";
  document.getElementById("ID_hotel").value = "";
  document.getElementById("Fecha_entrada").value = "";
  document.getElementById("Fecha_salida").value = "";
  $("#Modal_reservas").modal("hide");
};

init();
