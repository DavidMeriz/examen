<?php require_once('../html/head2.php') ?>

<div class="row">

    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Lista de reservas</h5>

                <div class="table-responsive">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal_reservas">
                        Nueva reserva
                    </button>
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">#</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nombre del hotel</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nombre del cliente</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Fecha de entrada</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Fecha de salida</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Opciones</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tabla_reservas">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ventana Modal-->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="Modal_reservas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frm_reservas">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="ID_reserva  " id="ID_reserva  ">
                    

                    <div class="form-group">
                        <label for="ID_hotel">Hotel</label>
                      <select name="ID_hotel" id="ID_hotel" class="form-control">
                        <option value="0">Seleccione un Hotel</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="ID_cliente ">Cliente</label>
                      <select name="ID_cliente " id="ID_cliente " class="form-control">
                        <option value="0">Seleccione un Cliente</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="ciudad">fecha de entrada</label>
                        <input type="date" required class="form-control" id="ciudad" name="ciudad" placeholder="Ingrese el nombre de la ciudad">
                    </div>
                    <div class="form-group">
                        <label for="estrellas">fecha de salida</label>
                        <input type="date" required class="form-control" id="estrellas" name="estrellas" placeholder="Cantidad de estrellas">
                    </div>
                   

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../html/script2.php') ?>

<script src="reservas.js"></script>