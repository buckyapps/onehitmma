# 1 Hit MMA WordPress Theme

Modern, clean theme for **1 Hit MMA** (Kickboxing / Jiu-Jitsu / MMA gym in Layton, Utah).

Built for Aldo Oreggia so he can easily manage:
- Class schedule
- Testimonials
- Top notification bar (holiday closures, etc.)
- Logos & contact info
- Contact form that emails him directly

---

## Installation

1. Zip the entire `onehitmma-theme` folder (or use the provided zip)
2. In WordPress admin → **Appearance → Themes → Add New → Upload Theme**
3. Activate **1 Hit MMA**
4. Create pages and assign templates (see below)

---

## Required Pages (create these in WordPress)

| Page Title | Slug       | Template to assign      |
|------------|------------|-------------------------|
| Home       | (front)    | Settings → Reading → static front page |
| Schedule   | `schedule` | Template: **Schedule**  |
| Gallery    | `gallery`  | Template: **Gallery** (auto-created) |
| About      | `about`    | Template: **About**     |
| Contact    | `contact`  | Template: **Contact**   |

Set the homepage under **Settings → Reading → Your homepage displays → A static page**.

---

## What Aldo Can Edit

### 1. Class Schedule
**WordPress Admin → Class Schedule** (left menu)

- Add / edit / remove rows (Day, Time, Class, Level)
- Edit the note under the table
- Saves instantly to the Schedule page

### 2. Top Notification Bar / Announcements
**WordPress Admin → Announcements** (left menu, megaphone icon)

- Check **Show this announcement on the website**
- Type the message (holiday closures, schedule changes, reminders)
- Optional link
- Optional start date + end date (auto-hides after the end date)
- Click **Save Announcement**

The red bar appears at the top of every page.

### 3. Testimonials
**WordPress Admin → Testimonials**

- Add New → Title = person’s name, Content = the quote
- Latest 3 appear on the homepage automatically

### 4. Gallery
**WordPress Admin → Gallery** (left menu)

- Click **Add Photos** → upload or pick from the media library (select many at once)
- Optional caption under each photo
- Drag to reorder
- Click **Save Gallery** — photos go live on `/gallery/` immediately

### 5. Logos, Phone, Address, Hero Image
**Appearance → Customize**

- Contact Info
- Logos (header + circular badge)
- Homepage Hero (background image + text)

### 6. Contact Form
Submissions are emailed to the address set in **Customize → Contact Info → Email**.

---

## Instagram Feed

1. Install the free plugin **Smash Balloon Instagram Feed**
2. Connect the `@1hitmma` account
3. The homepage already has the shortcode area ready — latest posts will appear automatically

Instagram: https://www.instagram.com/1hitmma

---

## Google Business / Reviews

Google Business link:  
https://share.google/aimode/iIonZuQEzJO3Ahz0y

For automated Google reviews later, plugins like **Widget for Google Reviews** or **Trustindex** can be added. For now testimonials are managed manually (easy and clean).

---

## Color Palette
- Brand Red: `#c41e3a`
- Dark: `#0a0a0a`
- Gray: `#1a1a1a`
- White / light gray text

---

## Notes
- Theme uses Tailwind via CDN for simplicity (can be compiled later for production performance)
- All images live in `assets/images/`
- Mobile-friendly and optimized for the fight photography style of the brand
