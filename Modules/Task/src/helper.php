<?php

if (! function_exists('hideHeaderOptions')) {
    function hideHeaderOptions() {
        $urls = [
            "tasks/create",
            "tasks/edit/*",
        ];
        foreach ($urls as $url) {
            if (request()->is($url)) {
                return true;
            }
        }
        return false;
    }
}