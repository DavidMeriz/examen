//aqui va a estar el codigo de usuarios.model.js

function init(){
    $("#frm_hoteles").on("submit", function(e){
        guardaryeditar(e);
    });
}


$().ready(()=>{
    todos();
});

var todos = () =>{
    var html = "";
    $.get("../../Controllers/hoteles.controller.php?op=todos", (res) => {
      
      
      res = JSON.parse(res);
      $.each(res, (index, valor) => {
       
        html += `<tr>
                <td>${index + 1}</td>
                <td>${valor.Nombre}</td>
                <td>${valor.Ciudad}</td>
                <td>${valor.Estrellas}</td>

            <td>
            <button class='btn btn-success' onclick='editar(${
              valor.ID_hotel
            })'>Editar</button>
            <button class='btn btn-danger' onclick='eliminar(${
              valor.ID_hotel
            })'>Eliminar</button>
            <button class='btn btn-info' onclick='ver(${
              valor.ID_hotel
            })'>Ver</button>
            </td></tr>
                `;
      });
      $("#tabla_hoteles").html(html);
    });
  };
  
  var guardaryeditar=(e)=>{
    e.preventDefault();
    var dato = new FormData($("#frm_hoteles")[0]);
    var ruta = '';
    var ID_hotel = document.getElementById("ID_hotel").value
    if(ID_hotel > 0){
     ruta = "../../Controllers/hoteles.controller.php?op=actualizar"
    }else{
        ruta = "../../Controllers/hoteles.controller.php?op=insertar"
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
            Swal.fire("HOTELES", "Registrado con éxito" , "success");
            todos();
            limpia_Cajas();
          } else {
            Swal.fire("HOTELES", "Error al guardo, intente mas tarde", "error");
          }
        },
      });
  }

  var editar = (ID_hotel)=>{
  
    $.post(
      "../../Controllers/hoteles.controller.php?op=uno",
      { ID_hotel: ID_hotel },
      (res) => {
        res = JSON.parse(res);
        console.log(res);
        $("#ID_hotel").val(res.ID_hotel);
        $("#Nombre").val(res.Nombre);
        $("#Ciudad").val(res.Ciudad);
        $("#Estrellas").val(res.Estrellas);
    
      }
    );
    $("#Modal_hoteles").modal("show");
  }


  var eliminar = (ID_hotel)=>{
    Swal.fire({
        title: "hoteles",
        text: "Esta seguro de eliminar el HOTELES",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.post(
            "../../Controllers/hoteles.controller.php?op=eliminar",
            { ID_hotel: ID_hotel },
            (res) => {
              res = JSON.parse(res);
              if (res === "ok") {
                Swal.fire("HOTELES", "HOTELES Eliminado", "success");
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
    document.getElementById("ID_hotel").value = "";
    document.getElementById("Nombre").value = "";
    document.getElementById("Ciudad").value = "";
    document.getElementById("Estrellas").value = "";
    $("#Modal_hoteles").modal("hide");
  
  }
  init();
