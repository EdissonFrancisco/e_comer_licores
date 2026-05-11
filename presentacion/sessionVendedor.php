<?php
$vendedores = new Vendedor($_SESSION["id"]);
$vendedores -> consultar();
?>

<div class="container-fluid fondo-loging">
    <div class="m-0 vh-100 row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                <div class="p-3 mb-2 bg-dark bg-gradient fw-bold text-white text-center">DOMICILIARIO</div>
                <div class="card-group border-none">
                    <div class="card">
                        <img src="img/fondoInicio1.jpg" class="card-img rounded-circle" alt="imagen de vaso" width="304" height="236">
                    </div>
                    <div class="card justify-content-center align-items-center">
                        <ul class="plan-features">
                            <li><i class="ion-checkmark"> </i><span>Nombre: </span> <?php echo $vendedores -> getNombre() ?></li>
                            <li><i class="ion-checkmark"> </i><span>Apellido: </span> <?php echo $vendedores -> getApellido() ?></li>
                            <li><i class="ion-checkmark"> </i><span>Identificacion: </span> <?php echo $vendedores -> getNit_cc() ?></li>
                            <li><i class="ion-checkmark"> </i><span>Direccion: </span> <?php echo $vendedores -> getDireccion() ?></li>
                            <li><i class="ion-checkmark"> </i><span>Correo: </span> <?php echo $vendedores -> getCorreo() ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>