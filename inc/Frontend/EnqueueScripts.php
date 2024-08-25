<?php

namespace TaskManager\Frontend;
use TaskManager\AbstractSingleton;

class EnqueueScripts extends AbstractSingleton{
    function task_manager_enqueue_scripts() {
        $time = time();
        wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css', [], $time);
        wp_enqueue_style('datepicker', 'https://raw.githack.com/mymth/vanillajs-datepicker/v1.3.2/dist/css/datepicker-bulma.css', [], $time);


        wp_enqueue_script('tasks-scripts', TASK_MANAGER_PLUGIN_DIR_URL . '/scripts/tasks.js', ['jquery'], $time, true);
        wp_localize_script('tasks-scripts', 'tasks_ajax', array(
            'nonce' => wp_create_nonce('tasks_ajax'),
            'ajax_url' => admin_url('admin-ajax.php')
        ));

    }
}
