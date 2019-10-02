<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    class Asterion_Nav_Walker extends Walker_Nav_Menu {

        function start_lvl( &$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>\n";   
            $output .= "\n$indent<ul class=\"sub-menu\">\n";    
        }

    }