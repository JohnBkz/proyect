<div class="content-wrapper">

    <section class="content-header">
        <h1>Dashboard<small>Panel de Control</small></h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title">Definir Descuento del Día</h2>
                <?php
                if ($_SESSION['descuento'] == NULL) {
                } else {
                ?>
                <h4>Descuento: <?php echo $_SESSION['descuento']; ?> %</h4>
                <?php
                }
                ?>
            </div>
            <div class="box-body">
                <form role="form" method="post">
                    <!-- DEFINIR DESCUENTO -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-money"></i></span>
                            <input type="number" class="form-control" name="descuento" required>
                        </div>
                    </div>

                    <button class="btn btn-primary">
                        Guardar Saldo
                    </button>
                </form>
                <?php
                    $descuento = new UsuarioController();
                    $descuento->defineDescuento();
                ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->