<?php

class Task_Manager_Meta_Fields {
    public function __construct() {
        add_action( 'add_meta_boxes', [ $this, 'task_manager_meta' ],  );
        add_action( 'save_post', [ $this, 'task_manager_save_meta' ] );
    }

    public function task_manager_meta( $post ) {
        add_meta_box(
            'tasks_meta',
            'Task meta fields',
            function ( $post ) {
                $date     = get_post_meta( $post->ID, 'tasks_date', true );
                $estimate = get_post_meta( $post->ID, 'tasks_estimate', true );
                $status   = get_post_meta( $post->ID, 'tasks_status', true );
                wp_nonce_field( 'tasks_action', 'tasks_nonce' );
                ?>
                <div>
                    <label>
                        <input type="text"
                               name="tasks_date"
                               value="<?php echo esc_attr( $date ); ?>"
                               class="widefat"/>
                        Task Date
                    </label>
                    <label>
                        <input type="text"
                               name="tasks_estimate"
                               value="<?php echo esc_attr( $estimate ); ?>"
                               class="widefat"/>
                        Estimate
                    </label>
                    <label>
                        <input type="checkbox"
                               name="tasks_status"
                               <?php if( $status == true ) { ?>checked="checked"<?php } ?>
                               class="widefat"/>
                        Is Done?
                    </label>
                </div>
                <?php
            },
            'tasks',
            'normal',
            'low'
        );
    }

    public function task_manager_save_meta(){
        global $post;

        if ( empty( $_POST['tasks_nonce'] ) || ! wp_verify_nonce( $_POST['tasks_nonce'], 'tasks_action' ) ) {
            return true;
        }

        $keys = array(
            'tasks_estimate',
            'tasks_date',
            'tasks_status',
        );

        foreach ( $keys as $key ) {
            if ( ! empty( $_POST[ $key ] ) ) {
                update_post_meta( $post->ID, $key, $_POST[ $key ] );
            } else {
                delete_post_meta( $post->ID, $key );
            }
        }

        return true;
    }
}

new Task_Manager_Meta_Fields();