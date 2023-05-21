<?php

class Task_Manager_Edit{
    public function __construct() {
        add_action('wp_ajax_task_edit', [$this, 'task_manager_edit']);
        add_action('wp_ajax_nopriv_task_edit', [$this, 'task_manager_edit']);
    }

    public function task_manager_edit() {
        check_ajax_referer('tasks_ajax', 'nonce');

        $data = [
            'ID'           => $_POST['id'],
            'post_title'   => $_POST['title'],
        ];

        wp_update_post( $data );
        wp_die();
    }
}

new Task_Manager_Edit();