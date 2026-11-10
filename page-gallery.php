<?php
/**
 * Template Name: Gallery
 * Photo gallery Aldo manages from WP Admin → Gallery
 */
get_header();
$photos = onehit_get_gallery();
?>

<main class="pt-28 sm:pt-32 pb-20">
  <div class="max-w-6xl mx-auto px-4">
    <div class="text-center mb-10 sm:mb-14">
      <p class="text-brand-red font-display tracking-widest text-sm uppercase mb-3">Inside the Gym</p>
      <h1 class="font-display text-4xl sm:text-5xl font-bold mb-4">One Hit MMA Photo Gallery</h1>
      <p class="text-gray-400 max-w-2xl mx-auto">Fights, training, kids classes, and life at One Hit MMA.</p>
    </div>

    <?php if (empty($photos)) : ?>
      <div class="text-center py-20 border border-white/10 rounded-lg bg-brand-gray">
        <p class="text-gray-400 text-lg mb-2">Photos coming soon.</p>
        <p class="text-gray-500 text-sm">Check back for training, fight nights, and gym photos.</p>
      </div>
    <?php else : ?>
      <div class="onehit-gallery-grid" id="onehit-gallery">
        <?php foreach ($photos as $i => $photo) : ?>
          <button type="button"
                  class="onehit-gallery-item"
                  data-index="<?php echo (int) $i; ?>"
                  data-full="<?php echo esc_url($photo['full']); ?>"
                  data-caption="<?php echo esc_attr($photo['caption']); ?>"
                  aria-label="<?php echo esc_attr($photo['caption'] ? $photo['caption'] : 'View photo'); ?>">
            <img src="<?php echo esc_url($photo['thumb']); ?>"
                 alt="<?php echo esc_attr($photo['alt'] ?: $photo['caption']); ?>"
                 loading="lazy">
            <?php if ($photo['caption']) : ?>
              <span class="onehit-gallery-cap"><?php echo esc_html($photo['caption']); ?></span>
            <?php endif; ?>
          </button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</main>

<div id="onehit-lightbox" class="onehit-lightbox" hidden>
  <button type="button" class="onehit-lightbox-close" aria-label="Close">&times;</button>
  <button type="button" class="onehit-lightbox-prev" aria-label="Previous">&#10094;</button>
  <img src="" alt="">
  <button type="button" class="onehit-lightbox-next" aria-label="Next">&#10095;</button>
  <p class="onehit-lightbox-caption"></p>
</div>

<?php get_footer(); ?>
