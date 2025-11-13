<?php
session_start();
include_once("header.php");

// Si no está logueado, redirigir al login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['active_form'] = 'login';
    $_SESSION['login_eror'] = 'Debes iniciar sesión para poner productos en alquiler';
    header('Location: iniciar_sesion.php');
    exit;
}

$user_id = $_SESSION['user_id'];
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

        <label for="modelo">Modelo (opcional)</label>
        <input type="text" id="modelo" name="modelo" placeholder="Ej: iPhone 14 Pro, Galaxy Tab S9">

        <label for="precio">Precio por día (€) *</label>
        <input type="number" id="precio" name="precio" min="1" step="0.50" placeholder="Ej: 8.99" required>

        <label for="estado_reacondicionado">Estado del producto *</label>
        <select id="estado_reacondicionado" name="estado_reacondicionado" required>
            <option value="">Selecciona estado...</option>
            <option value="malo">Malo (visible desgaste)</option>
            <option value="bueno">Bueno</option>
            <option value="perfecto">Perfecto (como nuevo)</option>
        </select>

        <label for="descripcion">Descripción (opcional)</label>
        <textarea id="descripcion" name="descripcion" rows="3" placeholder="Detalles, accesorios incluidos, arañazos..."></textarea>

        <label for="foto">Foto del producto (máx 2MB)</label>
        <input type="file" id="foto" name="foto" accept="image/*">

        <!-- Campo oculto con el id del usuario logueado -->
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($user_id) ?>">

        <button type="submit" name="publicar_alquiler">Publicar en Alquiler</button>

        <div class="registro">
            <p><a href="mis_productos.php">← Volver a mis productos</a></p>
        </div>
    </form>
</div>

<script>
// Opcional: vista previa de la foto
document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('La imagen no puede superar los 2MB');
            e.target.value = '';
            return;
        }
        const imgPreview = document.getElementById('preview-img');
        if (!imgPreview) {
            const preview = document.createElement('img');
            preview.id = 'preview-img';
            preview.style.maxWidth = '100%';
            preview.style.marginTop = '10px';
            preview.style.borderRadius = '8px';
            e.target.parentNode.appendChild(preview);
        }
        document.getElementById('preview-img').src = URL.createObjectURL(file);
    }
});
</script>

<?php
require_once('footer.php');
?>