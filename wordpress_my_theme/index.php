<?php get_header('top'); ?>
    <section>
        <h2 class="cat-name">News</h2>
        <div class="flex-box mt-10">
            <?php
            $args = array(
                'posts_per_page' => 4, // 表示件数の指定
                'category' => 1 // カテゴリーを指定
            );
            $posts = get_posts($args);
            foreach($posts as $post):
                setup_postdata($post); // 記事データの取得
            ?>
            <div class="news-column">
                <a href="<?php the_permalink(); ?>">
                <?php if(has_post_thumbnail()): ?>
                    <div class="trim"><img src ="<?php echo get_the_post_thumbnail_url(); ?>"></div>
                    <?php else: ?>
                        <div class="trim"><img src="https://placehold.jp/600x400.png">
                    </div>
                    <?php endif; ?>
                    <h2 class="serif"><?php the_title(); ?></h2>
                    <p><?php the_excerpt(); ?></p>
                </a>
            </div>
            <?php
            endforeach;
            wp_reset_postdata();
            ?>
        </div>
    </section>
<?php get_footer(); ?>