<?php

/**
 * Class principal con las funciones de gravityforms y su API
 * 
 */


class Promo_Admin_Gravity_Funcs
{

    private $promo_form;
    private $class_helpers;
    public function __construct()
    {
        $this->class_helpers = new Promo_Admin_Helpers();
    }

    /**
     * Localizar el formulario en gravity form y devolver un array con los datos preparados para utilizarlos en las demas funciones que dependan de sus campos.
     *  
     * @param   int        $post_id            identificador del post para obtener el form_id value con meta key 'prm-formid'.
     * @return  array      $form               Un array preparado que contiene los datos necesario del formulario para la promocion. 
     */
    public function get_promo_form($post_id)
    {

        $form_id = get_post_meta($post_id, 'prm-formid', true);
        
        if (!class_exists('GFCommon')) {
            echo '<div class=""><p class="!text-2xl text-red-600 text-center p-2 border border-red-700 bg-red-100">Este plugin necesita de que Gravity Form esté activado en el sitio.</p></div>';
            wp_die();
        }

        try {
            if (empty($form_id)) throw new Exception('Ingresar ID del formulario');
            if (!GFAPI::form_id_exists($form_id)) throw new Exception('Comprobar que el formulario (ID: ' .$form_id.') esté creado o sea correcto');

            $form_fields = GFAPI::get_form($form_id)['fields'];
            $form = array();
            foreach ($form_fields as $field) {
                $form['labels'][$field['label']] = $field['label'];
                $form['fields'][$field['adminLabel']]  = $field['id'];
            }

            // Asignar todos los datos del formulario a la propiedad prm_form
            return $form;
        } catch (Exception $e) {
            // Manejar la excepción capturada
            echo '<div class="flex flex-column bg-gray-100 my-4 p-[30px] border-2 border-dotted border-slate-500 text-center"><p class="font-semibold uppercase text-slate-400">' .  $e->getMessage() . '</p></div>';
            return;
   
        }
    }
}
