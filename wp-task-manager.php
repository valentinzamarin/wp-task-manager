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

require_once TASK_MANAGER_PLUGIN_DIR . '/vendor/autoload.php';

use TaskManager\TaskManager;
use TaskManager\PluginActivator;
function task_plugin_activation() {
    PluginActivator::activate();
}

function task_plugin_deactivation() {
    PluginActivator::deactivate();
}

register_activation_hook( __FILE__, 'task_plugin_activation' );
register_deactivation_hook(__FILE__, 'task_plugin_deactivation');

if ( ! function_exists( 'task_manager_init' ) ) {
    /**
     * Returns singleton instance of TaskManager.
     *
     * @return TaskManager
     */
    function task_manager_init(): TaskManager {
        return TaskManager::instance();
    }

    task_manager_init()->init();
}

