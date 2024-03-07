<?php

namespace TaskManager\Frontend;
use TaskManager\AbstractSingleton;

defined( 'ABSPATH' ) || exit;

class AjaxActions extends AbstractSingleton{

    public function load_task_list() {

        check_ajax_referer('tasks_ajax', 'nonce');

        $args = array(
            'post_type' 	=> 'tasks',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'meta_key'       => 'tasks_date',
            'orderby'        => 'meta_value',
        );
        $query = new \WP_Query( $args );
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

    public function delete_task() {
        check_ajax_referer('tasks_ajax', 'nonce');
        $id = $_POST['id'];
        wp_delete_post( $id );
        wp_die();
    }

    public function change_task_status() {
        check_ajax_referer('tasks_ajax', 'nonce');
        $id = $_POST['id'];
        $status = $_POST['status'];
        update_post_meta( $id, 'tasks_status', $status);
        wp_die();
    }


    public function insert_new_task() {

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

    public function edit_existing_task() {
        check_ajax_referer('tasks_ajax', 'nonce');

        $data = [
            'ID'           => $_POST['id'],
            'post_title'   => $_POST['title'],
        ];

        wp_update_post( $data );
        wp_die();
    }
}