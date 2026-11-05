<?php
/**
 * Template Name: Schedule
 * Class Schedule Page
 */
get_header();
$schedule = onehit_get_schedule();
$note = get_option('onehit_schedule_note', 'Advanced classes (*) are recommended for fighters and students who have been training 6+ months. Schedule may change — confirm times with the gym.');

// Group rows by day so each day only appears once as a header
$grouped = array();
$day_order = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
$day_labels = array(
    'Monday'    => 'Striking Day',
    'Tuesday'   => 'Grappling & Striking Day',
    'Wednesday' => 'Striking & Grappling Day',
    'Thursday'  => 'Grappling Day',
    'Friday'    => 'Striking & Grappling Day',
    'Saturday'  => 'Grappling Day',
    'Sunday'    => '',
);

foreach ($schedule as $row) {
    $day = $row['day'];
    if (!isset($grouped[$day])) {
        $grouped[$day] = array();
    }
    $grouped[$day][] = $row;
}

// Keep days in correct order
$ordered = array();
foreach ($day_order as $d) {
    if (isset($grouped[$d])) {
        $ordered[$d] = $grouped[$d];
    }
}
// Any unexpected days at the end
foreach ($grouped as $d => $rows) {
    if (!isset($ordered[$d])) {
        $ordered[$d] = $rows;
    }
}
?>

<main class="pt-28 sm:pt-32 pb-20">
  <div class="max-w-5xl mx-auto px-4">
    <div class="text-center mb-12">
      <p class="text-brand-red font-display tracking-widest text-sm uppercase mb-3">Weekly Classes</p>
      <h1 class="font-display text-4xl sm:text-5xl font-bold mb-4">CLASS SCHEDULE</h1>
      <p class="text-gray-400 max-w-xl mx-auto">Drop-ins and new members welcome. Call or message us to confirm current times.</p>
    </div>

    <div class="space-y-6">
      <?php foreach ($ordered as $day => $rows) :
        $subtitle = isset($day_labels[$day]) ? $day_labels[$day] : '';
      ?>
      <div class="rounded-lg border border-white/10 overflow-hidden">
        <!-- Day header – shown only once -->
        <div class="bg-brand-gray px-5 py-4 font-display tracking-wide">
          <span class="text-white text-lg sm:text-xl uppercase"><?php echo esc_html($day); ?></span><?php if ($subtitle) : ?><span class="text-white text-lg sm:text-xl"> – </span><span class="text-brand-red text-lg sm:text-xl normal-case"><?php echo esc_html($subtitle); ?></span><?php endif; ?>
        </div>

        <!-- Classes for this day -->
        <div class="divide-y divide-white/5">
          <?php foreach ($rows as $row) :
            $is_advanced = (stripos($row['level'], 'Advanced') !== false);
            $class_name  = esc_html($row['class']);
            if ($is_advanced) {
                $class_name .= ' <span class="text-brand-red">*</span>';
            }
          ?>
          <div class="flex flex-wrap sm:flex-nowrap items-center px-5 py-3.5 gap-y-1 hover:bg-white/5 transition">
            <div class="w-24 shrink-0 text-gray-300 text-sm"><?php echo esc_html($row['time']); ?></div>
            <div class="flex-1 font-medium min-w-[140px]"><?php echo $class_name; ?></div>
            <div class="text-gray-500 text-xs sm:text-sm sm:text-right w-full sm:w-auto"><?php echo esc_html($row['level']); ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if ($note) : ?>
    <p class="text-center text-gray-500 text-sm mt-8 leading-relaxed">
      <span class="text-brand-red">*</span> <?php echo esc_html($note); ?>
    </p>
    <?php endif; ?>

    <div class="mt-12 text-center">
      <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" 
         class="inline-block bg-brand-red hover:bg-red-700 text-white font-display tracking-wider px-10 py-4 rounded transition">
        CONTACT THE GYM
      </a>
    </div>
  </div>
</main>

<?php get_footer(); ?>
