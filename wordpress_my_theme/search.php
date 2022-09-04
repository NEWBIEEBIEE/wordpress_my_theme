<?php get_header('search'); ?>
    <section>
        <h2>検索結果</h2>

        <ul class="news-area">
        <?php if(!have_posts()): ?>
            <li>お探しの記事が存在しません。</li>
            <div class="searchbox">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
            <?php while(have_posts()): the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"></span><?php echo get_the_date('Y年n月j日'); ?></span><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </section>
<?php get_footer(); ?>
