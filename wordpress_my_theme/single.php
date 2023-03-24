<?php get_header(); ?>
    <!-- single.php -->
    <div id="container">
        <section class="contents-area">
            <?php 
            $category = get_the_category();
            $cat_name = $category[0]->cat_name;
            ?>
        <?php if(have_posts()): while(have_posts()):the_post(); ?>
        <h2 class="serif single_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
        <div class="time-data">
            <p>
                <span class="category_name"><?php echo $cat_name; ?></span><?php echo get_the_date('Y年n月j日'); ?>
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
<style>
article h3 {
    border-bottom: 2px solid #6ab547;
    margin-bottom: 20px;
    font-size: 28px;
    font-weight: 600;
    background-image: url(../images/h2_icon.png);
    background-repeat: no-repeat;
    background-position: left bottom;
    padding: 20px 10px 10px 48px;
}
</style>