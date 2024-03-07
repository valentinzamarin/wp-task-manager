<?php

namespace TaskManager\Backend;
use TaskManager\AbstractSingleton;

defined( 'ABSPATH' ) || exit;

class PostType extends AbstractSingleton {
    public function task_manager_register_post_type() {
        register_post_type( 'tasks',
            [
                'label'                 => __( 'Tasks' ),
                'labels'                => array(
                    'name'          => __( 'Tasks' ),
                    'singular_name' => __( 'Task' ),
                ),
                'description'           => '',
                'public'                => false,
                'publicly_queryable'    => false,
                'show_ui'               => true,
                'show_in_rest'          => true,
                'rest_base'             => 'tasks',
                'rest_controller_class' => 'WP_REST_Posts_Controller',
                'has_archive'           => false,
                'show_in_menu'          => true,
                'show_in_nav_menus'     => true,
                'delete_with_user'      => false,
                'exclude_from_search'   => false,
                'capability_type'       => 'post',
                'map_meta_cap'          => true,
                'hierarchical'          => false,
                'rewrite'               => array(
                    'slug'       => 'tasks',
                    'with_front' => true,
                ),
                'query_var'             => true,
                'supports'              => [ 'title', 'editor', 'custom-fields' ],
                'menu_icon'             => 'dashicons-list-view',
            ]
        );
    }
}