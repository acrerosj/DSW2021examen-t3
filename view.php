<?php include "top.php"; ?>
<section id="view">
    <h2>Contacto</h2>
    <nav>
        <p><a href="index.php">Volver</a></p>
    </nav>
    <fieldset>
        <legend>Datos del contacto</legend>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" readonly>
        <label for="surname">Apellidos</label>
        <input type="text" name="surname" id="surname" readonly>
        <label for="tel">Teléfono</label>
        <input type="tel" name="tel" id="tel" readonly>
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" readonly>
    </fieldset>
</section>
<?php include "bottom.php"; ?>