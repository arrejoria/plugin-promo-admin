<?php
/*
Template Name: Mi Plantilla Personalizada
Template Post Type: post, page
*/


// Agrega la cabecera HTML manualmente
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
    <!-- Incluir el archivo CSS de Tailwind -->
    <link rel="stylesheet" id="promo-admin-styles" href="<?php echo plugin_dir_url(dirname(__DIR__)) . 'assets/css/style.css'; ?>">
</head>

<body <?php body_class('min-h-full bg-gray-50'); ?>>

    <?php
    // Verificar si el usuario está logueado
    if (is_user_logged_in()) {
        // Usuario logueado, cargar el template correspondiente
        get_template_part('logged-in');
    } else {
        // Usuario no logueado, mostrar el formulario de inicio de sesión
    ?>
        <div class="prm-admin min-h-screen bg-[#DEAC80] flex items-center justify-center">
            <div class="flex max-w-md px-4">
                <?php $args = array(
                    'id_submit' => 'prm-login',
                ) ?>
            <?php wp_login_form($args); // Mostrar el formulario de inicio de sesión ?>

            </div>
        </div>
    <?php
        // Asegúrate de terminar la ejecución para evitar mostrar el resto del contenido
        exit;
    }
    ?>
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold my-10">Hola, Tailwind CSS en mi plantilla personalizada</h1>
        <p class="mt-4">Aquí puedes agregar el contenido de tu plantilla.</p>
    </div>

    <!-- Incluir scripts si es necesario -->
    <script src="<?php echo plugin_dir_url(__DIR__) . 'assets/js/mi-script.js'; ?>"></script>
    <?php wp_footer(); ?>
</body>

</html>