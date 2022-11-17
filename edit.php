<?php include "top.php"; ?>
<section id="edit">
    <h2>Editar contacto</h2>
    <nav>
        <p><a href="index.php">Volver</a></p>
    </nav>
    <form action="" autocomplete="off">
        <fieldset>
            <legend>Datos del contacto</legend>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" required>
            <label for="surname">Apellidos</label>
            <input type="text" name="surname" id="surname" required>
            <label for="tel">Teléfono</label>
            <input type="tel" name="tel" id="tel" required>
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" required>
            <button type="submit" name="action" value="update">Actualizar</button>
            <button type="submit" name="action" value="delete">Eliminar</button>
        </fieldset>
    </form>
</section>
<?php include "bottom.php"; ?>