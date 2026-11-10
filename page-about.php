<?php
/**
 * Template Name: About
 */
get_header();
$aldo_img = get_template_directory_uri() . '/assets/images/aldo-wrapping.jpg';
?>

<main class="pt-28 sm:pt-32 pb-20">
  <div class="max-w-5xl mx-auto px-4">
    <div class="text-center mb-12 sm:mb-16">
      <p class="text-brand-red font-display tracking-widest text-sm uppercase mb-3">Our Story</p>
      <h1 class="font-display text-4xl sm:text-5xl font-bold mb-4">About One Hit MMA in Layton, Utah</h1>
    </div>

    <!-- Aldo intro with photo -->
    <div class="grid md:grid-cols-2 gap-10 md:gap-14 items-center mb-16">
      <div class="order-2 md:order-1">
        <p class="text-brand-red font-display tracking-widest text-sm uppercase mb-3">The Founder</p>
        <h2 class="font-display text-3xl sm:text-4xl font-bold mb-5 leading-tight">ALDO OREGGIA</h2>
        <p class="text-gray-300 text-lg leading-relaxed mb-5">
          One Hit MMA was founded with heart, soul, and grit by Layton local and two-time Brazilian National ISKA Champion <strong class="text-white">Aldo Oreggia</strong>. His passion is helping others experience the life-changing benefits of authentic martial arts training.
        </p>
        <p class="text-gray-400 leading-relaxed mb-5">
          Founded by a two-time Brazilian National ISKA Champion, One Hit MMA is a no-nonsense training center built for people who want authentic martial arts — not fitness trends.
        </p>
        <p class="text-gray-400 leading-relaxed">
          Whether you're a complete beginner, a parent looking for a positive environment for your kids, or a competitor preparing for fights, you'll train with experienced coaches in a supportive, high-energy gym.
        </p>
      </div>
      <div class="order-1 md:order-2">
        <div class="rounded-lg overflow-hidden border border-white/10 shadow-2xl">
          <img src="<?php echo esc_url($aldo_img); ?>" 
               alt="Aldo Oreggia at One Hit MMA" 
               class="w-full h-auto object-cover grayscale hover:grayscale-0 transition duration-500">
        </div>
        <p class="text-center text-gray-500 text-xs mt-3 tracking-wide uppercase">Aldo Oreggia — Founder &amp; Coach</p>
      </div>
    </div>

    <!-- Theme copy only. Old Divi page body is not printed. -->
    <div class="space-y-8 text-gray-300 leading-relaxed max-w-3xl mx-auto">
      <p>
        Unlike cookie-cutter fitness studios, One Hit MMA offers real martial arts instruction led by coaches who have trained for years and competed at a high level. We focus on Kickboxing, Jiu-Jitsu, MMA, and structured kids programs in a safe, supportive, family-friendly environment.
      </p>

      <div class="bg-brand-gray border border-white/10 rounded-lg p-8 my-10">
        <h2 class="font-display text-2xl font-bold text-white mb-4">What Makes Us Different</h2>
        <ul class="space-y-3 text-sm">
          <li class="flex gap-3"><span class="text-brand-red font-bold">→</span><span>Authentic technique taught by experienced coaches, not watered-down fitness classes.</span></li>
          <li class="flex gap-3"><span class="text-brand-red font-bold">→</span><span>Training tailored to your goals — whether that’s fitness, self-defense, or competition.</span></li>
          <li class="flex gap-3"><span class="text-brand-red font-bold">→</span><span>You choose your level of contact. Sparring is optional.</span></li>
          <li class="flex gap-3"><span class="text-brand-red font-bold">→</span><span>Strong community atmosphere that treats beginners and veterans with equal respect.</span></li>
          <li class="flex gap-3"><span class="text-brand-red font-bold">→</span><span>Kids programs that build confidence, discipline, and self-control in a fun environment.</span></li>
        </ul>
      </div>

      <h2 class="font-display text-3xl font-bold text-white pt-2">Who We Train</h2>
      <p>
        Professionals, amateurs, and complete beginners. Men, women, and children. We have helped people of all ages, backgrounds, and skill levels reach their personal goals — from getting in the best shape of their lives to competing and winning fights.
      </p>
      <p>
        Martial arts training develops physical fitness, practical self-defense skills, and mental strength. It isn’t only about fighting. At One Hit MMA you decide how hard you want to push and how much contact you want.
      </p>
    </div>

    <div class="mt-14 text-center">
      <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" 
         class="inline-block bg-brand-red hover:bg-red-700 text-white font-display tracking-wider px-10 py-4 rounded transition">
        CONTACT THE GYM
      </a>
    </div>
  </div>
</main>

<?php get_footer(); ?>
