<?php get_header(); ?>
    <div id="container">
        <section class="contents-area">
            <?php 
            $category = get_the_category();
            $cat_name = $category[0]->cat_name;
            ?>
        <?php if(have_posts()): while(have_posts()):the_post(); ?>
        <h2 class="serif"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
        <div class="time-data">
            <p>
                <span><?php echo $cat_name; ?></span><?php echo get_the_date('Y年n月j日'); ?>
            </p>
        </div>
        <div class="contents_area">
            <?php the_content(); ?>
        </div>
        <?php endwhile; endif; ?>
        </section>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>
