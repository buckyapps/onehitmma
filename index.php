<?php
/**
 * Main fallback template
 */
get_header();
?>

<main class="pt-28 sm:pt-32 pb-20">
  <div class="max-w-4xl mx-auto px-4">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article class="mb-12">
          <h1 class="font-display text-4xl font-bold mb-6"><?php the_title(); ?></h1>
          <div class="prose prose-invert max-w-none text-gray-300">
            <?php the_content(); ?>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p class="text-gray-400">No content found.</p>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>
