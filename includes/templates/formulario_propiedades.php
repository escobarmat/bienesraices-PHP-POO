<fieldset>

    <legend>Informacion General</legend>

    <label for="titulo">Titulo</label>
    <input value="<?php echo s($propiedad->titulo); ?>" name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo Propiedad">

    <label for="precio">Precio</label>
    <input value="<?php echo s($propiedad->precio); ?>" name="propiedad[precio]" type="number" id="precio" placeholder="Precio Propiedad">

    <label for="imagen">Imagen</label>
    <input name="propiedad[imagen]" type="file" id="imagen" accept="image/jpeg, image/png">
    <?php if($propiedad->imagen): ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" >
    <?php endif;?>
    <label for="descripcion">Descripcion</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>

</fieldset>
<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input value="<?php echo s($propiedad->habitaciones); ?>" name="propiedad[habitaciones]" type="number" id="habitaciones" placeholder="Ej:  3" min="1" max="9">

    <label for="wc">Baños</label>
    <input value="<?php echo s($propiedad->wc); ?>" name="propiedad[wc]" type="number" id="wc" placeholder="Ej:  3" min="1" max="9">

    <label for="estacionamiento">Estacionamiento</label>
    <input value="<?php echo s($propiedad->estacionamiento); ?>" name="propiedad[estacionamiento]" type="number" id="estacionamiento" placeholder="Ej:  3" min="1" max="9">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="venderoe">Vendedor</label>    
    <select name="propiedad[vendedorId]" id="vendedor">
        <option selected value="">--Seleccionar--</option>
        <?php foreach($vendedores as  $vendedor):?>
            <option 
            <?php echo $propiedad->vendedorId ===$vendedor->id ? "selected" : ""; ?>
            value="<?php echo s($vendedor->id); ?>"><?php echo s( $vendedor->nombre) . " " . s($vendedor->apellido); ?> </option>        
        <?php endforeach;?>    
    </select>
</fieldset>