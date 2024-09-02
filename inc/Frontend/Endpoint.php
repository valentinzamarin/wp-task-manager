<?php

namespace TaskManager\Frontend;
use TaskManager\AbstractSingleton;

class Endpoint extends AbstractSingleton{

    public function register_task_endpoints() : void {
        register_rest_route('task-plugin', '/tasks', array(
            'methods'  => 'GET',
            'callback' => [ $this, 'get_tasks_data' ],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
        ));

        register_rest_route('task-plugin', '/tasks', array(
            'methods'  => 'POST',
            'callback' => [ $this, 'add_task_data' ],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
        ));

        register_rest_route('task-plugin', '/tasks', array(
            'methods'  => 'PATCH',
            'callback' => [ $this, 'update_task_data' ],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
        ));

        register_rest_route('task-plugin', '/tasks/delete', array(
            'methods'  => 'POST',
            'callback' => [ $this, 'delete_task_data' ],
            'permission_callback' => function () {
                return is_user_logged_in();
            },
        ));
    }

    public function get_tasks_data()  {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM wp_tasks_table");

        return rest_ensure_response($results);
    }
    public function add_task_data( $request ) {
        global $wpdb;


        $task_title = sanitize_text_field( $request->get_param( 'task_title' ) );
        $task_description = sanitize_textarea_field( $request->get_param( 'task_description' ) );

        if ( empty( $task_title ) ) {
            return new \WP_Error( 'no_title', 'Task title is required', array( 'status' => 400 ) );
        }

        $wpdb->insert(
            'wp_tasks_table',
            array(
                'title'       => $task_title,
                'description' => $task_description,
            )
        );

        return rest_ensure_response( array(
            'id'           => $wpdb->insert_id,
            'title'        => $task_title,
            'description'  => $task_description,
            'status'       => 'false',
        ) );
    }

    public function update_task_data( $request ) {
        global $wpdb;

        $task_id = intval( $request->get_param( 'id' ) );
        $status = intval( $request->get_param( 'status' ) );

        if ( ! $task_id ) {
            return new \WP_Error( 'no_task_id', 'Task ID is required', array( 'status' => 400 ) );
        }

        $updated = $wpdb->update(
            'wp_tasks_table',
            array( 'status' => $status ), // Обновляем только статус
            array( 'id' => $task_id )
        );

        if ( $updated !== false ) {
            return rest_ensure_response( array( 'success' => true ) );
        } else {
            return new \WP_Error( 'update_failed', 'Failed to update task', array( 'status' => 500 ) );
        }
    }
    public function delete_task_data( \WP_REST_Request $request ) {
        global $wpdb;

        $task_id = intval( $request->get_param( 'task_id' ) );

        if ( empty( $task_id ) ) {
            return new WP_Error( 'no_task_id', 'Task ID is required', array( 'status' => 400 ) );
        }

        $table_name = 'wp_tasks_table';

        $result = $wpdb->delete( $table_name, array( 'id' => $task_id ) );

        if ( false === $result ) {
            return new WP_Error( 'delete_failed', 'Failed to delete task', array( 'status' => 500 ) );
        }

        return rest_ensure_response( array( 'success' => true ) );
    }

}