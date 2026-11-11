<!-- Footer -->
<footer class="bg-black border-t border-white/10 py-12">
  <div class="max-w-6xl mx-auto px-4">
    <div class="grid md:grid-cols-3 gap-8 mb-10">
      <div>
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img src="<?php echo esc_url(onehit_image_url('onehit_header_logo', 'logo-header-v4.png')); ?>" 
               alt="<?php bloginfo('name'); ?>" 
               class="h-9 w-auto mb-4">
        </a>
        <p class="text-gray-400 text-sm leading-relaxed">Premier martial arts training in Layton, Utah. Kickboxing, Jiu-Jitsu, MMA &amp; kids programs.</p>
      </div>
      <div>
        <h4 class="font-display font-display text-sm tracking-widest uppercase mb-4 text-gray-300">Visit Us</h4>
        <p class="text-gray-300 text-base sm:text-lg">
          <a href="https://maps.app.goo.gl/MRWUpjn7TbfRGznCA"
             target="_blank" rel="noopener"
             class="font-bold text-white underline hover:text-brand-red transition">
            <?php echo esc_html(onehit_get_option('onehit_address', '192 N Fairfield Rd Suite 2, Layton, UT 84041')); ?>
          </a>
          <br>
          <a href="https://maps.app.goo.gl/MRWUpjn7TbfRGznCA" target="_blank" rel="noopener" class="text-sm underline hover:text-brand-red transition">Get Directions</a>
          <br><br>
          <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', onehit_get_option('onehit_phone', '8016445707'))); ?>" class="underline hover:text-brand-red transition">
            <?php echo esc_html(onehit_get_option('onehit_phone', '(801) 644-5707')); ?>
          </a>
          <br>
          <a href="https://share.google/aimode/iIonZuQEzJO3Ahz0y" target="_blank" rel="noopener" class="inline-block mt-3 text-brand-red text-lg sm:text-xl font-bold underline hover:text-red-400 transition">
            Leave a Google Review
          </a>
        </p>
      </div>
      <div>
        <h4 class="font-display text-sm tracking-widest uppercase mb-4 text-gray-300">Quick Links</h4>
        <div class="space-y-2 text-sm text-gray-400">
          <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="block hover:text-white transition">Class Schedule</a>
          <a href="<?php echo esc_url(home_url('/kickboxing-layton-ut/')); ?>" class="block hover:text-white transition">Kickboxing</a>
          <a href="<?php echo esc_url(home_url('/jiu-jitsu-layton-ut/')); ?>" class="block hover:text-white transition">Jiu-Jitsu</a>
          <a href="<?php echo esc_url(home_url('/kids-martial-arts-layton-ut/')); ?>" class="block hover:text-white transition">Kids Martial Arts</a>
          <a href="<?php echo esc_url(home_url('/gallery/')); ?>" class="block hover:text-white transition">Gallery</a>
          <a href="<?php echo esc_url(home_url('/about/')); ?>" class="block hover:text-white transition">About &amp; Coaches</a>
          <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="block hover:text-white transition">Contact / Newsletter</a>
        </div>
      </div>
    </div>
    <div class="border-t border-white/10 pt-6 text-center text-xs text-gray-500">
      &copy; <?php echo date('Y'); ?> One Hit MMA. All rights reserved. &nbsp;|&nbsp; Layton, Utah
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
