<fieldset>

    <legend>Informacion General</legend>

    <label for="nombre">Nombre</label>
    <input value="<?php echo s($vendedor->nombre); ?>" name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre Vendedor/a">

    <label for="apellido">Apellido</label>
    <input value="<?php echo s($vendedor->apellido); ?>" name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido Vendedor/a">

</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>

    <label for="telefono">Teléfono</label>
    <input value="<?php echo s($vendedor->telefono); ?>" name="vendedor[telefono]" type="text" id="telefono" placeholder="Telefono Vendedor/a">

    <label for="imagen">Imagen</label>
    <input name="vendedor[imagen]" type="file" id="imagen" accept="image/jpeg, image/png">
    <?php if($vendedor->imagen): ?>
        <img src="/vendedores/<?php echo $vendedor->imagen ?>" class="imagen-small" >
    <?php endif;?>
</fieldset>