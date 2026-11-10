<?php
/**
 * Homepage Template
 */
get_header();

$hero_img = onehit_image_url('onehit_hero_image', 'PhotoConcept1.jpg');
$circle_logo = onehit_image_url('onehit_circle_logo', 'logo-circle.png');
$hero_sub = onehit_get_option('onehit_hero_subtitle', 'Layton, Utah');
$hero_text = onehit_get_option('onehit_hero_text', 'Authentic Kickboxing, Jiu-Jitsu & MMA training for all levels. Build strength, confidence, and discipline in a real fight gym.');
?>

<?php if (isset($_GET['newsletter']) && $_GET['newsletter'] === 'success') : ?>
<div class="newsletter-page-banner" style="position:relative;z-index:40;background:#14532d;border-bottom:3px solid #22c55e;color:#bbf7d0;text-align:center;padding:1rem 1.25rem;">
  <p style="margin:0;font-weight:700;font-size:1.1rem;">You're on the list!</p>
  <p style="margin:0.35rem 0 0;font-size:0.95rem;">Gym updates, schedule changes, and announcements from One Hit MMA will be sent to this email.</p>
</div>
<?php elseif (isset($_GET['newsletter']) && $_GET['newsletter'] === 'error') : ?>
<div class="newsletter-page-banner" style="position:relative;z-index:40;background:#450a0a;border-bottom:3px solid #c41e3a;color:#fecaca;text-align:center;padding:1rem 1.25rem;">
  <p style="margin:0;font-weight:700;">We couldn’t add that email.</p>
  <p style="margin:0.35rem 0 0;font-size:0.95rem;">It may already be on the list, or it wasn’t valid. Please try again below.</p>
</div>
<?php endif; ?>

<!-- Hero -->
<section class="relative min-h-[50vh] sm:min-h-[65vh] md:min-h-screen flex items-center justify-center pt-28 sm:pt-32">
  <div class="absolute inset-0 overflow-hidden">
    <video class="hero-video absolute inset-0 w-full h-full object-cover object-[center_30%]"
           autoplay muted loop playsinline preload="auto" poster="<?php echo esc_url($hero_img); ?>">
      <source src="https://onehitmma.com/wp-content/uploads/2026/09/OneHitMMA_HomeScreen.mp4" type="video/mp4">
    </video>
    <img src="<?php echo esc_url($hero_img); ?>" alt=""
         class="hero-fallback w-full h-full object-cover object-[center_30%]">
    <div class="absolute inset-0 bg-black/50 sm:bg-black/60 md:bg-black/70"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-transparent to-black/20"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/15 via-transparent to-black/15"></div>
  </div>
  
  <div class="relative max-w-6xl mx-auto px-4 text-center">
    <div class="flex justify-center mb-5 sm:mb-6">
      <img src="<?php echo esc_url($circle_logo); ?>" alt="One Hit MMA" 
           class="w-52 sm:w-64 md:w-72 lg:w-80 xl:w-96 h-auto drop-shadow-2xl">
    </div>
    <h1 class="font-display text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-wide mb-4 sm:mb-5">MMA, Kickboxing & Jiu-Jitsu in Layton, Utah</h1>
    <p class="text-brand-red font-display tracking-[0.25em] text-sm sm:text-base md:text-lg uppercase mb-5 sm:mb-6"><?php echo esc_html($hero_sub); ?></p>
    <p class="text-xl sm:text-2xl md:text-3xl text-gray-300 max-w-3xl mx-auto mb-8 sm:mb-10 leading-relaxed">
      <?php echo esc_html($hero_text); ?>
    </p>
    <div class="flex flex-col sm:flex-row gap-4 sm:gap-5 justify-center">
      <a href="#newsletter" 
         class="bg-brand-red hover:bg-red-700 text-white font-display text-lg sm:text-xl tracking-wider px-10 sm:px-12 py-4 sm:py-5 rounded transition transform hover:scale-105">
        SIGN UP FOR NEWSLETTER
      </a>
      <a href="<?php echo esc_url(home_url('/schedule/')); ?>" 
         class="border-2 border-white hover:bg-white hover:text-black font-display text-lg sm:text-xl tracking-wider px-10 sm:px-12 py-4 sm:py-5 rounded transition">
        VIEW SCHEDULE
      </a>
    </div>
    <p class="mt-8 sm:mt-10 text-gray-400 text-sm sm:text-base md:text-lg">
      <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', onehit_get_option('onehit_phone', '8016445707'))); ?>" class="hover:text-white transition">
        <?php echo esc_html(onehit_get_option('onehit_phone', '(801) 644-5707')); ?>
      </a>
      <span class="mx-2">•</span>
      <a href="https://maps.app.goo.gl/MRWUpjn7TbfRGznCA"
         target="_blank" rel="noopener"
         class="hover:text-white underline transition">
        <?php echo esc_html(onehit_get_option('onehit_address', '192 N Fairfield Rd, Suite 2, Layton, UT 84041')); ?>
      </a>
    </p>
  </div>
</section>

<!-- Classes -->
<section class="py-20 bg-brand-gray">
  <div class="max-w-6xl mx-auto px-4">
    <div class="text-center mb-14">
      <h2 class="font-display text-4xl sm:text-5xl font-bold mb-4">TRAIN WITH PURPOSE</h2>
      <p class="text-gray-400 max-w-xl mx-auto">Programs designed for beginners, amateurs, and competitors. All ages and experience levels welcome.</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-6">
      <a href="<?php echo esc_url(home_url('/kickboxing-layton-ut/')); ?>" class="relative overflow-hidden border border-white/10 p-8 rounded-lg hover:border-brand-red/50 transition group min-h-[280px] flex flex-col justify-end block">
        <div class="absolute inset-0">
          <img src="<?php echo esc_url(ONEHIT_URI . '/assets/images/kickboxing-bg-v2.jpg'); ?>" alt="Kickboxing class at One Hit MMA in Layton, Utah" class="w-full h-full object-cover object-center">
          <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/40"></div>
        </div>
        <div class="relative">
          <h3 class="font-display text-2xl font-bold mb-3 text-brand-red">Kickboxing</h3>
          <p class="text-gray-300 text-sm leading-relaxed">High-intensity striking classes that build cardio, power, and real-world self-defense skills. Great for all fitness levels.</p>
        </div>
      </a>
      
      <a href="<?php echo esc_url(home_url('/jiu-jitsu-layton-ut/')); ?>" class="relative overflow-hidden border border-white/10 p-8 rounded-lg hover:border-brand-red/50 transition group min-h-[280px] flex flex-col justify-end block">
        <div class="absolute inset-0">
          <img src="<?php echo esc_url(ONEHIT_URI . '/assets/images/jiujitsu-bg.jpg'); ?>" alt="One Hit MMA jiu-jitsu grappling on the mat" class="w-full h-full object-cover object-center">
          <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/40"></div>
        </div>
        <div class="relative">
          <h3 class="font-display text-2xl font-bold mb-3 text-brand-red">Jiu-Jitsu</h3>
          <p class="text-gray-300 text-sm leading-relaxed">Brazilian Jiu-Jitsu focused on technique, leverage, and control. Learn to defend yourself from any position.</p>
        </div>
      </a>
      
      <a href="<?php echo esc_url(home_url('/kids-martial-arts-layton-ut/')); ?>" class="relative overflow-hidden border border-white/10 p-8 rounded-lg hover:border-brand-red/50 transition group min-h-[280px] flex flex-col justify-end block">
        <div class="absolute inset-0">
          <img src="<?php echo esc_url(ONEHIT_URI . '/assets/images/mma-kids-bg-v2.jpg'); ?>" alt="One Hit MMA kids champions" class="w-full h-full object-cover object-[center_25%]">
          <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/40"></div>
        </div>
        <div class="relative">
          <h3 class="font-display text-2xl font-bold mb-3 text-brand-red">MMA &amp; Kids</h3>
          <p class="text-gray-300 text-sm leading-relaxed">Full MMA training for competitors and adults. Fun, structured kids programs that build confidence and discipline.</p>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- Why Us + Testimonials -->
<section class="py-20">
  <div class="max-w-6xl mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-12 items-center">
      <div>
        <div class="mb-8">
          <p class="text-brand-red font-display font-bold uppercase leading-[0.85] tracking-tight
                    text-4xl sm:text-5xl md:text-6xl lg:text-7xl">
            WHY
          </p>
          <p class="text-brand-red font-display font-bold uppercase leading-[0.85] tracking-tight
                    text-4xl sm:text-5xl md:text-6xl lg:text-7xl">
            ONE HIT
          </p>
          <p class="text-brand-red font-display font-bold uppercase leading-[0.8] tracking-tighter
                    text-6xl sm:text-7xl md:text-8xl lg:text-9xl xl:text-[10rem]">
            MMA?
          </p>
        </div>
        <h2 class="font-display text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold mb-6 leading-tight text-white tracking-wide">
          REAL TRAINING.<br>REAL RESULTS.
        </h2>
        <p class="text-gray-300 mb-6 leading-relaxed">
          Founded by two-time Brazilian National ISKA Champion Aldo Oreggia, One Hit MMA is a no-nonsense training center built for people who want authentic martial arts — not fitness trends.
        </p>
        <p class="text-gray-400 mb-8 leading-relaxed">
          Whether you're a complete beginner, a parent looking for a positive environment for your kids, or a competitor preparing for fights, you'll train with experienced coaches in a supportive, high-energy gym.
        </p>
        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="inline-block border-b-2 border-brand-red text-white font-semibold hover:text-brand-red transition pb-1">
          Meet the coaches →
        </a>
      </div>
      <div class="bg-brand-gray border border-white/10 rounded-lg p-8">
        <h3 class="font-display text-2xl font-bold mb-6">What Members Say</h3>
        <div class="space-y-6">
          <?php
          $testimonials = new WP_Query(array(
              'post_type'      => 'testimonial',
              'posts_per_page' => 3,
              'orderby'        => 'date',
              'order'          => 'DESC',
          ));
          if ($testimonials->have_posts()) :
              while ($testimonials->have_posts()) : $testimonials->the_post();
          ?>
          <blockquote class="border-l-2 border-brand-red pl-4">
            <p class="text-gray-300 text-sm italic mb-2">"<?php echo esc_html(get_the_content()); ?>"</p>
            <cite class="text-xs text-gray-500 not-italic">— <?php the_title(); ?></cite>
          </blockquote>
          <?php
              endwhile;
              wp_reset_postdata();
          else :
              // Fallback static testimonials
          ?>
          <blockquote class="border-l-2 border-brand-red pl-4">
            <p class="text-gray-300 text-sm italic mb-2">"Aldo is the best striking coach in the state. Affordable compared to other gyms as well."</p>
            <cite class="text-xs text-gray-500 not-italic">— William Cochran</cite>
          </blockquote>
          <blockquote class="border-l-2 border-brand-red pl-4">
            <p class="text-gray-300 text-sm italic mb-2">"One Hit MMA gym is now my happy place! I come into the gym feeling excited and ready."</p>
            <cite class="text-xs text-gray-500 not-italic">— Jessica Rose</cite>
          </blockquote>
          <blockquote class="border-l-2 border-brand-red pl-4">
            <p class="text-gray-300 text-sm italic mb-2">"The whole family loves it here. Great place for self-defense and fitness in a fun environment."</p>
            <cite class="text-xs text-gray-500 not-italic">— Megan Vandemyle</cite>
          </blockquote>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Instagram -->
<section class="py-16 bg-brand-gray">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h2 class="font-display text-3xl sm:text-4xl font-bold mb-4">FOLLOW THE GYM</h2>
    <p class="text-gray-400 mb-8">See classes, fights, and gym life on <a href="https://www.instagram.com/1hitmma/" target="_blank" rel="noopener" class="text-brand-red hover:underline">@1hitmma</a></p>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 sm:gap-3 mb-8">
      <?php
      $ig = 'https://www.instagram.com/1hitmma/';
      $tiles = array(
        array('file' => 'ig-masterclass.jpg', 'label' => 'Master class'),
        array('file' => 'mma-kids-bg-v2.jpg', 'label' => 'Kids MMA'),
        array('file' => 'PhotoConcept1.jpg', 'label' => 'Fight night'),
        array('file' => 'aldo-wrapping.jpg', 'label' => 'Training'),
      );
      foreach ($tiles as $tile) :
      ?>
      <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener"
         class="group relative aspect-square overflow-hidden border border-white/10 bg-black">
        <img src="<?php echo esc_url(ONEHIT_URI . '/assets/images/' . $tile['file']); ?>"
             alt="<?php echo esc_attr($tile['label']); ?>"
             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        <span class="absolute inset-0 bg-black/0 group-hover:bg-black/35 transition"></span>
      </a>
      <?php endforeach; ?>
    </div>
    <a href="https://www.instagram.com/1hitmma/" target="_blank" rel="noopener"
       class="inline-block border-2 border-white hover:bg-white hover:text-black font-display tracking-wider px-8 py-3 rounded transition">
      OPEN INSTAGRAM
    </a>
  </div>
</section>

<!-- Newsletter capture -->
<section id="newsletter" class="py-16 bg-brand-red" style="position:relative;z-index:1;scroll-margin-top:8rem;">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <h2 class="font-display text-3xl sm:text-4xl font-bold mb-3">STAY IN THE LOOP</h2>
    <p class="text-white/90 mb-8 text-lg">Gym updates, schedule changes, events, and fight nights — straight to your inbox.</p>
    <div class="bg-black/20 rounded-lg p-6 sm:p-8 max-w-xl mx-auto">
      <?php echo onehit_newsletter_form('homepage'); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
