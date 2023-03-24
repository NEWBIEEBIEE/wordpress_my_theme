<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" type="text/css" media="all">
        <link href="https://fonts.googleapis.com/earlyaccess/sawarabimincho.css" rel="stylesheet" />
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
                <nav class="sp-nav">
                    <?php wp_nav_menu(array(
                        'depth' => 1,
                        'container' => false,
                        'echo' => true
                    )); ?>
                </nav>
                <div id="hum_btn"><span></span><span></span><span></span></div>
                <span class="clear"></span>
                <div class="search"><?php get_search_form(); ?></div>
            </div>

            <div class="menu_area clearfix">

            </div>
        </header>
        <section class="no-padding single-img-post">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
                <?php if(has_post_thumbnail()): ?>
                    <style>
                        .single-img-post{
                            background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat;
                            background-size:cover;
                            background-position: center;
                        }
                        @media screen and (max-width:680px) {
                            .single-img-post{
                                background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat;
                                background-size: ;
                                background-position: center;
                            }
                        }
                        </style>
                        <?php else: ?>
                            <style>
                                .single-img-post {
                                    background: url(https://placehold.jp/600x400.png) no-repeat;
                                    background-size: cover;
                                    background-position: center;
                                }

                                @media screen and (max-width: 680px){
                                    .single-img-post{
                                        background:url(https://placehold.jp/600x400.png) no-repeat;
                                        background-size: ;
                                        background-position: center;
                                    }
                                }
                            </style>
                        <?php endif; ?>
                    <?php endwhile; endif; ?>
        </section>

    