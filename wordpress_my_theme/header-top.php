<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" type="text/css" media="all">
        <link rel='stylesheet' href='http://fonts.googleapis.com/earlyaccess/sawarabimincho.css' type='text/css'>
        <script async src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <?php wp_head(); ?>
        
    </head>
    <body <?php body_class(); ?>>
        <header>
            <div class="header-text">
                <h1 class="serif"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></h1>
                <p><?php bloginfo('description'); ?></p>
                <nav class="pc-nav">
                    <?php wp_nav_menu(array(
                        'depth' => 1,
                        'container' => false,
                        'echo' => true
                    )); ?>
                </nav>
         
                <div class="search"><?php get_search_form(); ?></div>
                <div id="hum_btn"><span></span><span></span><span></span></div>
                <nav class="sp-nav">
                    <?php wp_nav_menu(array(
                        'depth' => 1,
                        'container' => false,
                        'echo' => true
                    )); ?>
                </nav>
            </div>


            <div class="menu_area clearfix">

            </div>
        </header>
        <section class="no-padding single-img-post">
            <?php
                $args = array(
                    'posts_per_page' => 1, // 表示件数の指定
                    //'category' => 0 // カテゴリーを指定
                );
                if(is_archive()){
                    if(is_category()){
                        $cat = get_the_category();
                        $cat = $cat[0];
                        $cat->cat_ID;
                        $args = array(
                            'posts_per_page' => 1, // 表示件数の指定
                            'category' => $cat->cat_ID // カテゴリーを指定
                        );
                    }
                }
                $posts = get_posts($args);
                foreach($posts as $post):
                    setup_postdata($post); // 記事データの取得
                ?>
                <a href="<?php the_permalink(); ?>">
                    <div class="img-post-text">
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                </a>
                    <?php if(has_post_thumbnail()): ?>
                    <style>
                        .single-img-post {
                            background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat;
                            background-size: cover;
                            background-position:center;
                        }
                        @media screen and (max-width: 680px){
                            .single-img-post{
                                background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat;
                                background-size: ;
                                background-position: center;
                            }
                        }
                    </style>
                    <?php else:
                            $result = glob(get_template_directory() . '/assets/images/*');
                            $uri = get_template_directory_uri() . 'assets/images/';
                            $rand = rand(0, (count($result) - 1));
                            basename($result[$rand]);
                            ?>
                        <style>
                                .single-img-post {
                                    background:url(<?php echo get_theme_file_uri('/assets/images/' . basename($result[$rand]));  ?>) no-repeat;
                                    background-size: cover;
                                    background-position: center;
                                }

                                @media screen and (max-width: 680px){
                                    .single-img-post{
                                        background:url(<?php echo get_theme_file_uri('/assets/images/' . basename($result[$rand]));  ?>) no-repeat;
                                        background-size: ;
                                        background-position: center;
                                    }
                                }
                            </style>
                        <?php endif; ?>
                    </section>
                    <?php
                    endforeach;
                    wp_reset_postdata();
                    ?>

                    
