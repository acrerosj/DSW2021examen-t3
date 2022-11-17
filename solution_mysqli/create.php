<?php include "top.php"; ?>
<section id="create">
    <h2>Nuevo contacto</h2>
    <nav>
        <p><a href="index.php">Volver</a></p>
    </nav>
    <?php
    if (!empty($_POST)) {
        if ($error == null) {
            $stmt = $link->stmt_init();

            $stmt->prepare("INSERT INTO users (name, surname, tel, email) VALUES (?, ?, ?, ?)");

            $name = empty($_POST["name"]) ? "" : $_POST["name"];
            $surname = empty($_POST["surname"]) ? "" : $_POST["surname"];
            $tel = empty($_POST["tel"]) ? "" : $_POST["tel"];
            $email = empty($_POST["email"]) ? "" : $_POST["email"];

            if (empty($name)) $error = "¡Nombre de usuario no válido!";
            if (empty($surname)) $error = "¡Apellido/s de usuario no válido/s!";

            if (empty($error)) {
                $stmt->bind_param("ssss", $name, $surname, $tel, $email);
                if ($stmt->execute()) {
                    $created = true;
                } else {
                    $error = "¡El usuario no pudo ser creado!";
                }
            }

            $stmt->close();
        }
        if (!empty($error)) {
    ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php
        } else if (isset($created) && $created) {
        ?>
            <div class="alert alert-success">¡Usuario creado satisfactoriamente!</div>
        <?php
        }
    } else {
        ?>
        <form action="" method="post" autocomplete="off">
            <fieldset>
                <legend>Datos del contacto</legend>
                <label for="name" class="required">Nombre</label>
                <input type="text" name="name" id="name" required>
                <label for="surname" class="required">Apellidos</label>
                <input type="text" name="surname" id="surname" required>
                <label for="tel">Teléfono</label>
                <input type="tel" name="tel" id="tel">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email">
                <p class="required">* Campos obligatorios.</p>
                <input type="reset" value="Limpiar">
                <input type="submit" value="Crear">
            </fieldset>
        </form>
    <?php
    }
    ?>
</section>
<?php include "bottom.php"; ?>