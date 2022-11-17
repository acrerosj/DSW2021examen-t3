<?php include "top.php"; ?>
<section id="edit">
    <h2>Editar contacto</h2>
    <nav>
        <p><a href="index.php">Volver</a></p>
    </nav>
    <?php
    if (!empty($_POST)) {
        if ($error == null) {
            $stmt = $link->stmt_init();

            if (!empty($_POST["action"])) {
                if ($_POST["action"] == "update") {
                    $stmt->prepare('UPDATE users SET name = ?, surname = ?, tel = ?, email = ? WHERE id = ?');
                    $stmt->bind_param("ssssi", $_POST['name'], $_POST['surname'], $_POST['tel'], $_POST['email'], $_POST['uid']);
                    if ($stmt->execute() === true) {
                        $updated = true;
                    } else {
                        $error = "¡Los datos no se actualizaron correctamente!</p>";
                    }
                } elseif ($_POST["action"] == "delete") {
                    $stmt->prepare('DELETE FROM users WHERE id = ?');
                    $stmt->bind_param("i", $_POST['uid']);
                    if ($stmt->execute() === true) {
                        $delete = true;
                    } else {
                        $error = "¡No fue posible eliminar al usuario!";
                    }
                }
            }
        }
        $_GET['uid'] = $_POST['uid'];
    }

    if (!empty($_GET['uid'])) {
        if ($error == null && !isset($delete)) {
            $stmt = $link->stmt_init();

            $stmt->prepare('SELECT name, surname, tel, email FROM users WHERE id = ?');
            $stmt->bind_param("i", $_GET['uid']);
            $stmt->execute();

            $stmt->bind_result($name, $surname, $tel, $email);
            if ($stmt->fetch() !== true) {
                $error = "¡Usuario no encontrado!";
            }
        }
    } else {
        $error = "¡Usuario no encontrado!";
    }
    if (empty($error)) {
    ?>
        <?php
        if (isset($delete) && $delete) {
        ?>
            <div class="alert alert-success">¡Usuario eliminado correctamente!</div>
        <?php
        } elseif (isset($updated) && $updated) {
        ?>
            <div class="alert alert-success">¡Datos actualizados correctamente!</div>
        <?php
        } else {
        ?>
            <form action="" method="post" autocomplete="off">
                <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
                <fieldset>
                    <legend>Datos del contacto</legend>
                    <label for="name" class="required">Nombre</label>
                    <input type="text" name="name" id="name" value="<?php echo $name; ?>" required>
                    <label for="surname" class="required">Apellidos</label>
                    <input type="text" name="surname" id="surname" value="<?php echo $surname; ?>" required>
                    <label for="tel">Teléfono</label>
                    <input type="tel" name="tel" id="tel" value="<?php echo $tel; ?>">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                    <p class="required">* Campos obligatorios.</p>
                    <button type="submit" name="action" value="update">Actualizar</button>
                    <button type="submit" name="action" value="delete">Eliminar</button>
                </fieldset>
            </form>
        <?php
        }
    } else {
        ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php
    }
    ?>
</section>
<?php include "bottom.php"; ?>