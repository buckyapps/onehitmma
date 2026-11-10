<?php
/**
 * Template Name: Coaches
 */
get_header();

$coaches = array(
  array(
    'name'  => 'Aldo Oreggia',
    'role'  => 'Founder · Kickboxing & MMA',
    'photo' => 'https://onehitmma.com/wp-content/uploads/2014/10/Coach-Aldo-working-one-on-one-v2.jpg',
    'meta'  => 'São Paulo, Brazil',
    'bio'   => 'Aldo is a 4th degree kickboxing black belt, Kyokushin black belt, and two-time Brazilian National ISKA Champion. He built One Hit MMA around real training — not fitness trends.',
  ),
  array(
    'name'  => 'Gustavo Rodrigues',
    'role'  => 'Brazilian Jiu-Jitsu',
    'photo' => 'https://onehitmma.com/wp-content/uploads/2014/10/Gustavo2.jpg',
    'meta'  => 'Santos, Brazil',
    'bio'   => 'Gustavo is a Jiu-Jitsu black belt who started in Santos, Brazil in 1995. He is a three-time state champion and teaches Gi and No-Gi.',
  ),
  array(
    'name'  => 'Crystal Olson-Smith',
    'role'  => 'Kickboxing & Conditioning',
    'photo' => 'https://onehitmma.com/wp-content/uploads/2022/08/Crystal-Olson-Smith-V2.jpg',
    'meta'  => 'Layton, Utah',
    'bio'   => 'Crystal is an ISKA kickboxing black belt under Aldo. She has trained at 1 Hit since 2008 and coaches kickboxing and conditioning.',
  ),
);
?>

<main class="pt-28 sm:pt-32 pb-20">
  <div class="max-w-5xl mx-auto px-4">
    <div class="text-center mb-12 sm:mb-16">
      <p class="text-brand-red font-display tracking-widest text-sm uppercase mb-3">The Team</p>
      <h1 class="font-display text-4xl sm:text-5xl font-bold mb-4">Our Coaches in Layton, Utah</h1>
      <p class="text-gray-400 max-w-2xl mx-auto">Experienced coaches. Real martial arts.</p>
    </div>
    <div class="space-y-14">
      <?php foreach ($coaches as $i => $coach) : ?>
      <div class="grid md:grid-cols-3 gap-8 md:gap-10 items-start<?php echo $i < count($coaches) - 1 ? ' border-b border-white/10 pb-14' : ''; ?>">
        <div>
          <div class="rounded-lg overflow-hidden border border-white/10 bg-brand-gray">
            <img src="<?php echo esc_url($coach['photo']); ?>" alt="<?php echo esc_attr($coach['name']); ?>" class="w-full h-auto object-cover">
          </div>
        </div>
        <div class="md:col-span-2">
          <p class="text-brand-red font-display tracking-widest text-xs uppercase mb-2"><?php echo esc_html($coach['role']); ?></p>
          <h2 class="font-display text-3xl sm:text-4xl font-bold mb-3"><?php echo esc_html($coach['name']); ?></h2>
          <p class="text-gray-500 text-sm mb-4"><?php echo esc_html($coach['meta']); ?></p>
          <p class="text-gray-300 leading-relaxed"><?php echo esc_html($coach['bio']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>
