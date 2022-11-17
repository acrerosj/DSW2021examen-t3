<!-- CREATE TABLE `ut3`.`users` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `surname` VARCHAR(50) NOT NULL , `tel` VARCHAR(30) NULL , `email` VARCHAR(80) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->

<?php include "top.php"; ?>
    <!--
    <div class="alert alert-success">¡Ejemplo mensaje de éxito!</div>
    <div class="alert alert-error">¡Ejemplo mensaje de error!</div>
    -->
<?php
   if (empty($error)) {  
?>
    <section id="contacts">
        <h2>Contactos</h2>
        <nav>
            <fieldset>
                <legend>Acciones</legend>                    
                <a href="create.php">
                    <button>Crear contacto</button>
                </a>                    
            </fieldset>
        </nav>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php                
                    $stmt = $link->prepare('SELECT * FROM users ORDER BY name ASC');
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                
                    if (count($result)>0) {                            
                        $letter = null;
                        foreach ($result as $contact) {
                            $firstletter = strtoupper(substr($contact['name'], 0, 1));
            ?>
                        <tr>
                            <td class="symbol"><?php echo $letter != $firstletter ? $firstletter : ""; ?></td>
                            <td class="name"><?php echo $contact['name'];?></td>
                            <td class="surname"><?php echo $contact['surname'];?></td>
                            <td class="actions">                            
                                <a class="button" href="view.php?uid=<?php echo $contact['id'];?>">
                                    <button>Ver</button>
                                </a>
                                <a class="button" href="edit.php?uid=<?php echo $contact['id'];?>">
                                    <button>Editar</button>
                                </a>               
                            </td>
                        </tr>
            <?php
                            $letter = $firstletter;
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="4">No hay contactos en la agenda.</td>
                        </tr>
                <?php
                }  
                $stmt = null;
            } else {                                        
                printf("<div class=\"alert alert-error\">%s</div>", $error);
            }
        ?>
                
            </tbody>
        </table>
    </section>
<?php include "bottom.php"; ?>