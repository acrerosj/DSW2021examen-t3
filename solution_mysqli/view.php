<?php include "top.php"; ?>
<section id="view">
    <h2>Contacto</h2>
    <nav>
        <p><a href="index.php">Volver</a></p>
    </nav>
    <?php
    if (!empty($_GET['uid'])) {
        if ($error == null) {
            $stmt = $link->stmt_init();

            $stmt->prepare('SELECT name, surname, tel, email FROM users WHERE id = ?');
            $stmt->bind_param("i", $_GET['uid']);
            $stmt->execute();

            $stmt->bind_result($name, $surname, $tel, $email);
            if ($stmt->fetch() !== true) {
                $error = "¡Usuario no encontrado!";
            }

            $stmt->close();
        }
    } else {
        $error = "¡Identificador de usuario no indicado!";
    }
    if (empty($error)) {
    ?>
        <fieldset>
            <legend>Datos del contacto</legend>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>" readonly>
            <label for="surname">Apellidos</label>
            <input type="text" name="surname" id="surname" value="<?php echo $surname; ?>" readonly>
            <label for="tel">Teléfono</label>
            <input type="tel" name="tel" id="tel" value="<?php echo $tel; ?>" readonly>
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" readonly>
        </fieldset>
    <?php
    } else {
    ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php
    }
    ?>
</section>
<?php include "bottom.php"; ?>