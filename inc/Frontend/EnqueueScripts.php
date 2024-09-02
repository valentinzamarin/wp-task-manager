<?php

namespace TaskManager\Frontend;
use TaskManager\AbstractSingleton;

class EnqueueScripts extends AbstractSingleton{
    function task_manager_enqueue_scripts() {
        $time = time();

        wp_enqueue_style('tasks-styles', TASK_MANAGER_PLUGIN_DIR_URL . '/assets/css/style.css', [], $time );

        wp_enqueue_script('tasks-scripts', TASK_MANAGER_PLUGIN_DIR_URL . '/assets/scripts/tasks.js', [], $time, true);
        wp_localize_script('tasks-scripts', 'tasks_plugin_data', array(
            'api_url'    => esc_url(rest_url('task-plugin/tasks')),
            'api_delete' => esc_url(rest_url('task-plugin/tasks/delete')),
            'jwt_token'  => '',
        ));

    }
}
