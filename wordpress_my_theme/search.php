<?php get_header('search'); ?>
    <section>
        <h2>「<?php echo esc_html($_GET['s']); ?>」の検索結果：<?php echo $wp_query->found_posts; ?>件</h2>

        <ul class="news-area">
        <?php if(!have_posts()): ?>
            <li>お探しの記事が存在しません。</li>
            <div class="searchbox">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
            <?php while(have_posts()): the_post(); ?>
                <?php
                    $cat = get_the_category();
                    $catname = $cat[0]->cat_name;
                ?>
                <li><a href="<?php the_permalink(); ?>"></span><?php echo get_the_date('Y年n月j日'); ?></span><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </section>

    
<?php get_footer(); ?>

<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package spritual
 */
