<div class="content-wrapper">

    <section class="content-header">
        <h1>Caja</h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Caja</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box ml-4">
            <div class="box-header mb-3">
                <?php
                    $saldoCaja = new UsuarioController();
                    $saldo = $saldoCaja->saldoCaja();
                    if ($saldo == NULL) {
                    } else {
                ?>
                <h3>Saldo en caja: $ <?php echo $saldo; ?></h3>
                <?php } ?>
            </div>
            <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data">
                    <!-- ENTRADA PARA EL ruc -->
                    <div class="form-group">
                        <label for="saldoCaja">Definir saldo de la Caja</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-money"></i></span>
                            <input type="number" class="form-control input-lg " name="saldoCaja" required>
                        </div>
                    </div>

                    <button class="btn btn-primary" data-toggle="modal" data-target="">
                        Definir saldo de la caja
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php
    $definirSaldo = new UsuarioController();
    $definirSaldo->defineSaldoCaja();
?>