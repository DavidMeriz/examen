//aqui va a estar el codigo de usuarios.model.js

function init(){
    $("#frm_clientes").on("submit", function(e){
        guardaryeditar(e);
    });
}


$().ready(()=>{
    todos();
});

var todos = () =>{
    var html = "";
    $.get("../../Controllers/clientes.controller.php?op=todos", (res) => {
      res = JSON.parse(res);
      $.each(res, (index, valor) => {
       
        html += `<tr>
                <td>${index + 1}</td>
                <td>${valor.Nombre}</td>
                <td>${valor.Apellido}</td>
            <td>
            <button class='btn btn-success' onclick='editar(${
              valor.ID_clientes
            })'>Editar</button>
            <button class='btn btn-danger' onclick='eliminar(${
              valor.ID_clientes
            })'>Eliminar</button>
            <button class='btn btn-info' onclick='ver(${
              valor.ID_clientes
            })'>Ver</button>
            </td></tr>
                `;
      });
      $("#tabla_clientes").html(html);
    });
  };

  var guardaryeditar=(e)=>{
    e.preventDefault();
    var dato = new FormData($("#frm_clientes")[0]);
    var ruta = '';
    var ID_clientes = document.getElementById("ID_clientes").value
    if(ID_clientes > 0){
     ruta = "../../Controllers/clientes.controller.php?op=actualizar"
    }else{
        ruta = "../../Controllers/clientes.controller.php?op=insertar"
    }
    $.ajax({
        url: ruta,
        type: "POST",
        data: dato,
        contentType: false,
        processData: false,
        success: function (res) {
          res = JSON.parse(res);
          if (res == "ok") {
            Swal.fire("clientes", "Registrado con éxito" , "success");
            todos();
            limpia_Cajas();
          } else {
            Swal.fire("clientes", "Error al guardo, intente mas rtarde", "error");
          }
        },
      });
  }

  var editar = (ID_clientes)=>{
    
    $.post(
      "../../Controllers/clientes.controller.php?op=uno",
      { ID_clientes: ID_clientes },
      (res) => {
        res = JSON.parse(res);
        $("#ID_clientes").val(res.ID_clientes);
        $("#Nombre").val(res.Nombre);
        $("#Apellido").val(res.Apellido);
    
      }
    );
    $("#Modal_clientes").modal("show");
  }


  var eliminar = (ID_clientes)=>{
    Swal.fire({
        title: "clientes",
        text: "Esta seguro de eliminar el cliente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.post(
            "../../Controllers/clientes.controller.php?op=eliminar",
            { ID_clientes: ID_clientes },
            (res) => {
              res = JSON.parse(res);
              if (res === "ok") {
                Swal.fire("Paiclientesses", "clientes Eliminado", "success");
                todos();
              } else {
                Swal.fire("Error", res, "error");
              }
            }
          );
        }
      });
  
      impia_Cajas();
}
  
  var limpia_Cajas = ()=>{
    document.getElementById("ID_clientes").value = "";
    document.getElementById("Nombre").value = "";
    document.getElementById("Apellido").value = "";
    $("#Modal_clientes").modal("hide");
  
  }
  init();