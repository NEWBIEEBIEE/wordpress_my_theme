<?php
add_theme_support('post-thumbnails'); // アイキャッチサムネイルを有効化

function register_my_menu(){
    register_nav_menu('header-menu', __('header-menu'));
}

//functions.php
function my_theme_widgets_init() {
    register_sidebar( array(
      'name' => 'Main Sidebar',
      'id' => 'main-sidebar',
    ) );
  }
add_action( 'widgets_init', 'my_theme_widgets_init' );

add_action('init', 'register_my_menu'); // ヘッダーメニューをダッシュボードから編集可能にする。

remove_action('wp_head', 'wp_generator');// Wordpressバージョンをソースから消す

//全記事へのアーカイブ
function post_has_archive( $args, $post_type ) {
  if ( 'post' == $post_type ) {
      $args['rewrite'] = true;
      $args['has_archive'] = 'archive'; // 任意のスラッグ名
  }
  return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );


add_filter( 'post_type_archive_link', function( $link, $post_type ) {
  if ( 'post' === $post_type ) {
  $post_type_object = get_post_type_object( 'post' );
  $slug = $post_type_object->has_archive;
  $link = get_home_url( null, '/' . $slug . '/' );
  }
  return $link;
 }, 10, 2 );
 function add_article_post_permalink( $permalink ) {
 $permalink = '/archive' . $permalink;
  return $permalink;
 }
 add_filter( 'pre_post_link', 'add_article_post_permalink' );
 function add_article_post_rewrite_rules( $post_rewrite ) {
  $return_rule = array();
  foreach ( $post_rewrite as $regex => $rewrite ) {
  $return_rule['archive/' . $regex] = $rewrite;
  }
 return $return_rule;
 }
 add_filter( 'post_rewrite_rules', 'add_article_post_rewrite_rules' );

// 抜粋文
function new_excerpt_mblength($length) {
     return 30; //抜粋する文字数を50文字に設定
}
add_filter('excerpt_mblength', 'new_excerpt_mblength');


function javascript() {
    wp_enqueue_script( 'jquery-js', 'https://code.jquery.com/jquery-3.5.1.min.js', [],'', true );
    wp_enqueue_script( 'scripts', get_theme_file_uri('assets/js/scripts.js'), ['jquery-js'],'', true );
    wp_enqueue_script( 'script', get_theme_file_uri('assets/js/script.js'), ['jquery-js'],'', true );
}

function style(){
}


add_action('wp_enqueue_scripts', 'javascript');
add_action( 'wp_enqueue_scripts', 'style' );


function remove_dashboard_widget() {
	remove_action( 'welcome_panel','wp_welcome_panel' ); // ようこそ
 	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
 	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ
 	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
 	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress イベントとニュース
} 
add_action('wp_dashboard_setup', 'remove_dashboard_widget' );


function login_redirect( $user_login, $user ) {
  if ( 'ユーザー権限' === $user->roles[0] ) {
  wp_safe_redirect( home_url(), 301 );
  exit();
  }
  }
  add_action( 'wp_login', 'login_redirect', 10, 2 );

add_action( 'auth_redirect', 'subscriber_go_to_home' );
function subscriber_go_to_home( $user_id ) {
$user = get_userdata( $user_id );
if ( !$user->has_cap( 'edit_posts' ) ) {
wp_redirect( get_home_url() );
exit();
}
}

add_action( 'after_setup_theme', 'subscriber_hide_admin_bar' );
function subscriber_hide_admin_bar() {
$user = wp_get_current_user();
if ( isset( $user->data ) && !$user->has_cap( 'edit_posts' ) ) {
show_admin_bar( false );
}
}