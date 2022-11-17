<?php include "top.php"; ?>
<section id="create">
    <h2>Nuevo contacto</h2>
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
            <input type="tel" name="tel" id="tel">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email">
            <input type="reset" value="Limpiar">
            <input type="submit" value="Crear">
        </fieldset>
    </form>
</section>
<?php include "bottom.php"; ?>