<?php

namespace TaskManager;

defined( 'ABSPATH' ) || exit;

use TaskManager\Frontend\Endpoint;
use TaskManager\Frontend\EnqueueScripts;
use TaskManager\Frontend\Shortcode;

class TaskManager extends AbstractSingleton {
    public function init() {
        $this->load_frontend_dependencies();
    }
    public function load_frontend_dependencies() {

        add_action( 'wp_enqueue_scripts', [ EnqueueScripts::instance(), 'task_manager_enqueue_scripts' ] );
        add_shortcode( 'task_manager', [ Shortcode::instance(), 'task_manager_display_html' ] );

        add_action('rest_api_init', [ Endpoint::instance(), 'register_task_endpoints' ]);

    }


}