<?php

class Task_Manager_AJAX_List{
    public function __construct() {
        add_action('wp_ajax_task_list', [$this, 'task_manager_load_list']);
        add_action('wp_ajax_nopriv_task_list', [$this, 'task_manager_load_list']);

        add_action('wp_ajax_task_remove', [$this, 'task_manager_remove_task']);
        add_action('wp_ajax_nopriv_task_remove', [$this, 'task_manager_remove_task']);

        add_action('wp_ajax_task_status', [$this, 'task_manager_change_status']);
        add_action('wp_ajax_nopriv_task_status', [$this, 'task_manager_change_status']);
    }

    public function task_manager_load_list() {
        check_ajax_referer('tasks_ajax', 'nonce');

        $args = array(
            'post_type' 	=> 'tasks',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'meta_key'       => 'tasks_date',
            'orderby'        => 'meta_value',
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) :
                $query->the_post();
                include TASK_MANAGER_PLUGIN_DIR . '/public/task-manager-item.php';
            endwhile;
            else :
                include TASK_MANAGER_PLUGIN_DIR . '/public/task-manager-none.php';
        endif;
        wp_reset_postdata();

        wp_die();
    }

    public function task_manager_remove_task() {
        check_ajax_referer('tasks_ajax', 'nonce');
        $id = $_POST['id'];
        wp_delete_post( $id );
        wp_die();
    }

    public function task_manager_change_status() {
        check_ajax_referer('tasks_ajax', 'nonce');
        $id = $_POST['id'];
        $status = $_POST['status'];
        update_post_meta( $id, 'tasks_status', $status);
        wp_die();
    }
}

new Task_Manager_AJAX_List();