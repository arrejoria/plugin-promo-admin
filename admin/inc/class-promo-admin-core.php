<?php

/**
 * Aquí se definiran todas las funciones vitales para el nucleo del plugin desde el lado del administrador
 * 
 * 
 * @link       https://www.linkedin.com/in/arr-dev/
 * @since      1.0.0
 *
 * @package    Promo_Admin
 * @subpackage Promo_Admin/admin/inc
 */

/**
 * 
 * @since      1.0.0
 * @package    Promo_Admin
 * @subpackage Promo_Admin/admin/inc
 * @author     Lucas E. Arrejoria <arrejoria.work@gmail.com>
 */



class Promo_Admin_Core
{
    private $meta_class;

    public function __construct() {

    }



    public function prm_admin_custom_post_type()
    {
        $labels = array(
            'name'               => __('Gestionar Promociones', 'promo-admin'),
            'singular_name'      => __('Gestionar Promoción', 'promo-admin'),
            'menu_name'          => __('Gestionar Promoción', 'promo-admin'),
            'add_new'            => __('Añadir Nueva', 'promo-admin'),
            'add_new_item'       => __('Añadir Nueva promoción', 'promo-admin'),
            'edit'               => __('Editar', 'promo-admin'),
            'edit_item'          => __('Editar Promoción', 'promo-admin'),
            'new_item'           => __('Nueva Promoción', 'promo-admin'),
            'view'               => __('Ver', 'promo-admin'),
            'view_item'          => __('Ver Promoción', 'promo-admin'),
            'search_items'       => __('Buscar Promociones', 'promo-admin'),
            'not_found'          => __('No se encontraron promociones', 'promo-admin'),
            'not_found_in_trash' => __('No se encontraron promociones en la Papelera', 'promo-admin'),
        );

        // Argumentos para el tipo de entrada personalizado
        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'query_var'           => true,
            'rewrite'             => array('slug' => 'promo-admin'),
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => true,
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-forms',
            'supports'            => array('title', 'author', 'thumbnail', 'editor','page-attributes'),
        );

        // Registrar el tipo de entrada personalizado
        register_post_type('prm_admin', $args);
    }


    // Crar plugin template
    public function prm_admin_templates_array()
    {
        $temps = [];
        $temps['prm-mgmt-member-template.php'] = 'Template Promo Members DNI MGMT';
        $temps['prm-mgmt-simple-template.php'] = 'Template Promo Basica DNI MGMT';
        $temps['prm-mgmt-basic-template.php'] = 'Basic Promo Template';

        return $temps;
    }

    public function prm_admin_template_register($page_templates, $theme, $post)
    {
        $templates = $this->prm_admin_templates_array();

        foreach ($templates as $tmpKey => $tmpValue) {
            $page_templates[$tmpKey] = $tmpValue;
        }

        return $page_templates;
    }

    public function prm_admin_template_select($template)
    {
        global $post, $wp_query, $wpdb;

        if (!$post) return;

        $page_temp_slug = get_page_template_slug($post->ID);

        $templates = $this->prm_admin_templates_array();

        $template_path = plugin_dir_path(dirname(__DIR__)) . 'public/templates/' . $page_temp_slug;


        if (isset($templates[$page_temp_slug])) {
            $template = $template_path;
        }

        return $template;
    }
    
}
