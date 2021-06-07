<div class="login">
    <div class="form">
        <h3>Grifo XXX</h3>
        <form method="POST">
            <div class="section-login">
                <h1>Iniciar sesión</h1>
                <div class="email">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" placeholder="Ingrese usuario" name="ingUsuario" />
                </div>
                <div class="password">
                    <ion-icon name="eye-outline"></ion-icon>
                    <input type="password" placeholder="Contraseña" name="ingPassword" />
                </div>
                <button>Iniciar sesión</button>
            </div>
            <?php
                $login = new UsuarioController();
                $login->IngresoUsuario();
            ?>
        </form>
    </div>
    <div class="image-login">
        <img src="views/dist/img/undraw_coffee_break_h3uu.svg" alt="" srcset="" />
        <div class="circle"></div>
        <h1>Grifo XXX</h1>
        <p>Seguridad. confianza y buen servicio</p>
    </div>
</div>