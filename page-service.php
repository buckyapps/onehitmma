<?php
/**
 * Template Name: Service Page
 * Used for local SEO service pages (Kids, BJJ, Kickboxing, etc.)
 */
get_header();

$title = get_the_title();
$content = get_the_content();
?>

<main class="pt-28 sm:pt-32 pb-20">
  <div class="max-w-4xl mx-auto px-4">
    <div class="text-center mb-10">
      <p class="text-brand-red font-display tracking-widest text-sm uppercase mb-3">One Hit MMA · Layton, Utah</p>
      <h1 class="font-display text-4xl sm:text-5xl font-bold mb-4"><?php echo esc_html($title); ?></h1>
    </div>

    <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed space-y-6">
      <?php echo apply_filters('the_content', $content); ?>
    </div>

    <div class="mt-12 text-center">
      <a href="tel:+18016445707" class="inline-block bg-brand-red hover:bg-red-700 text-white font-display tracking-wider px-10 py-4 rounded transition">
        Call (801) 644-5707
      </a>
      <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="inline-block ml-4 border-2 border-white hover:bg-white hover:text-black font-display tracking-wider px-10 py-4 rounded transition">
        View Schedule
      </a>
    </div>
  </div>
</main>

<?php get_footer(); ?>
