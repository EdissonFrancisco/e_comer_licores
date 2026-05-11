<?php
    $error = 0;
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
    }
?>
<div class="fondoRcuClave">
    <div class="container">
        <div class="m-0 vh-100 row justify-content-center align-items-center">
            <div class="col-md-6">               
                <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">                                    
                    <div class="p-3 mb-2 bg-dark bg-gradient fw-bold text-white text-center">Recuperar Clave</div>
                    <form method="POST" action="<?php echo "index.php?pid=" . base64_encode("presentacion/recuperarClave.php") ?>">
                    	<div class="mb-3">
                             <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="mb-3 d-grid">
                             <button type="submit" class="btn btn-block btn-primary">ENVIAR</button>
                        </div>
                        <div class="col text-center">
							<a href="<?php echo "index.php?pid=" . base64_encode("presentacion/IniciarSession.php") ?>">Iniciar Sesion</a>
						</div>
                    </form>
                    <?php if ($error == 1) { ?>
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    						<strong>Usuario o clave incorrectas</strong>
    						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    					</div>
					<?php } ?>
					<br>
                </div>
            </div>
        </div>
    </div>
</div>

