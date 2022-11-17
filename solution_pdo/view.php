<?php include "top.php"; ?>
<section id="view">
    <h2>Contacto</h2>
    <nav>
        <p><a href="index.php">Volver</a></p>
    </nav>
    <?php
    if (!empty($_GET['uid'])) {
        if (empty($error)) {
            $stmt = $link->prepare('SELECT name, surname, tel, email FROM users WHERE id = :id');
            $stmt->bindParam('id', $_GET['uid']);
            $stmt->execute();

            $result = $stmt->fetchAll();
            if (count($result) == 0) {
                $error = "¡Usuario no encontrado!";
            } else {            
                $name = $result[0]['name'];
                $surname = $result[0]['surname'];
                $tel = $result[0]['tel'];
                $email = $result[0]['email'];
            }

            $stmt = null;
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