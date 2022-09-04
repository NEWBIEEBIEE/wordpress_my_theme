<?php get_header(); ?>
    <div id="container">
        <section class="contents-area">
        <?php if(have_posts()): while(have_posts()):the_post(); ?>
        <h2 class="serif"><?php the_title(); ?></h2>
        <div class="contents_area">
            <?php the_content(); ?>
        </div>
        <?php endwhile; endif; ?>
        </section>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>
