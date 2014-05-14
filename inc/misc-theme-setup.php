<?php

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// Add default posts and comments RSS feed links to head
add_theme_support('automatic-feed-links');

// This theme uses its own gallery styles.
add_filter('use_default_gallery_style', '__return_false');

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));