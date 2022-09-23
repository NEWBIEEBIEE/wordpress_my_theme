<div class="side-box">
    <!-- テンプレートファイル  -->
    <?php if ( is_active_sidebar('main-sidebar') ) : ?>
    <ul class="categories">
        <?php dynamic_sidebar('main-sidebar'); ?>
    </ul>
    <?php endif; ?>
</div>