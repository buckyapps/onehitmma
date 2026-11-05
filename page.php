<?php
/**
 * Default Page Template
 */
get_header();
?>

<main class="pt-28 sm:pt-32 pb-20">
  <div class="max-w-4xl mx-auto px-4">
    <?php while (have_posts()) : the_post(); ?>
      <h1 class="font-display text-4xl sm:text-5xl font-bold mb-8 text-center"><?php the_title(); ?></h1>
      <?php
        $raw = get_the_content();
        $has_builder = (strpos($raw, 'et_pb_') !== false || strpos($raw, '[et_') !== false);
        if (!$has_builder && trim(wp_strip_all_tags($raw)) !== '') :
      ?>
      <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
        <?php the_content(); ?>
      </div>
      <?php endif; ?>
    <?php endwhile; ?>
  </div>
</main>

<?php get_footer(); ?>
