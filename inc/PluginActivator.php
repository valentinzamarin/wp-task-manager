<?php

namespace TaskManager;

class PluginActivator {
    public static function activate() {

        global $wpdb;

        $table_name = $wpdb->prefix . 'tasks_table';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS  $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            title varchar(255) NOT NULL,
            description text NOT NULL,
            status TINYINT(1) NOT NULL DEFAULT 0,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($sql);
    }

    public static function deactivate() {

        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks_table';
        $sql = "DROP TABLE IF EXISTS $table_name;";
        $wpdb->query($sql);
    }
}