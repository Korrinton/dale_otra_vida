<?php
/*
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['active_form'] = 'login';
    $_SESSION['login_eror'] = 'Debes iniciar sesión para poner productos en alquiler';
    header('Location: iniciar_sesion.php');
    exit;
}

$user_id = $_SESSION['user_id'];
*/
include_once("header.php");
?>

<link rel="stylesheet" href="./css/iniciar_sesion.css">
<div class="container">
    <form method="POST" action="procesar_alquiler.php" class="form-box active" id="alquiler-form" enctype="multipart/form-data">
        <legend class="titulo">Poner en Alquiler un Producto Electrónico</legend>

        <label for="tipo_aparato">Tipo de aparato *</label>
        <select id="tipo_aparato" name="tipo_aparato" required>
            <option value="">Selecciona...</option>
            <option value="tablet">Tablet</option>
            <option value="movil">Móvil</option>
        </select>

        <label for="marca">Marca *</label>
        <input type="text" id="marca" name="marca" placeholder="Ej: Apple, Samsung, Xiaomi..." required>

        <label for="precio">Precio por día (€) *</label>
        <input type="number" id="precio" name="precio" min="1" placeholder="Ej: 8.99" required>

        <label for="estado_reacondicionado">Estado del producto *</label>
        <select id="estado_reacondicionado" name="estado_reacondicionado" required>
            <option value="">Selecciona estado...</option>
            <option value="malo">Malo</option>
            <option value="bueno">Bueno</option>
            <option value="perfecto">Perfecto</option>
        </select>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="3" placeholder="Detalles, accesorios incluidos, arañazos..."></textarea>

        <label for="foto">Foto del producto</label>
        <input type="file" id="foto" name="foto" accept="image/*">

        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($user_id) ?>">

        <button type="submit" name="publicar_alquiler">Publicar en Alquiler</button>

        <div class="registro">
        </div>
    </form>
</div>
<?php
require_once('footer.php');
?>