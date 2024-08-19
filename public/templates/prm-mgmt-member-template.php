<?php
/*
Template Name: Mi Plantilla Personalizada
Template Post Type: post, page

styles:
-primary-color: #e74d3c,
-primary-light: #FFAAAA,
-secondary-color: #f39c12,
-purple-color: #8d43ad,
-gren-color: #28af60,
-dark-color: #2b3d4f,
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

<body <?php body_class('container min-h-full bg-gray-50 font-montserrat bg-[#F2F2F2] text-[#333333] mx-auto py-8'); ?>>

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
                <?php wp_login_form($args); // Mostrar el formulario de inicio de sesión 
                ?>

            </div>
        </div>
        <?php exit; ?>
    <?php } ?>
    <?php

    // Configurar custom post type
    $current_slug = basename(get_permalink());
    $args = array(
        'post_type' => 'prm_admin',
        'post_per_page' => 1,
        'meta_query'     => array(
            array(
                'key'   => 'prm-template-slug', // Reemplaza esto con el nombre de tu meta key
                'value' => $current_slug, // El valor a comparar es el slug de tu página actual
            ),
        ),
    );
    $wp_query = new WP_Query($args);

    if ($wp_query->have_posts()) :
        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

            <main class="flex flex-col items-center gap-10 mx-auto" data-promo-handler="prm-main-section" id="prMain">
                <div class="w-full max-w-md border border-1 border-slate-500">1</div>
                <div class="w-full border border-1 border-slate-500">2</div>
            </main>

            <section class="flex justify-center gap-10 mx-auto mt-8" data-promo-handler="prm-first-section">
                <div class="xs:w-full sm:w-2/6 md:w-auto bg-[#E8DFCA] border-2 rounded-md p-2" id="formSection">
                    <h2 class="mb-4 text-bold text-2xl">Buscar N° Documento</h2>

                    <form class="space-y-4" id="promoForm">
                        <!-- <label for="userID"></label> -->
                        <input type="text" name="user-id" value="" placeholder="Ingresar número">
                        <input type="submit" class="bg-sky-600 hover:bg-sky-700 rounded uppercase text-[#F2F2F2] text-sm font-semibold border-none w-full" value="Buscar usuario">
                    </form>
                </div>
                <div class="xs:w-full sm:w-2/5 md:w-3/5 border-2 rounded-md bg-[#E8DFCA] py-2 px-4" id="userSection">
                    <h2 class="text-center mb-4 text-2xl">Información del usuario</h2>
                    <div class="max-w-lg bg-white rounded-lg " id="userData">
                        <div class="flex flex-col items-center space-y-2 px-8 py-8">
                            <span class="h-2 w-full bg-gray-300"></span>
                            <span class="h-2 w-3/4 bg-gray-300"></span>
                            <span class="h-2 w-2/3 bg-gray-300"></span>
                            <span class="h-2 w-2/6 bg-gray-300"></span>

                            <small class="text-sm text-gray-400 pt-8">Buscar usuario para reflejar en esta ventana sus datos</small>
                        </div>
                        <div id="userFields">

                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
    <!-- Incluir scripts si es necesario -->
    <script src="<?php echo plugin_dir_url(__DIR__) . 'assets/js/mi-script.js'; ?>"></script>
    <?php wp_footer(); ?>
</body>

</html>