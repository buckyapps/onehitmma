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

    <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed space-y-6 text-center">
      <?php echo apply_filters('the_content', $content); ?>
    </div>

    <div class="mt-10 text-center space-y-3">
      <p class="text-gray-400 text-sm uppercase tracking-wider">Visit Us</p>
      <p>
        <a href="https://maps.app.goo.gl/MRWUpjn7TbfRGznCA"
           target="_blank" rel="noopener"
           class="text-brand-red text-xl sm:text-2xl font-semibold underline hover:text-red-400 transition">
          192 N Fairfield Rd, Suite 2<br class="sm:hidden"> Layton, UT 84041
        </a>
      </p>
      <p>
        <a href="tel:+18016445707"
           class="text-brand-red text-2xl sm:text-3xl font-bold underline hover:text-red-400 transition">
          (801) 644-5707
        </a>
      </p>
    </div>

    <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
      <a href="tel:+18016445707" class="inline-block bg-brand-red hover:bg-red-700 text-white font-display tracking-wider px-10 py-4 rounded transition w-full sm:w-auto text-center">
        Call (801) 644-5707
      </a>
      <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="inline-block border-2 border-white hover:bg-white hover:text-black font-display tracking-wider px-10 py-4 rounded transition w-full sm:w-auto text-center">
        View Schedule
      </a>
    </div>
  </div>
</main>

<?php get_footer(); ?>
