<?php
add_theme_support('post-thumbnails'); // アイキャッチサムネイルを有効化

function register_my_menu(){
    register_nav_menu('header-menu', __('header-menu'));
}

add_action('init', 'register_my_menu'); // ヘッダーメニューをダッシュボードから編集可能にする。

remove_action('wp_head', 'wp_generator');// Wordpressバージョンをソースから消す


function javascript() {
    wp_enqueue_script( 'jquery-js', 'https://code.jquery.com/jquery-3.5.1.min.js', [],'', true );
    wp_enqueue_script( 'script', get_theme_file_uri('assets/js/scripts.js'), ['jquery-js'],'', true );
}
add_action('wp_enqueue_scripts', 'javascript');