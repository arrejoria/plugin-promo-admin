<?php

/**
 * Todos las funciones metas serán registradas en este espacio
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



class Promo_Admin_Meta
{
    private $mbx_array;
    private $class_gfuncs;
    private $class_db_handler;
    private $class_helpers;
    // Constructor
    public function __construct()
    {
        $this->mbx_array = array();
        // $this->prm_form = array();
        $this->class_db_handler = new DB_Handler();
        $this->class_gfuncs = new Promo_Admin_Gravity_Funcs();
        $this->class_helpers = new Promo_Admin_Helpers();
    }

    public function register_meta_actions()
    {
        add_action('add_meta_boxes', array($this, 'prm_admin_process_metaboxes'));
        add_action('save_post', array($this, 'prm_admin_save_metaboxes'));
    }

    public function prm_admin_add_metabox($meta_id, $meta_title, $meta_callback, $screen = null, $context = 'advanced', $priority = 'default')
    {
        $this->mbx_array[] = array(
            'meta_id' => $meta_id,
            'meta_title' => $meta_title,
            'meta_callback' => array($this, $meta_callback),
            'screen' => $screen,
            'context' => $context,
            'priority' => $priority,
        );
    }

    public function prm_admin_process_metaboxes()
    {
        foreach ($this->mbx_array as $metabox) {
            add_meta_box(
                $metabox['meta_id'],
                $metabox['meta_title'],
                $metabox['meta_callback'],
                $metabox['screen'],
                $metabox['context'],
                $metabox['priority']
            );
        }
    }

    public function mbx_promo_config_render($post)
    {
        $post_id = $post->ID;
        wp_nonce_field(basename(__FILE__), 'prm_admin_nonce');

        $form_id = get_post_meta($post_id, 'prm-formid', true);
        $page_slug = get_post_meta($post_id, 'prm-template-slug', true);

?>

        <div class="flex justify-between gap-10 flex-wrap">

            <!-- PROMO SECTION START -->
            <div class="bg-gray-50 xs:w-full sm:flex-[1_1_45%] sm:grow-0 px-2">
                <h2 class="!font-bold !text-[1.2rem] font-montserrat text-gray-500">Configuración de la promoción:</h2>
                <hr class="border-separate border border-gray-600 my-2">
                <div class="space-y-2">
                    <div class="my-2 border rounded p-1">
                        <label for="formId" class="block text-[1rem] font-bold text-gray-500"> Form ID</label>
                        <input class="w-full" type="text" name="prm-formid" placeholder="Ingresar ID del formulario" id="formId" value="<?= esc_attr($form_id); ?>" required>
                        <small class="block text-sm text-gray-400 pt-2"> Ingresar el identificador del formulario smallara esta promocion.</small>
                    </div>
                </div>
            </div>
            <!-- PROMO SECTION END -->

            <!-- TEMPLATE SECTION START -->
            <div class="bg-gray-50 xs:w-full sm:flex-[1_1_45%] sm:grow-0 px-2">
                <h2 class="!font-bold !text-[1.2rem] font-montserrat text-gray-500">Configuración de la plantilla:</h2>
                <hr class="border-separate border border-gray-600 my-2">

                <div class="space-y-2">
                    <div class="mb-2 border rounded p-1">
                        <label for="tempName" class="block text-[1rem] font-bold text-gray-500">Slug de la plantilla:</label>
                        <input class="w-full" type="text" name="prm-template-slug" placeholder="ej. promo-page-slug" id="tempName" value="<?= esc_attr($page_slug); ?>" required>
                        <small class="block text-sm text-gray-400 pt-2">Slug de la pagina donde se mostrará la promoción.</small>
                    </div>
                </div>
            </div>
            <!-- TEMPLATE SECTION END -->

            <!-- FORM SECTION START -->
            <div class="flex flex-col bg-gray-50 xs:flex-[1_1_100%]  sm:flex-[1_1_90%] sm:grow px-2">
                <div class="flex xs:flex-col sm:flex-row justify-between items-center">
                    <h2 class="!font-bold !text-[1.2rem] font-montserrat text-gray-500">Configuración del formulario:</h2>
                    <button type="submit" name="reset-meta" value="1" class="bg-slate-400 px-4 py-2 text-white font-semibold text-wrap">Resetear estilos del formulario</button>
                </div>
                <hr class="border-separate border border-gray-600 my-2">

                <div class="flex max-w-screen-sm mx-auto">
                    <div>

                    </div>
                    <div class="flex flex-wrap justify-between px-10 gap-5">
                        <?php
                        $form = $this->class_gfuncs->get_promo_form($post_id);    // array($labels, $fields)
                        if(empty($form)) return;

                        $fields = $form['fields'];
                        $prm_inp_labels = get_post_meta($post_id, 'prm-input-label', true);
                        $prm_inp_class = get_post_meta($post_id, 'prm-input-class', true); // return un array vacio

                        foreach ($fields as $label => $id):
                        ?>
                            <?php if (!empty($prm_inp_class[$id]) && $prm_inp_class !== 'reset' ): ?>
                                <div class="<?= esc_attr($prm_inp_class[$id]) ?> border border-1 border-slate-400 p-2 rounded">
                                    <!-- meta values -->
                                    <small class="block bg-gray-200 px-2 py-1">default: class="w-auto max-w-[45%]"</small>
                                    <input type="text" name="prm-input-class[<?= $id ?>]" id="" class=" w-full !text-gray-500 text-[10px] !h1-2 !min-h-2" value="<?= esc_attr($prm_inp_class[$id]) ?>" placeholder="Insertar las clases que utilizara este campo">
                                <?php else: ?>
                                    <!-- default values -->
                                    <div class="w-auto max-w-[45%] border border-1 border-slate-400 p-2 rounded">
                                        <small class="block bg-gray-200 px-2 py-1">default: class="w-auto max-w-[45%]"</small>
                                        <input type="text" name="prm-input-class[<?= $id ?>]" id="" class=" w-full !text-gray-500 text-[10px] !h1-2 !min-h-2" value="" placeholder="Insertar las clases que utilizara este campo">

                                    <?php endif; ?>

                                    <input type="text" name="prm-input-label[<?= $id ?>]" id="" class="w-full" value="<?= $label ?>" placeholder="Insertar clases" disabled>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                    </div>
                </div>
                <!-- FORM SECTION END -->

                <div>

            <?php
        }

        public function prm_admin_save_metaboxes($post_id)
        {

            $form_id = $page_slug = $inp_clases = $inp_labels = '';

            // Verificar si es una solicitud de guardado automático o si el usuario actual tiene permiso para editar el post
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || !current_user_can('edit_post', $post_id)) {
                return;
            }

            // Verificar nonce
            if (!isset($_POST['prm_admin_nonce']) || !wp_verify_nonce($_POST['prm_admin_nonce'], basename(__FILE__))) {
                return;
            }

            // Guardar datos del metabox
            if (isset($_POST['prm-formid'])) {
                $form_id = sanitize_text_field($_POST['prm-formid']);
                update_post_meta($post_id, 'prm-formid', $form_id);
            }

            if (isset($_POST['prm-template-slug'])) {
                $page_slug = sanitize_text_field($_POST['prm-template-slug']);
                update_post_meta($post_id, 'prm-template-slug', $page_slug);
            }

            if (isset($_POST['prm-input-class']) && is_array($_POST['prm-input-class'])) {
                $class_array = array_map('sanitize_text_field', $_POST['prm-input-class']);
                update_post_meta($post_id, 'prm-input-class', $class_array);
            }

            if (isset($_POST['prm-input-label'])) {
                $inp_labels = sanitize_text_field($_POST['prm-input-label']);
                update_post_meta($post_id, 'prm-input-label', $inp_labels);
            }

            if (isset($_POST['reset-meta']) && $_POST['reset-meta'] == '1') {
                // Eliminar el meta post
                update_post_meta($post_id, 'prm-input-class', 'reset');
                update_post_meta($post_id, 'prm-input-label', 'reset');

                // Puedes agregar una redirección o un mensaje de confirmación aquí si lo deseas
                echo "<div class='updated'><p>Los metadatos han sido reseteados.</p></div>";
            }
        }

        public function prm_admin_render_promo_form() {}





        public function insert_promo_data_table() {}
    }
