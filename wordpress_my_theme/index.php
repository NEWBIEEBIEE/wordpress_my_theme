<?php get_header('top'); ?>
    <section>
        <h2 class="cat-name">News</h2>
        <div class="flex-box mt-10">
            <?php
            $args = array(
                'posts_per_page' => 5, // 表示件数の指定
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
        <div class="flex-box mt-10">
            <div class="right_aline_button">
                <a href="<?php echo './archive/'; ?>" class="btn btn--red btn--radius btn--cubic">続き<i class="fas fa-angle-right fa-position-right" ></i></a>
            </div>
        </div>
    </section>
    <section class="menuDetailSec">
        <h3>Categories</h3>
        <?php
        $categories = get_categories();?>
        <ul class="menuList">
        <?php
            foreach ($categories as $category):
        ?>
            <li>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                <?php
                    $my_query = new WP_Query(
                        array(
                            'cat' => $category->term_id,
                            'posts_per_page' => 1,
                        ));
                    if ($my_query->have_posts()):
                
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <div>
                    <?php if(has_post_thumbnail()): ?>
                        <img src ="<?php echo get_the_post_thumbnail_url(); ?>"/>
                    <?php else: ?>
                        <img src="https://placehold.jp/600x400.png"/>
                    <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                    <div class="cat_name">
                        <?php echo $category->name; ?>
                    </div>
                    <?php endif; ?>
                </a>
            </li>
            <?php wp_reset_postdata(); ?>
            <?php endforeach; ?>
        </ul>
    </section>
<?php get_footer(); ?>
<?php /* https://9-bb.com/wordpress-get-categories/ */