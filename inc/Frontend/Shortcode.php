<?php

namespace TaskManager\Frontend;
use TaskManager\AbstractSingleton;

class Shortcode extends AbstractSingleton {
    public function task_manager_display_html() {
        return '<div id="task-app"></div>';
    }
}