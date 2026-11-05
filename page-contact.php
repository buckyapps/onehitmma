<?php
/**
 * Template Name: Contact
 */
get_header();

$success = isset($_GET['contact']) && $_GET['contact'] === 'success';
?>

<main class="pt-28 sm:pt-32 pb-20">
  <div class="max-w-5xl mx-auto px-4">
    <div class="text-center mb-12">
      <p class="text-brand-red font-display tracking-widest text-sm uppercase mb-3">Get In Touch</p>
      <h1 class="font-display text-4xl sm:text-5xl font-bold mb-4">CONTACT 1 HIT MMA</h1>
      <p class="text-gray-400 max-w-xl mx-auto">Questions about classes, membership, or the gym? Call, email, or send a message below.</p>
    </div>

    <?php if ($success) : ?>
    <div class="mb-10 bg-green-900/40 border border-green-500/40 text-green-200 rounded-lg p-6 text-center">
      <p class="font-semibold text-lg mb-1">Message Sent</p>
      <p class="text-sm">Thanks for reaching out. We’ll get back to you as soon as possible.</p>
    </div>
    <?php endif; ?>

    <div class="grid md:grid-cols-2 gap-10">
      <div class="space-y-8">
        <div>
          <h2 class="font-display text-2xl font-bold mb-4">Contact Info</h2>
          <div class="space-y-4 text-gray-300">
            <p>
              <span class="block text-xs uppercase tracking-wider text-gray-500 mb-1">Phone</span>
              <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', onehit_get_option('onehit_phone', '8016445707'))); ?>" class="text-xl hover:text-brand-red transition">
                <?php echo esc_html(onehit_get_option('onehit_phone', '(801) 644-5707')); ?>
              </a>
            </p>
            <p>
              <span class="block text-xs uppercase tracking-wider text-gray-500 mb-1">Address</span>
              <a href="https://maps.app.goo.gl/MRWUpjn7TbfRGznCA"
                 target="_blank" rel="noopener"
                 class="hover:text-brand-red underline transition">
                <?php echo esc_html(onehit_get_option('onehit_address', '192 N Fairfield Rd Suite 2, Layton, UT 84041')); ?>
              </a>
            </p>
            <p>
              <span class="block text-xs uppercase tracking-wider text-gray-500 mb-1">Email</span>
              <a href="mailto:<?php echo esc_attr(onehit_get_option('onehit_email', 'oreggia@gmail.com')); ?>" class="hover:text-brand-red transition">
                <?php echo esc_html(onehit_get_option('onehit_email', 'oreggia@gmail.com')); ?>
              </a>
            </p>
          </div>
        </div>

        <div id="newsletter" class="bg-brand-gray border border-white/10 rounded-lg p-6" style="position:relative;z-index:1;scroll-margin-top:8rem;">
          <h3 class="font-display text-lg font-bold mb-3">Newsletter</h3>
          <p class="text-sm text-gray-400 mb-4">Get gym updates, schedule changes, and event notices by email.</p>
          <?php echo onehit_newsletter_form('contact-page'); ?>
        </div>
      </div>

      <div class="bg-brand-gray border border-white/10 rounded-lg p-6 sm:p-8">
        <h2 class="font-display text-xl font-bold mb-5">Send a Message</h2>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <input type="hidden" name="action" value="onehit_contact">
          <?php wp_nonce_field('onehit_contact', 'onehit_contact_nonce'); ?>
          <div class="space-y-5">
            <div>
              <label for="name" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Full Name *</label>
              <input type="text" id="name" name="name" required
                class="w-full bg-black border border-white/20 rounded px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-brand-red transition"
                placeholder="Your name">
            </div>
            <div>
              <label for="phone" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Phone *</label>
              <input type="tel" id="phone" name="phone" required
                class="w-full bg-black border border-white/20 rounded px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-brand-red transition"
                placeholder="(801) 555-1234">
            </div>
            <div>
              <label for="email" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Email</label>
              <input type="email" id="email" name="email"
                class="w-full bg-black border border-white/20 rounded px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-brand-red transition"
                placeholder="you@email.com">
            </div>
            <div>
              <label for="interest" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">I’m interested in</label>
              <select id="interest" name="interest"
                class="w-full bg-black border border-white/20 rounded px-4 py-3 text-white focus:outline-none focus:border-brand-red transition">
                <option value="General Question">General Question</option>
                <option value="Kickboxing">Kickboxing</option>
                <option value="Jiu-Jitsu">Jiu-Jitsu</option>
                <option value="MMA">MMA</option>
                <option value="Kids Classes">Kids Classes</option>
                <option value="Membership">Membership</option>
                <option value="Newsletter">Newsletter</option>
              </select>
            </div>
            <div>
              <label for="message" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Message</label>
              <textarea id="message" name="message" rows="4"
                class="w-full bg-black border border-white/20 rounded px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-brand-red transition"
                placeholder="How can we help?"></textarea>
            </div>
            <button type="submit"
              class="w-full bg-brand-red hover:bg-red-700 text-white font-display tracking-wider py-4 rounded transition">
              SEND MESSAGE
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>
