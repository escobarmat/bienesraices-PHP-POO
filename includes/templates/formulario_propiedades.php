

<fieldset>

<legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input value="<?php echo $propiedad->titulo; ?>" name="titulo" type="text" id="titulo" placeholder="Titulo Propiedad">

            <label for="precio">Precio</label>
            <input value="<?php echo $propiedad->precio; ?>" name="precio" type="number" id="precio" placeholder="Precio Propiedad">

            <label for="imagen">Imagen</label>
            <input name="imagen" type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"><?php echo $propiedad->descripcion; ?></textarea>

        </fieldset>
        <legend>Informacion Propiedad</legend>

        <label for="habitaciones">Habitaciones</label>
        <input value="<?php echo $habitaciones; ?>" name="habitaciones" type="number" id="habitaciones" placeholder="Ej:  3" min="1" max="9">

        <label for="wc">Baños</label>
        <input value="<?php echo $wc; ?>" name="wc" type="number" id="wc" placeholder="Ej:  3" min="1" max="9">

        <label for="estacionamiento">Estacionamiento</label>
        <input value="<?php echo $estacionamiento; ?>" name="estacionamiento" type="number" id="estacionamiento" placeholder="Ej:  3" min="1" max="9">

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedorId">
                <option value="" >--Seleccione--</option>
                <?php while($row = mysqli_fetch_assoc($resultado)):?>
                      <option <?php echo $vendedorId === $row["id"] ?"selected" : ""; ?> value="<?php echo $row["id"];?>"><?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>  
                <?php endwhile; ?>
            </select>
        </fieldset>
