<?php
/*
Plugin Name: Task Manager
Plugin URI: https://github.com/valentinzamarin/wp-task-manager
Description: личный таск-менеджер на WordPress
Version: 1.0
Author: Valentin Zamarin
*/

define( 'TASK_MANAGER_PLUGIN', __FILE__ );
define( 'TASK_MANAGER_PLUGIN_DIR', untrailingslashit( dirname( TASK_MANAGER_PLUGIN ) ) );
define( 'TASK_MANAGER_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );


require_once 'task-manager-post-type.php';
require_once 'task-manager-enqueue-scripts.php';
require_once 'task-manager-ajax-form.php';
require_once 'task-manager-ajax-list.php';
require_once 'task-manager-ajax-edit.php';
require_once 'task-manager-meta-fields.php';

add_shortcode( 'task_manager', 'task_manager_callback');

function task_manager_callback() {
    $task_manager = null;
    ob_start();
    include TASK_MANAGER_PLUGIN_DIR . '/public/task-manager-display.php';
    $task_manager = ob_get_contents();
    ob_end_clean();

    return $task_manager;
}



