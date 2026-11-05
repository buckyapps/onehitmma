<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class('bg-brand-dark text-white font-body antialiased' . (onehit_show_notice() ? ' has-notice' : '')); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="fixed top-0 left-0 right-0 z-50">
<?php if (onehit_show_notice()) : 
    $notice_text = onehit_get_option('onehit_notice_text');
    $notice_link = onehit_get_option('onehit_notice_link');
?>
<div id="onehit-notice" class="bg-brand-red text-white text-center text-sm py-2 px-4">
  <?php if ($notice_link) : ?>
    <a href="<?php echo esc_url($notice_link); ?>" class="hover:underline">
      <?php echo esc_html($notice_text); ?>
    </a>
  <?php else : ?>
    <?php echo esc_html($notice_text); ?>
  <?php endif; ?>
</div>
<?php endif; ?>

<!-- Navigation -->
<nav class="bg-black/90 backdrop-blur-md border-b border-white/10">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="relative flex items-center justify-between h-20 sm:h-24 md:h-28 lg:h-32">
      
      <!-- Left spacer to keep logo centered -->
      <div class="w-10 sm:w-12 z-10" aria-hidden="true"></div>
      
      <!-- Centered logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="absolute left-1/2 -translate-x-1/2 flex items-center">
        <img src="<?php echo esc_url(onehit_image_url('onehit_header_logo', 'logo-header-v4.png')); ?>" 
             alt="<?php bloginfo('name'); ?>" 
             class="h-14 sm:h-16 md:h-20 lg:h-24 xl:h-28 w-auto">
      </a>
      
      <!-- Right: Hamburger (all screen sizes) -->
      <div class="flex items-center z-10">
        <button id="mobile-menu-btn" class="p-2 hover:text-brand-red transition" aria-label="Menu" aria-expanded="false">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Collapsible menu (desktop + mobile) -->
  <div id="mobile-menu" class="hidden bg-black border-t border-white/10">
    <div class="max-w-6xl mx-auto px-4 py-5 space-y-1 text-sm sm:text-base font-medium uppercase tracking-wide">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="block py-3 px-2 hover:text-brand-red transition border-b border-white/5">Home</a>
      <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="block py-3 px-2 hover:text-brand-red transition border-b border-white/5">Schedule</a>
      <a href="<?php echo esc_url(home_url('/gallery/')); ?>" class="block py-3 px-2 hover:text-brand-red transition border-b border-white/5">Gallery</a>
      <a href="<?php echo esc_url(home_url('/about/')); ?>" class="block py-3 px-2 hover:text-brand-red transition border-b border-white/5">About</a>
      <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="block py-3 px-2 hover:text-brand-red transition border-b border-white/5">Contact</a>
    </div>
  </div>
</nav>
</header>
