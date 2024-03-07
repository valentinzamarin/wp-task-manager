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

