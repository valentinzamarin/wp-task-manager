<?php

class Task_Manager_AJAX_Form{
    public function __construct() {
        add_action('wp_ajax_task_action', [$this, 'task_manager_ajax_callback']);
        add_action('wp_ajax_nopriv_task_action', [$this, 'task_manager_ajax_callback']);
    }

    public function task_manager_ajax_callback() {
        check_ajax_referer('tasks_ajax', 'nonce');

        $title     = $_POST['title'];
        $descr     = $_POST['descr'];
        $date      = $_POST['date'];
        $estimate  = $_POST['estimate'];

        $post_data = array(
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $descr,
            'post_status'   => 'publish',
            'post_type'     => 'tasks',
        );

        $post = wp_insert_post( $post_data );

        update_post_meta( $post, 'tasks_date', $date );
        update_post_meta( $post, 'tasks_estimate', $estimate );

        wp_die();
    }
}

new Task_Manager_AJAX_Form();