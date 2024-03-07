<?php

namespace TaskManager\Frontend;
use TaskManager\AbstractSingleton;

class Shortcode extends AbstractSingleton {
    public function task_manager_display_html() {
        $task_manager = null;
        ob_start();
        include TASK_MANAGER_PLUGIN_DIR . '/public/task-manager-display.php';
        $task_manager = ob_get_contents();
        ob_end_clean();

        return $task_manager;
    }
}