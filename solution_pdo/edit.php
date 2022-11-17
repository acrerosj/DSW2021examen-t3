<?php include "top.php"; ?>
<section id="edit">
    <h2>Editar contacto</h2>
    <nav>
        <p><a href="index.php">Volver</a></p>
    </nav>
    <?php
    if (!empty($_POST)) {
        if (empty($error)) {
            if (!empty($_POST["action"])) {
                try {
                    if ($_POST["action"] == "update") {
                        $stmt = $link->prepare('UPDATE users SET name = :name, surname = :surname, tel = :tel, email = :email WHERE id = :id');
                        $stmt->bindParam("name", $_POST['name']);
                        $stmt->bindParam("surname", $_POST['surname']);
                        $stmt->bindParam("tel", $_POST['tel']);
                        $stmt->bindParam("email", $_POST['email']);
                        $stmt->bindParam("id", $_POST['uid']);
                        if ($stmt->execute() === true) {
                            $updated = true;
                        } else {
                            $error = "¡Los datos no se actualizaron correctamente!</p>";
                        }
                        $stmt = null;
                    } elseif ($_POST["action"] == "delete") {
                        $stmt = $link->prepare('DELETE FROM users WHERE id = :id');
                        $stmt->bindParam("id", $_POST['uid']);
                        if ($stmt->execute() === true) {
                            $delete = true;
                        } else {
                            $error = "¡No fue posible eliminar al usuario!";
                        }
                        $stmt = null;
                    }
                } catch (PDOException $e) {
                    $error = "¡Error al hacer la sentencia preparada! : " . $e->getMessage();
                }               
            }
        }
        $_GET['uid'] = $_POST['uid'];
    }
    if (!empty($_GET['uid'])) {
        if (empty($error) && !isset($delete)) {
            try {
                $stmt = $link->prepare('SELECT name, surname, tel, email FROM users WHERE id = :id');
                $stmt->bindParam("id", $_GET['uid']);
                $stmt->bindColumn("name", $name);
                $stmt->bindColumn("surname", $surname);
                $stmt->bindColumn("tel", $tel);
                $stmt->bindColumn("email", $email);
                $stmt->execute();
    
                if (!$stmt->fetch()) {
                    $error = "¡Usuario no encontrado!";
                }
                $stmt = null;
            } catch (PDOException $e) {
                $error = "¡Error al hacer la consulta preparada! : " . $e->getMessage();
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