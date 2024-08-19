<?php

/**
 * Toda las funciones que serán de ayuda para este plugin
 * 
 * 
 */



class Promo_Admin_Helpers
{



    public function prm_notification($message, $type)
    {
        if (empty($message)) return;
    
        // Definimos las clases CSS y estilos según el tipo de notificación
        switch ($type) {
            case 'notice':
                $classes = 'block max-w-full notice is-dismissible';
                break;
            case 'normal':
                $classes = 'block px-2 border border-gray-400';
                break;
            default:
                $classes = 'block px-2 border border-gray-200'; // Clase por defecto
                break;
        }
    
        // Estructura HTML de la notificación
        echo '<div class="' . $classes . '">';
        echo '<h2 class="font-semibold">Promo Admin - Notificaciones: </h2>';
        echo '<p>' . $message . '</p>';
        echo '</div>';
    }
}
