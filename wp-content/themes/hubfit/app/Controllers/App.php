<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    // Pass on all fields from Advanced Custom Fields to the view
    protected $acf = true;

    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'hubfit');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'hubfit'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'hubfit');
        }
        return get_the_title();
    }
}
