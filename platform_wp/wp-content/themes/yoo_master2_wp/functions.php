<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// check compatibility
if (version_compare(PHP_VERSION, '5.3', '>=')) {

    add_action('after_setup_theme', function () {
        do_action('wp_enqueue_scripts');
    });

    // bootstrap warp
    require(__DIR__.'/warp.php');
}
