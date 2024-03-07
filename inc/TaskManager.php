<?php

namespace TaskManager;

defined( 'ABSPATH' ) || exit;

use TaskManager\Backend\MetaFields;
use TaskManager\Backend\PostType;
use TaskManager\Frontend\EnqueueScripts;
use TaskManager\Frontend\Shortcode;

use TaskManager\Frontend\AjaxActions;

class TaskManager extends AbstractSingleton {
    public function init() {
        $this->load_backend_dependencies();
        $this->load_frontend_dependencies();
    }
    public function load_backend_dependencies() {
        add_action( 'init', [ PostType::instance(), 'task_manager_register_post_type' ] );

        add_action( 'add_meta_boxes', [ MetaFields::instance(), 'task_manager_meta_fields' ],  );
        add_action( 'save_post', [ MetaFields::instance(), 'task_manager_save_meta_fields' ] );
    }
    public function load_frontend_dependencies() {

        add_action( 'wp_enqueue_scripts', [ EnqueueScripts::instance(), 'task_manager_enqueue_scripts' ] );
        add_shortcode( 'task_manager', [ Shortcode::instance(), 'task_manager_display_html' ] );

        add_action('wp_ajax_task_list', [ AjaxActions::instance(), 'load_task_list']);
        add_action('wp_ajax_nopriv_task_list', [ AjaxActions::instance(), 'load_task_list']);

        add_action('wp_ajax_task_remove', [ AjaxActions::instance(), 'delete_task']);
        add_action('wp_ajax_nopriv_task_remove', [ AjaxActions::instance(), 'delete_task']);

        add_action('wp_ajax_task_status', [ AjaxActions::instance(), 'change_task_status']);
        add_action('wp_ajax_nopriv_task_status', [ AjaxActions::instance(), 'change_task_status']);

        add_action('wp_ajax_task_action', [ AjaxActions::instance(), 'insert_new_task']);
        add_action('wp_ajax_nopriv_task_action', [ AjaxActions::instance(), 'insert_new_task']);

        add_action('wp_ajax_task_edit', [ AjaxActions::instance(), 'edit_existing_task']);
        add_action('wp_ajax_nopriv_task_edit', [ AjaxActions::instance(), 'edit_existing_task']);

    }
}