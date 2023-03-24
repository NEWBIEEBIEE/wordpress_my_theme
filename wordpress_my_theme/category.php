<?php get_header(); ?>
<section>
    <?php
    $category = get_the_category();
    $cat_name = $category[0]->cat_name;
    ?>
    <h2 class="cat-name"><?php echo $cat_name; ?></h2>

</section>


<div id="container">
    <main>
    <?php
        $args = array(
            'posts_per_page' => get_option('posts_per_page'), // 表示件数の指定
            'category' => $category[0]->cat_ID, // カテゴリーを指定
            'paged' => get_query_var( 'paged', 1 )
        );
        $posts = get_posts($args);
        foreach($posts as $post):
            setup_postdata($post);
        ?>
        <article class="post-home">
            <div class="post-thumb">

                <?php if(has_post_thumbnail()): ?>
                    <img class="post-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                <?php else: ?>
                    <img class="post-img" src="https://placehold.jp/600x400.png">
                <?php endif; ?>
            </div>
            <div class="post-moji">
                <div class="post-title">
                    <h2 class="stripe"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a><h2>
                </div>

                <p class="post-date"><span><?php echo get_the_date('Y年n月j日'); ?></span></p>
                <p class="post-desc"><?php echo get_the_excerpt(); ?></p>
            </div>
        </article>
        <?php endforeach; ?>
        <?php the_posts_pagination(
            array(
                'mid_size'      => 2, // 現在ページの左右に表示するページ番号の数
                'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
                'prev_text'     => __( '<<'), // 「前へ」リンクのテキスト
                'next_text'     => __( '>>'), // 「次へ」リンクのテキスト
                'type'          => 'list', // 戻り値の指定 (plain/list)
            )
        ); 
        wp_reset_postdata();
         ?>
    </main>
        <?php get_sidebar(); ?>
        <!--
        <div class="side-box">
            <h3>Category</h3>
            <ul class="categories">
                <li><a href="#">猫の種類</a></li>
                <li><a href="#">食事・フード</a></li>
                <li><a href="#">健康・病気</a></li>
                <li><a href="#">猫の生態</a></li>
                <li><a href="#">猫と暮らす</a></li>
            </ul>
        </div>
    -->
</div>






<?php get_footer(); ?>
