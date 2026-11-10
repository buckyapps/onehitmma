<?php
/**
 * 1 Hit MMA Theme Functions
 * Modern martial arts gym theme for Aldo Oreggia / One Hit MMA
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ONEHIT_VERSION', '1.6.8');
define('ONEHIT_DIR', get_template_directory());
define('ONEHIT_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function onehit_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'
    ));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'onehitmma'),
        'footer'  => __('Footer Menu', 'onehitmma'),
    ));
}
add_action('after_setup_theme', 'onehit_setup');

/**
 * Enqueue scripts and styles
 */
function onehit_scripts() {
    // Tailwind via CDN for rapid development (can be replaced with compiled CSS later)
    wp_enqueue_style('onehit-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Oswald:wght@500;600;700&display=swap', array(), null);
    wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com', array(), null, false);

    wp_enqueue_style('onehit-main', ONEHIT_URI . '/assets/css/main.css', array(), ONEHIT_VERSION);
    wp_enqueue_script('onehit-main', ONEHIT_URI . '/assets/js/main.js', array(), ONEHIT_VERSION, true);

    // Pass data to JS if needed
    wp_localize_script('onehit-main', 'onehitData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'homeUrl' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'onehit_scripts');

/**
 * Tailwind config in head
 */
function onehit_tailwind_config() {
    ?>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            red: '#c41e3a',
                            dark: '#0a0a0a',
                            gray: '#1a1a1a'
                        }
                    },
                    fontFamily: {
                        display: ['Oswald', 'sans-serif'],
                        body: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <?php
}
add_action('wp_head', 'onehit_tailwind_config', 5);

/**
 * =====================================================
 * THEME OPTIONS / CUSTOMIZER
 * =====================================================
 */
function onehit_customize_register($wp_customize) {

    // ----- Contact Info Section -----
    $wp_customize->add_section('onehit_contact', array(
        'title'    => __('Contact Info', 'onehitmma'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('onehit_phone', array(
        'default'           => '(801) 644-5707',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('onehit_phone', array(
        'label'   => __('Phone Number', 'onehitmma'),
        'section' => 'onehit_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('onehit_address', array(
        'default'           => '192 N Fairfield Rd Suite 2, Layton, UT 84041',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('onehit_address', array(
        'label'   => __('Address', 'onehitmma'),
        'section' => 'onehit_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('onehit_email', array(
        'default'           => 'oreggia@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('onehit_email', array(
        'label'   => __('Email', 'onehitmma'),
        'section' => 'onehit_contact',
        'type'    => 'email',
    ));

    // ----- Logos Section -----
    $wp_customize->add_section('onehit_logos', array(
        'title'    => __('Logos', 'onehitmma'),
        'priority' => 31,
    ));

    $wp_customize->add_setting('onehit_header_logo', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'onehit_header_logo', array(
        'label'     => __('Header Logo (horizontal)', 'onehitmma'),
        'section'   => 'onehit_logos',
        'mime_type' => 'image',
    )));

    $wp_customize->add_setting('onehit_circle_logo', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'onehit_circle_logo', array(
        'label'     => __('Circular Badge Logo (homepage hero)', 'onehitmma'),
        'section'   => 'onehit_logos',
        'mime_type' => 'image',
    )));

    // ----- Notification Bar -----
    $wp_customize->add_section('onehit_notice', array(
        'title'       => __('Top Notification Bar', 'onehitmma'),
        'description' => __('Show a site-wide notice (holiday closures, schedule changes, etc.). Set an end date and it will automatically disappear.', 'onehitmma'),
        'priority'    => 32,
    ));

    $wp_customize->add_setting('onehit_notice_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('onehit_notice_enabled', array(
        'label'   => __('Enable Notification Bar', 'onehitmma'),
        'section' => 'onehit_notice',
        'type'    => 'checkbox',
    ));

    $wp_customize->add_setting('onehit_notice_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('onehit_notice_text', array(
        'label'   => __('Notice Message', 'onehitmma'),
        'section' => 'onehit_notice',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('onehit_notice_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('onehit_notice_link', array(
        'label'   => __('Optional Link URL', 'onehitmma'),
        'section' => 'onehit_notice',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('onehit_notice_start', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('onehit_notice_start', array(
        'label'       => __('Start Date (YYYY-MM-DD)', 'onehitmma'),
        'section'     => 'onehit_notice',
        'type'        => 'date',
        'description' => __('Leave blank to start immediately.', 'onehitmma'),
    ));

    $wp_customize->add_setting('onehit_notice_end', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('onehit_notice_end', array(
        'label'       => __('End Date (YYYY-MM-DD)', 'onehitmma'),
        'section'     => 'onehit_notice',
        'type'        => 'date',
        'description' => __('The notice will automatically hide after this date.', 'onehitmma'),
    ));

    // ----- Homepage Hero -----
    $wp_customize->add_section('onehit_hero', array(
        'title'    => __('Homepage Hero', 'onehitmma'),
        'priority' => 33,
    ));

    $wp_customize->add_setting('onehit_hero_image', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'onehit_hero_image', array(
        'label'     => __('Hero Background Image', 'onehitmma'),
        'section'   => 'onehit_hero',
        'mime_type' => 'image',
    )));

    $wp_customize->add_setting('onehit_hero_subtitle', array(
        'default'           => 'Layton, Utah',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('onehit_hero_subtitle', array(
        'label'   => __('Hero Subtitle (location line)', 'onehitmma'),
        'section' => 'onehit_hero',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('onehit_hero_text', array(
        'default'           => 'Authentic Kickboxing, Jiu-Jitsu & MMA training for all levels. Build strength, confidence, and discipline in a real fight gym.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('onehit_hero_text', array(
        'label'   => __('Hero Description', 'onehitmma'),
        'section' => 'onehit_hero',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'onehit_customize_register');

/**
 * Helper: Get theme option with fallback
 */
function onehit_get_option($key, $default = '') {
    return get_theme_mod($key, $default);
}

/**
 * Helper: Should the notification bar show?
 */
function onehit_show_notice() {
    $enabled = onehit_get_option('onehit_notice_enabled');
    if (!$enabled || $enabled === '0' || $enabled === 'false') {
        return false;
    }
    $text = trim((string) onehit_get_option('onehit_notice_text'));
    if ($text === '') {
        return false;
    }

    $today = current_time('Y-m-d');
    $start = trim((string) onehit_get_option('onehit_notice_start'));
    $end   = trim((string) onehit_get_option('onehit_notice_end'));

    if ($start !== '' && $today < $start) {
        return false;
    }
    if ($end !== '' && $today > $end) {
        return false;
    }
    return true;
}

function onehit_notice_hidden_reason() {
    $enabled = onehit_get_option('onehit_notice_enabled');
    $text = trim((string) onehit_get_option('onehit_notice_text'));
    $today = current_time('Y-m-d');
    $start = trim((string) onehit_get_option('onehit_notice_start'));
    $end = trim((string) onehit_get_option('onehit_notice_end'));
    if (!$enabled || $enabled === '0' || $enabled === 'false') {
        return 'The “Show this announcement” box is unchecked.';
    }
    if ($text === '') {
        return 'The message box is empty.';
    }
    if ($start !== '' && $today < $start) {
        return 'Start date is in the future (' . $start . '). Today is ' . $today . '.';
    }
    if ($end !== '' && $today > $end) {
        return 'End date already passed (' . $end . '). Today is ' . $today . '.';
    }
    return '';
}

/**
 * =====================================================
 * ANNOUNCEMENTS (top red bar — easy admin page for Aldo)
 * =====================================================
 */
function onehit_announcements_menu() {
    add_menu_page(
        __('Announcements', 'onehitmma'),
        __('Announcements', 'onehitmma'),
        'edit_theme_options',
        'onehit-announcements',
        'onehit_announcements_page',
        'dashicons-megaphone',
        24
    );
}
add_action('admin_menu', 'onehit_announcements_menu');

function onehit_announcements_page() {
    if (!current_user_can('edit_theme_options')) {
        return;
    }

    if (isset($_POST['onehit_notice_nonce']) && wp_verify_nonce($_POST['onehit_notice_nonce'], 'onehit_save_notice')) {
        $enabled = !empty($_POST['notice_enabled']);
        $text    = sanitize_text_field(wp_unslash($_POST['notice_text'] ?? ''));
        $link    = esc_url_raw(wp_unslash($_POST['notice_link'] ?? ''));
        $start   = sanitize_text_field(wp_unslash($_POST['notice_start'] ?? ''));
        $end     = sanitize_text_field(wp_unslash($_POST['notice_end'] ?? ''));

        set_theme_mod('onehit_notice_enabled', $enabled);
        set_theme_mod('onehit_notice_text', $text);
        set_theme_mod('onehit_notice_link', $link);
        set_theme_mod('onehit_notice_start', $start);
        set_theme_mod('onehit_notice_end', $end);

        echo '<div class="notice notice-success is-dismissible"><p>Announcement saved.</p></div>';
    }

    $enabled = onehit_get_option('onehit_notice_enabled');
    $text    = onehit_get_option('onehit_notice_text');
    $link    = onehit_get_option('onehit_notice_link');
    $start   = onehit_get_option('onehit_notice_start');
    $end     = onehit_get_option('onehit_notice_end');
    $live    = onehit_show_notice();
    ?>
    <div class="wrap" style="max-width:720px;">
        <h1>Announcements</h1>
        <p>This is the red bar at the very top of the website. Use it for holiday closures, schedule changes, or reminders.</p>

        <?php if ($live) : ?>
            <div class="notice notice-info"><p><strong>Currently showing on the site:</strong> <?php echo esc_html($text); ?></p></div>
        <?php else : ?>
            <div class="notice notice-warning"><p><strong>Not showing on the site.</strong> <?php echo esc_html(onehit_notice_hidden_reason() ?: 'No announcement is showing right now.'); ?> After saving, flush GoDaddy cache if the homepage still looks old.</p></div>
        <?php endif; ?>

        <form method="post" style="background:#fff;border:1px solid #c3c4c7;padding:20px 24px;margin-top:16px;">
            <?php wp_nonce_field('onehit_save_notice', 'onehit_notice_nonce'); ?>

            <p>
                <label style="font-size:15px;">
                    <input type="checkbox" name="notice_enabled" value="1" <?php checked($enabled); ?> style="margin-right:8px;">
                    <strong>Show this announcement on the website</strong>
                </label>
            </p>

            <p>
                <label for="notice_text"><strong>Message</strong></label><br>
                <textarea id="notice_text" name="notice_text" rows="3" class="large-text" placeholder="Example: Closed Monday for Labor Day. Regular classes resume Tuesday."><?php echo esc_textarea($text); ?></textarea>
            </p>

            <p>
                <label for="notice_link"><strong>Optional link</strong> <span class="description">(leave blank if you don’t need one)</span></label><br>
                <input type="url" id="notice_link" name="notice_link" class="regular-text" value="<?php echo esc_attr($link); ?>" placeholder="https://onehitmma.com/schedule/">
            </p>

            <p>
                <label for="notice_start"><strong>Start date</strong> <span class="description">(leave blank to show as soon as you save)</span></label><br>
                <input type="date" id="notice_start" name="notice_start" value="<?php echo esc_attr($start); ?>">
            </p>

            <p>
                <label for="notice_end"><strong>End date</strong> <span class="description">(the bar hides automatically after this day)</span></label><br>
                <input type="date" id="notice_end" name="notice_end" value="<?php echo esc_attr($end); ?>">
            </p>

            <p class="submit" style="margin-bottom:0;">
                <input type="submit" class="button button-primary button-hero" value="Save Announcement">
            </p>
        </form>

        <p class="description" style="margin-top:16px;">To take it down early: uncheck “Show this announcement” and save.</p>
    </div>
    <?php
}

/**
 * =====================================================
 * CUSTOM POST TYPES
 * =====================================================
 */

/**
 * Testimonials CPT
 */
function onehit_register_testimonials() {
    $labels = array(
        'name'          => __('Testimonials', 'onehitmma'),
        'singular_name' => __('Testimonial', 'onehitmma'),
        'add_new_item'  => __('Add New Testimonial', 'onehitmma'),
        'edit_item'     => __('Edit Testimonial', 'onehitmma'),
        'menu_name'     => __('Testimonials', 'onehitmma'),
    );
    $args = array(
        'labels'       => $labels,
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-format-quote',
        'supports'     => array('title', 'editor'),
        'has_archive'  => false,
    );
    register_post_type('testimonial', $args);
}
add_action('init', 'onehit_register_testimonials');

/**
 * Class Schedule CPT (or we can use options – CPT is more flexible)
 * Using a simple options page approach is often easier for Aldo.
 * We'll provide both: a Schedule Options page + ability to manage rows.
 */

/**
 * =====================================================
 * SCHEDULE MANAGEMENT (Options Page – easiest for Aldo)
 * =====================================================
 */
function onehit_schedule_menu() {
    add_menu_page(
        __('Class Schedule', 'onehitmma'),
        __('Class Schedule', 'onehitmma'),
        'edit_theme_options',
        'onehit-schedule',
        'onehit_schedule_page',
        'dashicons-calendar-alt',
        26
    );
}
add_action('admin_menu', 'onehit_schedule_menu');

function onehit_schedule_page() {
    if (!current_user_can('edit_theme_options')) {
        return;
    }

    // Save
    if (isset($_POST['onehit_schedule_nonce']) && wp_verify_nonce($_POST['onehit_schedule_nonce'], 'onehit_save_schedule')) {
        $rows = array();
        if (!empty($_POST['day']) && is_array($_POST['day'])) {
            foreach ($_POST['day'] as $i => $day) {
                $day = sanitize_text_field($day);
                $time = sanitize_text_field($_POST['time'][$i] ?? '');
                $class = sanitize_text_field($_POST['class'][$i] ?? '');
                $level = sanitize_text_field($_POST['level'][$i] ?? '');
                if ($day || $time || $class) {
                    $rows[] = compact('day', 'time', 'class', 'level');
                }
            }
        }
        update_option('onehit_schedule_rows', $rows);
        update_option('onehit_schedule_note', sanitize_textarea_field($_POST['schedule_note'] ?? ''));
        echo '<div class="notice notice-success"><p>Schedule saved.</p></div>';
    }

    $rows = get_option('onehit_schedule_rows', onehit_default_schedule());
    $note = get_option('onehit_schedule_note', 'Advanced classes (*) are recommended for fighters and students who have been training 6+ months. Schedule may change — confirm times with the gym.');
    ?>
    <div class="wrap">
        <h1>Class Schedule</h1>
        <p>Edit the weekly class schedule here. Add or remove rows as needed. Changes appear on the Schedule page immediately.</p>
        <form method="post">
            <?php wp_nonce_field('onehit_save_schedule', 'onehit_schedule_nonce'); ?>
            <table class="widefat striped" id="schedule-table">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Class</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $i => $row) : ?>
                    <tr>
                        <td><input type="text" name="day[]" value="<?php echo esc_attr($row['day']); ?>" class="regular-text"></td>
                        <td><input type="text" name="time[]" value="<?php echo esc_attr($row['time']); ?>" class="regular-text"></td>
                        <td><input type="text" name="class[]" value="<?php echo esc_attr($row['class']); ?>" class="regular-text"></td>
                        <td><input type="text" name="level[]" value="<?php echo esc_attr($row['level']); ?>" class="regular-text"></td>
                        <td><button type="button" class="button remove-row">Remove</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><button type="button" class="button" id="add-row">+ Add Class</button></p>
            <h2>Schedule Note</h2>
            <textarea name="schedule_note" rows="3" class="large-text"><?php echo esc_textarea($note); ?></textarea>
            <p class="submit"><input type="submit" class="button button-primary" value="Save Schedule"></p>
        </form>
    </div>
    <script>
    document.getElementById('add-row').addEventListener('click', function() {
        var tbody = document.querySelector('#schedule-table tbody');
        var tr = document.createElement('tr');
        tr.innerHTML = '<td><input type="text" name="day[]" class="regular-text"></td><td><input type="text" name="time[]" class="regular-text"></td><td><input type="text" name="class[]" class="regular-text"></td><td><input type="text" name="level[]" class="regular-text"></td><td><button type="button" class="button remove-row">Remove</button></td>';
        tbody.appendChild(tr);
    });
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
    </script>
    <?php
}

function onehit_default_schedule() {
    return array(
        // Monday – Striking Day
        array('day' => 'Monday',    'time' => '10:30 AM', 'class' => 'Kickboxing',                    'level' => 'All Levels'),
        array('day' => 'Monday',    'time' => '4:15 PM',  'class' => 'Kids Kickboxing',               'level' => 'Kids'),
        array('day' => 'Monday',    'time' => '5:00 PM',  'class' => 'Kickboxing',                    'level' => 'All Levels'),
        array('day' => 'Monday',    'time' => '6:00 PM',  'class' => 'MMA',                           'level' => 'Advanced'),
        // Tuesday – Grappling & Striking Day
        array('day' => 'Tuesday',   'time' => '6:00 AM',  'class' => 'Kickboxing',                    'level' => 'All Levels'),
        array('day' => 'Tuesday',   'time' => '10:30 AM', 'class' => 'Gi Jiu-Jitsu',                  'level' => 'All Levels'),
        array('day' => 'Tuesday',   'time' => '4:30 PM',  'class' => 'Kids Gi Jiu-Jitsu',             'level' => 'Kids'),
        array('day' => 'Tuesday',   'time' => '5:30 PM',  'class' => 'Gi Jiu-Jitsu',                  'level' => 'All Levels'),
        array('day' => 'Tuesday',   'time' => '6:30 PM',  'class' => 'Wrestling',                     'level' => 'All Levels'),
        // Wednesday – Striking & Grappling Day
        array('day' => 'Wednesday', 'time' => '6:00 AM',  'class' => 'No Gi Jiu-Jitsu Open Mat',      'level' => 'Students Only'),
        array('day' => 'Wednesday', 'time' => '10:30 AM', 'class' => 'Sparring Kickboxing',           'level' => 'Advanced'),
        array('day' => 'Wednesday', 'time' => '4:30 PM',  'class' => 'Kids Sparring Kickboxing',      'level' => 'Advanced Kids'),
        array('day' => 'Wednesday', 'time' => '5:30 PM',  'class' => 'Sparring Kickboxing',           'level' => 'Advanced'),
        array('day' => 'Wednesday', 'time' => '6:30 PM',  'class' => 'No Gi Jiu-Jitsu',               'level' => 'All Levels'),
        // Thursday – Grappling Day
        array('day' => 'Thursday',  'time' => '10:30 AM', 'class' => 'Gi Jiu-Jitsu',                  'level' => 'All Levels'),
        array('day' => 'Thursday',  'time' => '4:30 PM',  'class' => 'Kids Gi Jiu-Jitsu',             'level' => 'Kids'),
        array('day' => 'Thursday',  'time' => '5:30 PM',  'class' => 'Gi Jiu-Jitsu',                  'level' => 'All Levels'),
        array('day' => 'Thursday',  'time' => '6:30 PM',  'class' => 'Wrestling',                     'level' => 'All Levels'),
        // Friday – Striking & Grappling Day
        array('day' => 'Friday',    'time' => '10:30 AM', 'class' => 'Kickboxing',                    'level' => 'All Levels'),
        array('day' => 'Friday',    'time' => '5:30 PM',  'class' => 'No Gi Jiu-Jitsu',               'level' => 'All Levels'),
        // Saturday – Grappling Day
        array('day' => 'Saturday',  'time' => '10:00 AM', 'class' => 'No Gi Jiu-Jitsu',               'level' => 'All Levels'),
    );
}

function onehit_get_schedule() {
    $rows = get_option('onehit_schedule_rows');
    if (empty($rows)) {
        $rows = onehit_default_schedule();
    }
    return $rows;
}

/**
 * =====================================================
 * CONTACT FORM HANDLER (sends to Aldo's email)
 * =====================================================
 */
function onehit_handle_contact_form() {
    if (!isset($_POST['onehit_contact_nonce']) || !wp_verify_nonce($_POST['onehit_contact_nonce'], 'onehit_contact')) {
        wp_die('Security check failed');
    }

    $name     = sanitize_text_field($_POST['name'] ?? '');
    $phone    = sanitize_text_field($_POST['phone'] ?? '');
    $email    = sanitize_email($_POST['email'] ?? '');
    $interest = sanitize_text_field($_POST['interest'] ?? '');
    $message  = sanitize_textarea_field($_POST['message'] ?? '');

    $to = onehit_get_option('onehit_email', get_option('admin_email'));
    $subject = '1 Hit MMA – Contact Form from ' . $name;
    $body = "New contact form submission:\n\n";
    $body .= "Name: $name\n";
    $body .= "Phone: $phone\n";
    $body .= "Email: $email\n";
    $body .= "Interest: $interest\n\n";
    $body .= "Message:\n$message\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8');
    if ($email) {
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    }

    wp_mail($to, $subject, $body, $headers);

    wp_redirect(add_query_arg('contact', 'success', home_url('/contact-us/')));
    exit;
}
add_action('admin_post_onehit_contact', 'onehit_handle_contact_form');
add_action('admin_post_nopriv_onehit_contact', 'onehit_handle_contact_form');

/**
 * Helper: Image URL from theme mod or fallback
 */
function onehit_image_url($mod_key, $fallback_filename) {
    $id = onehit_get_option($mod_key);
    if ($id) {
        $url = wp_get_attachment_image_url($id, 'full');
        if ($url) return $url;
    }
    return ONEHIT_URI . '/assets/images/' . $fallback_filename;
}

/**
 * =====================================================
 * GALLERY (Aldo adds photos in WP Admin → Gallery)
 * =====================================================
 */
function onehit_gallery_menu() {
    add_menu_page(
        __('Gallery', 'onehitmma'),
        __('Gallery', 'onehitmma'),
        'edit_theme_options',
        'onehit-gallery',
        'onehit_gallery_page',
        'dashicons-format-gallery',
        25
    );
}
add_action('admin_menu', 'onehit_gallery_menu');

function onehit_gallery_admin_assets($hook) {
    if ($hook !== 'toplevel_page_onehit-gallery') {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'onehit_gallery_admin_assets');

function onehit_get_gallery() {
    $ids      = get_option('onehit_gallery_ids', array());
    $captions = get_option('onehit_gallery_captions', array());
    if (!is_array($ids)) {
        $ids = array();
    }
    if (!is_array($captions)) {
        $captions = array();
    }

    $items = array();
    foreach ($ids as $id) {
        $id = absint($id);
        if (!$id) {
            continue;
        }
        $full = wp_get_attachment_image_url($id, 'full');
        if (!$full) {
            continue;
        }
        $thumb = wp_get_attachment_image_url($id, 'large');
        $alt   = get_post_meta($id, '_wp_attachment_image_alt', true);
        if (!$alt) {
            $filename = basename(get_attached_file($id) ?: '');
            $alt = $filename ? 'Photo from One Hit MMA in Layton, Utah (' . pathinfo($filename, PATHINFO_FILENAME) . ')' : 'Training or class photo at One Hit MMA in Layton, Utah';
        }
        $items[] = array(
            'id'      => $id,
            'thumb'   => $thumb ? $thumb : $full,
            'full'    => $full,
            'caption' => isset($captions[$id]) ? $captions[$id] : '',
            'alt'     => $alt,
        );
    }
    return $items;
}

function onehit_ensure_gallery_page() {
    if (get_option('onehit_gallery_page_ready')) {
        $existing = get_page_by_path('gallery');
        if ($existing) {
            return;
        }
    }

    $existing = get_page_by_path('gallery');
    if ($existing) {
        update_post_meta($existing->ID, '_wp_page_template', 'page-gallery.php');
        update_option('onehit_gallery_page_ready', 1);
        return;
    }

    $id = wp_insert_post(array(
        'post_title'   => 'Gallery',
        'post_name'    => 'gallery',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '',
    ));
    if ($id && !is_wp_error($id)) {
        update_post_meta($id, '_wp_page_template', 'page-gallery.php');
        update_option('onehit_gallery_page_ready', 1);
    }
}
add_action('after_switch_theme', 'onehit_ensure_gallery_page');
add_action('admin_init', 'onehit_ensure_gallery_page');

function onehit_gallery_page() {
    if (!current_user_can('edit_theme_options')) {
        return;
    }

    if (isset($_POST['onehit_gallery_nonce']) && wp_verify_nonce($_POST['onehit_gallery_nonce'], 'onehit_save_gallery')) {
        $raw = sanitize_text_field(wp_unslash($_POST['gallery_ids'] ?? ''));
        $ids = array();
        foreach (explode(',', $raw) as $piece) {
            $id = absint(trim($piece));
            if ($id) {
                $ids[] = $id;
            }
        }
        $ids = array_values(array_unique($ids));

        $captions = array();
        if (!empty($_POST['caption']) && is_array($_POST['caption'])) {
            foreach ($_POST['caption'] as $cid => $text) {
                $cid = absint($cid);
                if ($cid) {
                    $captions[$cid] = sanitize_text_field(wp_unslash($text));
                }
            }
        }

        update_option('onehit_gallery_ids', $ids);
        update_option('onehit_gallery_captions', $captions);
        echo '<div class="notice notice-success is-dismissible"><p>Gallery saved. Photos are live on the Gallery page.</p></div>';
    }

    $photos = onehit_get_gallery();
    $id_list = array();
    foreach ($photos as $p) {
        $id_list[] = $p['id'];
    }
    ?>
    <div class="wrap">
        <h1>Gym Gallery</h1>
        <p>Add photos from your computer or the WordPress media library. They show on the <strong>Gallery</strong> page of the website as soon as you click Save.</p>
        <p><a href="<?php echo esc_url(home_url('/gallery/')); ?>" target="_blank">View Gallery page →</a></p>

        <form method="post" id="onehit-gallery-form">
            <?php wp_nonce_field('onehit_save_gallery', 'onehit_gallery_nonce'); ?>
            <p>
                <button type="button" class="button button-hero" id="onehit-add-photos" style="background:#c41e3a;border-color:#c41e3a;color:#fff;">+ Add Photos</button>
                <input type="submit" class="button button-primary button-hero" value="Save Gallery">
            </p>
            <input type="hidden" name="gallery_ids" id="gallery_ids" value="<?php echo esc_attr(implode(',', $id_list)); ?>">

            <div id="onehit-gallery-admin-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-top:16px;">
                <?php foreach ($photos as $p) : ?>
                <div class="onehit-gcard" data-id="<?php echo (int) $p['id']; ?>" draggable="true" style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:8px;cursor:grab;">
                    <img src="<?php echo esc_url($p['thumb']); ?>" alt="" style="width:100%;height:140px;object-fit:cover;display:block;border-radius:2px;">
                    <input type="text" name="caption[<?php echo (int) $p['id']; ?>]" value="<?php echo esc_attr($p['caption']); ?>" placeholder="Caption (optional)" style="width:100%;margin-top:8px;">
                    <p style="margin:8px 0 0;"><button type="button" class="button-link-delete onehit-remove-photo">Remove</button></p>
                </div>
                <?php endforeach; ?>
            </div>
            <p class="description" id="onehit-gallery-empty" style="<?php echo empty($photos) ? '' : 'display:none;'; ?>margin-top:12px;">No photos yet. Click <strong>Add Photos</strong> to upload.</p>
            <p class="description">Drag photos to change the order. Then click <strong>Save Gallery</strong>.</p>
            <p class="submit"><input type="submit" class="button button-primary" value="Save Gallery"></p>
        </form>
    </div>
    <script>
    (function () {
        var grid = document.getElementById('onehit-gallery-admin-grid');
        var idsInput = document.getElementById('gallery_ids');
        var emptyMsg = document.getElementById('onehit-gallery-empty');
        var addBtn = document.getElementById('onehit-add-photos');
        var frame;

        function syncIds() {
            var ids = [];
            grid.querySelectorAll('.onehit-gcard').forEach(function (card) {
                ids.push(card.getAttribute('data-id'));
            });
            idsInput.value = ids.join(',');
            emptyMsg.style.display = ids.length ? 'none' : '';
        }

        function cardHtml(id, url, caption) {
            var div = document.createElement('div');
            div.className = 'onehit-gcard';
            div.setAttribute('data-id', id);
            div.setAttribute('draggable', 'true');
            div.style.cssText = 'background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:8px;cursor:grab;';
            div.innerHTML =
                '<img src="' + url + '" alt="" style="width:100%;height:140px;object-fit:cover;display:block;border-radius:2px;">' +
                '<input type="text" name="caption[' + id + ']" value="' + (caption || '') + '" placeholder="Caption (optional)" style="width:100%;margin-top:8px;">' +
                '<p style="margin:8px 0 0;"><button type="button" class="button-link-delete onehit-remove-photo">Remove</button></p>';
            return div;
        }

        addBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Add photos to the gallery',
                button: { text: 'Add to gallery' },
                multiple: true,
                library: { type: 'image' }
            });
            frame.on('select', function () {
                var existing = (idsInput.value || '').split(',').filter(Boolean);
                frame.state().get('selection').each(function (att) {
                    var a = att.toJSON();
                    if (existing.indexOf(String(a.id)) !== -1) return;
                    existing.push(String(a.id));
                    var url = (a.sizes && a.sizes.medium) ? a.sizes.medium.url : a.url;
                    grid.appendChild(cardHtml(a.id, url, a.caption || a.title || ''));
                });
                syncIds();
            });
            frame.open();
        });

        grid.addEventListener('click', function (e) {
            if (e.target.classList.contains('onehit-remove-photo')) {
                e.preventDefault();
                var card = e.target.closest('.onehit-gcard');
                if (card) card.remove();
                syncIds();
            }
        });

        var dragEl = null;
        grid.addEventListener('dragstart', function (e) {
            var card = e.target.closest('.onehit-gcard');
            if (!card) return;
            dragEl = card;
            e.dataTransfer.effectAllowed = 'move';
            card.style.opacity = '0.5';
        });
        grid.addEventListener('dragend', function () {
            if (dragEl) dragEl.style.opacity = '1';
            dragEl = null;
            syncIds();
        });
        grid.addEventListener('dragover', function (e) {
            e.preventDefault();
            var over = e.target.closest('.onehit-gcard');
            if (!over || over === dragEl || !dragEl) return;
            var rect = over.getBoundingClientRect();
            var before = (e.clientY - rect.top) < rect.height / 2;
            grid.insertBefore(dragEl, before ? over : over.nextSibling);
        });
    })();
    </script>
    <?php
}

/**
 * =====================================================
 * NEWSLETTER / EMAIL CAPTURE
 * =====================================================
 */
function onehit_get_subscribers() {
    $list = get_option('onehit_subscribers', array());
    return is_array($list) ? $list : array();
}

function onehit_add_subscriber($email, $name = '', $source = 'website') {
    $email = sanitize_email($email);
    if (!is_email($email)) {
        return new WP_Error('invalid_email', 'Please enter a valid email address.');
    }
    $list = onehit_get_subscribers();
    foreach ($list as $row) {
        if (isset($row['email']) && strtolower($row['email']) === strtolower($email)) {
            return new WP_Error('exists', 'That email is already on the list.');
        }
    }
    $list[] = array(
        'email'  => $email,
        'name'   => sanitize_text_field($name),
        'source' => sanitize_text_field($source),
        'date'   => current_time('mysql'),
    );
    update_option('onehit_subscribers', $list, false);

    $headers = array('Content-Type: text/plain; charset=UTF-8');
    $gym_email = onehit_get_option('onehit_email', get_option('admin_email'));

    // Notify Aldo
    $admin_subject = '1 Hit MMA – New newsletter signup';
    $admin_body = "New newsletter subscriber:\n\nEmail: $email\nName: " . ($name ?: '(not provided)') . "\nSource: $source\nDate: " . current_time('mysql') . "\n";
    wp_mail($gym_email, $admin_subject, $admin_body, $headers);


    return true;
}

function onehit_handle_newsletter_signup() {
    if (!empty(sanitize_text_field(wp_unslash($_POST['website_url'] ?? '')))) {
        wp_safe_redirect(home_url('/#newsletter'));
        exit;
    }
    $email  = sanitize_email(wp_unslash($_POST['newsletter_email'] ?? ''));
    $name   = sanitize_text_field(wp_unslash($_POST['newsletter_name'] ?? ''));
    $source = sanitize_text_field(wp_unslash($_POST['newsletter_source'] ?? 'website'));

    $result = onehit_add_subscriber($email, $name, $source);
    $status = is_wp_error($result) ? 'error' : 'success';

    // Always send user back to homepage newsletter section with a clear status flag
    $url = add_query_arg('newsletter', $status, home_url('/'));
    $url .= '#newsletter';
    wp_safe_redirect($url);
    exit;
}
add_action('admin_post_onehit_newsletter', 'onehit_handle_newsletter_signup');
add_action('admin_post_nopriv_onehit_newsletter', 'onehit_handle_newsletter_signup');

/**
 * Also accept newsletter POST on the front end (backup if admin-post is blocked)
 */
function onehit_newsletter_front_process() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }
    if (empty($_POST['onehit_newsletter_front'])) {
        return;
    }
    if (!empty(sanitize_text_field(wp_unslash($_POST['website_url'] ?? '')))) {
        wp_safe_redirect(home_url('/#newsletter'));
        exit;
    }
    $email  = sanitize_email(wp_unslash($_POST['newsletter_email'] ?? ''));
    $name   = sanitize_text_field(wp_unslash($_POST['newsletter_name'] ?? ''));
    $source = sanitize_text_field(wp_unslash($_POST['newsletter_source'] ?? 'website'));
    $result = onehit_add_subscriber($email, $name, $source);
    $status = is_wp_error($result) ? 'error' : 'success';
    wp_safe_redirect(add_query_arg('newsletter', $status, home_url('/')) . '#newsletter');
    exit;
}
add_action('template_redirect', 'onehit_newsletter_front_process', 1);

/**
 * AJAX newsletter signup (no full page reload)
 */
function onehit_ajax_newsletter_signup() {
    // Public signup: do not require a cached WP nonce (GoDaddy/Cloudflare cache expires them).
    $honeypot = sanitize_text_field(wp_unslash($_POST['website_url'] ?? ''));
    if ($honeypot !== '') {
        wp_send_json_success(array(
            'message' => 'You\'re on the list. Gym updates, schedule changes, and announcements will be sent to this email.'
        ));
    }
    $email  = sanitize_email(wp_unslash($_POST['newsletter_email'] ?? ''));
    $name   = sanitize_text_field(wp_unslash($_POST['newsletter_name'] ?? ''));
    $source = sanitize_text_field(wp_unslash($_POST['newsletter_source'] ?? 'website'));

    $result = onehit_add_subscriber($email, $name, $source);
    if (is_wp_error($result)) {
        wp_send_json_error(array('message' => $result->get_error_message()));
    }
    wp_send_json_success(array(
        'message' => 'You\'re on the list. Gym updates, schedule changes, and announcements will be sent to this email.'
    ));
}
add_action('wp_ajax_onehit_newsletter', 'onehit_ajax_newsletter_signup');
add_action('wp_ajax_nopriv_onehit_newsletter', 'onehit_ajax_newsletter_signup');


function onehit_newsletter_menu() {
    add_menu_page(
        __('Newsletter', 'onehitmma'),
        __('Newsletter', 'onehitmma'),
        'edit_theme_options',
        'onehit-newsletter',
        'onehit_newsletter_page',
        'dashicons-email-alt',
        27
    );
}
add_action('admin_menu', 'onehit_newsletter_menu');

function onehit_newsletter_export_csv() {
    if (!is_admin() || !isset($_GET['page']) || $_GET['page'] !== 'onehit-newsletter') return;
    if (!isset($_GET['export']) || $_GET['export'] !== 'csv') return;
    if (!current_user_can('edit_theme_options')) return;

    $list = onehit_get_subscribers();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=1hitmma-newsletter-' . date('Y-m-d') . '.csv');
    $out = fopen('php://output', 'w');
    fputcsv($out, array('Email', 'Name', 'Source', 'Date'));
    foreach ($list as $row) {
        fputcsv($out, array($row['email'] ?? '', $row['name'] ?? '', $row['source'] ?? '', $row['date'] ?? ''));
    }
    fclose($out);
    exit;
}
add_action('admin_init', 'onehit_newsletter_export_csv');


function onehit_newsletter_page() {
    if (!current_user_can('edit_theme_options')) {
        return;
    }

    // Delete
    if (isset($_GET['delete']) && isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'onehit_delete_sub')) {
        $email = sanitize_email(wp_unslash($_GET['delete']));
        $list = onehit_get_subscribers();
        $list = array_values(array_filter($list, function ($row) use ($email) {
            return strtolower($row['email']) !== strtolower($email);
        }));
        update_option('onehit_subscribers', $list, false);
        echo '<div class="notice notice-success"><p>Subscriber removed.</p></div>';
    }

    // CSV export
    if (isset($_GET['export']) && $_GET['export'] === 'csv') {
        $list = onehit_get_subscribers();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=1hitmma-newsletter-' . date('Y-m-d') . '.csv');
        $out = fopen('php://output', 'w');
        fputcsv($out, array('Email', 'Name', 'Source', 'Date'));
        foreach ($list as $row) {
            fputcsv($out, array($row['email'] ?? '', $row['name'] ?? '', $row['source'] ?? '', $row['date'] ?? ''));
        }
        fclose($out);
        exit;
    }

    $list = onehit_get_subscribers();
    // Newest first
    usort($list, function ($a, $b) {
        return strcmp($b['date'] ?? '', $a['date'] ?? '');
    });
    ?>
    <div class="wrap">
        <h1>Newsletter Subscribers</h1>
        <p>Emails collected from the website signup form. Export as CSV to import into Gmail, Mailchimp, or any email tool.</p>
        <p>
            <strong><?php echo count($list); ?></strong> subscriber(s)
            &nbsp;|&nbsp;
            <a class="button button-primary" href="<?php echo esc_url(admin_url('admin.php?page=onehit-newsletter&export=csv')); ?>">Export CSV</a>
        </p>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Source</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($list)) : ?>
                <tr><td colspan="5">No subscribers yet.</td></tr>
                <?php else : foreach ($list as $row) : ?>
                <tr>
                    <td><?php echo esc_html($row['email'] ?? ''); ?></td>
                    <td><?php echo esc_html($row['name'] ?? ''); ?></td>
                    <td><?php echo esc_html($row['source'] ?? ''); ?></td>
                    <td><?php echo esc_html($row['date'] ?? ''); ?></td>
                    <td>
                        <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=onehit-newsletter&delete=' . urlencode($row['email'] ?? '')), 'onehit_delete_sub')); ?>"
                           onclick="return confirm('Remove this email?');">Remove</a>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Render newsletter signup form (used on homepage + contact)
 */
function onehit_newsletter_form($source = 'website') {
    $status = isset($_GET['newsletter']) ? sanitize_text_field(wp_unslash($_GET['newsletter'])) : '';
    $uid = esc_attr(preg_replace('/[^a-z0-9]/i', '', $source));
    ob_start();
    ?>
    <div class="onehit-newsletter-wrap" id="onehit-newsletter-wrap-<?php echo $uid; ?>">
      <div class="onehit-newsletter-msg" style="display:none;border-radius:0.5rem;padding:1.25rem;margin-bottom:0;text-align:left;"></div>
      <?php if ($status === 'success') : ?>
        <div class="rounded-lg px-5 py-5 text-left" style="background:#14532d;border:2px solid #22c55e;color:#bbf7d0;">
          <p style="font-size:1.125rem;font-weight:700;margin:0 0 0.5rem;">You're on the list!</p>
          <p style="margin:0;font-size:0.95rem;opacity:0.95;">Gym updates, schedule changes, and announcements from 1 Hit MMA will be sent to this email.</p>
        </div>
      <?php else : ?>
        <?php if ($status === 'error') : ?>
          <div class="rounded-lg px-5 py-4 mb-4 text-sm" style="background:#450a0a;border:2px solid #c41e3a;color:#fecaca;">
            That email couldn’t be added. It may already be on the list, or it wasn’t valid. Try again.
          </div>
        <?php endif; ?>
        <form method="post" action="<?php echo esc_url(home_url('/')); ?>" class="onehit-newsletter-form" data-ajax="1" style="position:relative;z-index:20;">
          <input type="hidden" name="onehit_newsletter_front" value="1">
          <?php wp_nonce_field('onehit_newsletter', 'onehit_newsletter_nonce'); ?>
          <input type="hidden" name="newsletter_source" value="<?php echo esc_attr($source); ?>">
          <input type="text" name="website_url" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;height:0;width:0;opacity:0;">
          <div style="display:flex;flex-direction:column;gap:0.75rem;">
            <label for="newsletter_email_<?php echo $uid; ?>" style="position:absolute;left:-9999px;">Email</label>
            <input type="email"
              id="newsletter_email_<?php echo $uid; ?>"
              name="newsletter_email"
              required
              autocomplete="email"
              inputmode="email"
              placeholder="Your email"
              style="pointer-events:auto;cursor:text;position:relative;z-index:30;width:100%;min-height:48px;font-size:16px;background:#000;color:#fff;border:1px solid rgba(255,255,255,0.35);border-radius:0.25rem;padding:0.875rem 1rem;box-sizing:border-box;">
            <button type="submit"
              style="pointer-events:auto;cursor:pointer;position:relative;z-index:50;min-height:48px;background:#c41e3a;color:#fff;border:none;border-radius:0.25rem;padding:0.875rem 2rem;font-weight:600;letter-spacing:0.05em;">
              SIGN UP
            </button>
          </div>
          <p style="color:#6b7280;font-size:0.75rem;margin-top:0.75rem;">Gym updates, schedule changes, and events. Unsubscribe anytime by emailing us.</p>
        </form>
      <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}



function onehit_newsletter_nocache() {
    if (is_admin()) {
        return;
    }
    if (onehit_show_notice() || is_front_page() || is_page('contact') || is_page('contact-us')) {
        if (!defined('DONOTCACHEPAGE')) {
            define('DONOTCACHEPAGE', true);
        }
        nocache_headers();
    }
}
add_action('template_redirect', 'onehit_newsletter_nocache', 0);


function onehit_strip_divi_shortcodes($content) {
    if (!is_string($content)) {
        return $content;
    }
    if (strpos($content, 'et_pb_') === false && strpos($content, '[et_') === false) {
        return $content;
    }
    $content = preg_replace('/\[\/?et_pb_[^\]]*\]/', '', $content);
    $content = preg_replace('/\[\/?et_[^\]]*\]/', '', $content);
    return $content;
}
add_filter('the_content', 'onehit_strip_divi_shortcodes', 1);

function onehit_ensure_core_templates() {
    $map = array(
        'instructors' => 'page-instructors.php',
        'about'       => 'page-about.php',
        'schedule'    => 'page-schedule.php',
        'contact'     => 'page-contact.php',
        'contact-us'  => 'page-contact.php',
        'gallery'     => 'page-gallery.php',
    );
    foreach ($map as $slug => $tpl) {
        $page = get_page_by_path($slug);
        if ($page) {
            update_post_meta($page->ID, '_wp_page_template', $tpl);
        }
    }

    // Ensure /contact-us/ page exists
    if (!get_page_by_path('contact-us')) {
        $old = get_page_by_path('contact');
        $id = wp_insert_post(array(
            'post_title'   => 'Contact',
            'post_name'    => 'contact-us',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => $old ? $old->post_content : '',
        ));
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_wp_page_template', 'page-contact.php');
        }
    }
}
add_action('after_switch_theme', 'onehit_ensure_service_pages');
add_action('admin_init', 'onehit_ensure_service_pages');

function onehit_ensure_service_pages() {
    $pages = array(
        array(
            'slug'  => 'kids-martial-arts-layton-ut',
            'title' => 'Kids Martial Arts in Layton, UT',
            'content' => '<p>One Hit MMA offers kids martial arts classes in Layton, Utah that build confidence, discipline, and real skills. Our kids program includes kickboxing and Brazilian jiu-jitsu in a supportive, high-energy environment.</p>
<p>Classes are structured for different ages and experience levels. Kids learn striking technique, grappling fundamentals, and how to stay safe while having fun. Parents are welcome to watch.</p>
<p>We are located at 192 N Fairfield Rd, Suite 2, Layton, UT 84041. Drop-ins are welcome. Call (801) 644-5707 to ask about the current kids schedule or to book a first class.</p>
<p>One Hit MMA serves families from Layton, Kaysville, Clearfield, Syracuse, and surrounding Davis County.</p>',
        ),
        array(
            'slug'  => 'jiu-jitsu-layton-ut',
            'title' => 'Brazilian Jiu-Jitsu in Layton, UT',
            'content' => '<p>Train Brazilian jiu-jitsu (gi and no-gi) at One Hit MMA in Layton, Utah. Our BJJ program is taught by experienced coaches and is open to beginners through advanced students.</p>
<p>Classes focus on technique, leverage, control, and live rolling. Whether you want self-defense, fitness, or competition, you will find a place here. Drop-ins are welcome.</p>
<p>Visit us at 192 N Fairfield Rd, Suite 2, Layton, UT 84041 or call (801) 644-5707 to confirm the weekly gi and no-gi schedule.</p>',
        ),
        array(
            'slug'  => 'kickboxing-layton-ut',
            'title' => 'Kickboxing Classes in Layton, UT',
            'content' => '<p>One Hit MMA runs kickboxing classes in Layton, Utah for all levels. Learn real striking technique, improve your cardio, and train in a genuine fight gym atmosphere. Sparring is optional.</p>
<p>Classes cover punches, kicks, knees, defense, and combinations. Beginners are welcome and will be paired appropriately. Advanced students can train harder and prepare for competition.</p>
<p>We are at 192 N Fairfield Rd, Suite 2, Layton, UT 84041. Call (801) 644-5707 or check the schedule page for current kickboxing times.</p>',
        ),
        array(
            'slug'  => 'mma-layton-ut',
            'title' => 'MMA Training in Layton, UT',
            'content' => '<p>MMA training at One Hit MMA in Layton, Utah blends striking, grappling, and wrestling. Classes are designed for people who want authentic mixed martial arts training, whether for fitness or competition.</p>
<p>You will work with coaches who have competitive backgrounds. All levels are welcome. Drop-ins are fine — just call ahead so we know you are coming.</p>
<p>Location: 192 N Fairfield Rd, Suite 2, Layton, UT 84041. Phone: (801) 644-5707.</p>',
        ),
        array(
            'slug'  => 'wrestling-layton-ut',
            'title' => 'Wrestling Classes in Layton, UT',
            'content' => '<p>Wrestling classes at One Hit MMA in Layton, Utah focus on takedowns, control, and positional dominance. These sessions are great for MMA fighters and anyone who wants to improve their grappling stand-up game.</p>
<p>Classes typically run Tuesday and Thursday evenings. Beginners and experienced wrestlers are both welcome. Drop-ins are accepted.</p>
<p>Train with us at 192 N Fairfield Rd, Suite 2, Layton, UT 84041. Call (801) 644-5707 to confirm the current wrestling schedule.</p>',
        ),
    );

    foreach ($pages as $p) {
        $existing = get_page_by_path($p['slug']);
        if (!$existing) {
            $id = wp_insert_post(array(
                'post_title'   => $p['title'],
                'post_name'    => $p['slug'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => $p['content'],
            ));
            if ($id && !is_wp_error($id)) {
                update_post_meta($id, '_wp_page_template', 'page-service.php');
            }
        } else {
            update_post_meta($existing->ID, '_wp_page_template', 'page-service.php');
        }
    }
}

function onehit_favicon() {
    $icon = get_template_directory_uri() . '/assets/images/logo-circle.png';
    echo '<link rel="icon" href="' . esc_url($icon) . '" type="image/png">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($icon) . '">' . "\n";
}
add_action('wp_head', 'onehit_favicon', 1);

/**
 * SEO: Custom titles, meta descriptions, LocalBusiness schema
 */
/**
 * Force custom SEO titles even when an SEO plugin (Yoast, Rank Math, etc.) is active.
 */
function onehit_force_seo_title($title = '') {
    if (is_front_page() || is_home()) {
        return 'MMA, Kickboxing & Jiu-Jitsu Gym in Layton, UT | One Hit MMA';
    }
    if (is_page('schedule')) {
        return 'Class Schedule: Kickboxing, BJJ & Wrestling | One Hit MMA';
    }
    if (is_page('about')) {
        return 'About One Hit MMA | Layton Martial Arts Gym';
    }
    if (is_page('instructors')) {
        return 'Coaches: Kickboxing & BJJ Black Belts | One Hit MMA';
    }
    if (is_page('contact') || is_page('contact-us')) {
        return 'Contact & Directions | One Hit MMA, Layton UT';
    }
    if (is_page('gallery')) {
        return 'Photo Gallery | One Hit MMA Martial Arts, Layton UT';
    }
    if (is_page('kids-martial-arts-layton-ut')) {
        return 'Kids Martial Arts in Layton, UT | One Hit MMA';
    }
    if (is_page('jiu-jitsu-layton-ut')) {
        return 'Brazilian Jiu-Jitsu in Layton, UT | Gi & No-Gi';
    }
    if (is_page('kickboxing-layton-ut')) {
        return 'Kickboxing Classes in Layton, UT | One Hit MMA';
    }
    if (is_page('mma-layton-ut')) {
        return 'MMA Training in Layton, UT | One Hit MMA';
    }
    if (is_page('wrestling-layton-ut')) {
        return 'Wrestling Classes in Layton, UT | Tue & Thu';
    }
    return $title;
}

// High-priority overrides
add_filter('pre_get_document_title', 'onehit_force_seo_title', 9999);
add_filter('document_title_parts', function($parts) {
    $forced = onehit_force_seo_title('');
    if ($forced) {
        $parts['title'] = $forced;
        unset($parts['site'], $parts['tagline']);
    }
    return $parts;
}, 9999);

// Yoast SEO
add_filter('wpseo_title', 'onehit_force_seo_title', 9999);
add_filter('wpseo_opengraph_title', 'onehit_force_seo_title', 9999);

// Rank Math
add_filter('rank_math/frontend/title', 'onehit_force_seo_title', 9999);
add_filter('rank_math/opengraph/facebook/title', 'onehit_force_seo_title', 9999);

// All in One SEO
add_filter('aioseo_title', 'onehit_force_seo_title', 9999);
add_filter('aioseo_facebook_tags', function($meta) {
    $forced = onehit_force_seo_title('');
    if ($forced && isset($meta['og:title'])) {
        $meta['og:title'] = $forced;
    }
    return $meta;
}, 9999);

function onehit_meta_description() {
    $desc = '';
    if (is_front_page() || is_home()) {
        $desc = 'Train kickboxing, jiu-jitsu, wrestling, MMA and kids classes at One Hit MMA in Layton, Utah. All levels welcome, drop-ins OK. Call (801) 644-5707.';
    } elseif (is_page('schedule')) {
        $desc = 'See weekly kickboxing, gi and no-gi jiu-jitsu, wrestling, MMA and kids class times at One Hit MMA in Layton, UT. Drop-ins welcome. Call to confirm.';
    } elseif (is_page('about')) {
        $desc = 'Meet One Hit MMA, a Layton, Utah martial arts gym founded by two-time Brazilian National ISKA Champion Aldo Oreggia. Sparring optional, beginners welcome.';
    } elseif (is_page('instructors')) {
        $desc = 'Train with Aldo Oreggia, Gustavo Rodrigues and Crystal Olson-Smith at One Hit MMA in Layton, UT. Kickboxing, Brazilian jiu-jitsu and conditioning coaches.';
    } elseif (is_page('contact') || is_page('contact-us')) {
        $desc = 'Call (801) 644-5707 or visit 192 N Fairfield Rd, Suite 2, Layton, UT 84041. Ask about kickboxing, jiu-jitsu, MMA and kids classes at One Hit MMA.';
    } elseif (is_page('gallery')) {
        $desc = 'Photos of kickboxing, jiu-jitsu, MMA and kids classes at One Hit MMA in Layton, Utah. See the gym, the coaches and our students in action.';
    }
    if ($desc) {
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    }
}
add_action('wp_head', 'onehit_meta_description', 1);

function onehit_og_image() {
    $image = get_template_directory_uri() . '/assets/images/PhotoConcept1.jpg';
    if (is_page('about')) {
        $image = get_template_directory_uri() . '/assets/images/aldo-wrapping.jpg';
    }
    echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
}
add_action('wp_head', 'onehit_og_image', 3);

function onehit_localbusiness_schema() {
    if (!is_front_page() && !is_home()) {
        return;
    }
    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => array('SportsActivityLocation', 'ExerciseGym'),
        '@id'      => home_url('/#gym'),
        'name'     => 'One Hit MMA',
        'alternateName' => '1 Hit MMA',
        'description' => 'Kickboxing, Brazilian jiu-jitsu, wrestling, MMA and kids martial arts classes in Layton, Utah. All levels welcome, drop-ins welcome.',
        'url'      => home_url('/'),
        'logo'     => get_template_directory_uri() . '/assets/images/logo-header-v4.png',
        'image'    => get_template_directory_uri() . '/assets/images/PhotoConcept1.jpg',
        'telephone'=> '+1-801-644-5707',
        'address'  => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => '192 N Fairfield Rd, Suite 2',
            'addressLocality' => 'Layton',
            'addressRegion'   => 'UT',
            'postalCode'      => '84041',
            'addressCountry'  => 'US',
        ),
        'geo' => array(
            '@type'     => 'GeoCoordinates',
            'latitude'  => 41.0624809,
            'longitude' => -111.9452104,
        ),
        'hasMap' => 'https://maps.app.goo.gl/MRWUpjn7TbfRGznCA',
        'areaServed' => array(
            array('@type' => 'City', 'name' => 'Layton'),
            array('@type' => 'City', 'name' => 'Kaysville'),
            array('@type' => 'City', 'name' => 'Clearfield'),
            array('@type' => 'City', 'name' => 'Syracuse'),
            array('@type' => 'City', 'name' => 'Roy'),
        ),
        'founder' => array(
            '@type' => 'Person',
            'name'  => 'Aldo Oreggia',
            'jobTitle' => 'Founder and Head Coach',
        ),
        'knowsAbout' => array('Kickboxing', 'Brazilian jiu-jitsu', 'Wrestling', 'Mixed martial arts', 'Kids martial arts'),
        'sameAs' => array(
            'https://www.instagram.com/1hitmma/',
        ),
    );
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'onehit_localbusiness_schema', 2);
