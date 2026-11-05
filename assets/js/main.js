/**
 * 1 Hit MMA Theme JS
 */
(function () {
  function syncNoticeOffset() {
    var notice = document.getElementById("onehit-notice");
    var h = notice ? notice.offsetHeight : 0;
    document.documentElement.style.setProperty("--notice-h", h + "px");
  }
  syncNoticeOffset();
  window.addEventListener("resize", syncNoticeOffset);

  var menuBtn = document.getElementById("mobile-menu-btn");
  var mobileMenu = document.getElementById("mobile-menu");

  if (menuBtn && mobileMenu) {
    mobileMenu.classList.add("hidden");
    mobileMenu.style.display = "none";

    menuBtn.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      var isHidden = mobileMenu.classList.contains("hidden") || mobileMenu.style.display === "none";
      if (isHidden) {
        mobileMenu.classList.remove("hidden");
        mobileMenu.style.display = "block";
        menuBtn.setAttribute("aria-expanded", "true");
      } else {
        mobileMenu.classList.add("hidden");
        mobileMenu.style.display = "none";
        menuBtn.setAttribute("aria-expanded", "false");
      }
    });

    mobileMenu.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        mobileMenu.classList.add("hidden");
        mobileMenu.style.display = "none";
        menuBtn.setAttribute("aria-expanded", "false");
      });
    });
  }

  document.querySelectorAll('a[href*="#newsletter"]').forEach(function (a) {
    a.addEventListener("click", function (e) {
      var href = a.getAttribute("href") || "";
      if (href.indexOf("#newsletter") === -1) return;
      var target = document.getElementById("newsletter");
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: "smooth", block: "start" });
        setTimeout(function () {
          var input = target.querySelector('input[type="email"]');
          if (input) input.focus();
        }, 400);
      }
    });
  });

  // Newsletter signup via AJAX — no full page reload
  document.querySelectorAll("form.onehit-newsletter-form[data-ajax='1']").forEach(function (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      var wrap = form.closest(".onehit-newsletter-wrap");
      var msgBox = wrap ? wrap.querySelector(".onehit-newsletter-msg") : null;
      var btn = form.querySelector('button[type="submit"]');
      var emailInput = form.querySelector('input[name="newsletter_email"]');
      var email = emailInput ? emailInput.value.trim() : "";

      if (!email) return;

      if (btn) {
        btn.disabled = true;
        btn.textContent = "SIGNING UP…";
        btn.style.opacity = "0.7";
      }

      var data = new FormData(form);
      data.append("action", "onehit_newsletter");

      var ajaxUrl = (window.onehitData && window.onehitData.ajaxUrl)
        ? window.onehitData.ajaxUrl
        : "/wp-admin/admin-ajax.php";

      fetch(ajaxUrl, {
        method: "POST",
        body: data,
        credentials: "same-origin"
      })
        .then(function (res) { return res.json(); })
        .then(function (json) {
          if (json && json.success) {
            var message = (json.data && json.data.message)
              ? json.data.message
              : "Gym updates, schedule changes, and announcements will be sent to this email.";
            if (wrap) {
              wrap.innerHTML =
                '<div style="background:#14532d;border:2px solid #22c55e;color:#bbf7d0;border-radius:0.5rem;padding:1.25rem;text-align:left;">' +
                '<p style="font-size:1.125rem;font-weight:700;margin:0 0 0.5rem;">You\'re on the list!</p>' +
                '<p style="margin:0;font-size:0.95rem;opacity:0.95;">' + message + "</p></div>";
            }
          } else {
            var err = (json && json.data && json.data.message)
              ? json.data.message
              : "That email could not be added. Please try again.";
            if (msgBox) {
              msgBox.style.display = "block";
              msgBox.style.background = "#450a0a";
              msgBox.style.border = "2px solid #c41e3a";
              msgBox.style.color = "#fecaca";
              msgBox.textContent = err;
            } else {
              alert(err);
            }
            if (btn) {
              btn.disabled = false;
              btn.textContent = "SIGN UP";
              btn.style.opacity = "1";
            }
          }
        })
        .catch(function () {
          form.removeAttribute("data-ajax");
          form.submit();
        });
    });
  });

  // Gallery lightbox
  var gallery = document.getElementById("onehit-gallery");
  var lightbox = document.getElementById("onehit-lightbox");
  if (gallery && lightbox) {
    var items = Array.prototype.slice.call(gallery.querySelectorAll(".onehit-gallery-item"));
    var imgEl = lightbox.querySelector("img");
    var capEl = lightbox.querySelector(".onehit-lightbox-caption");
    var index = 0;

    function show(i) {
      if (!items.length) return;
      index = (i + items.length) % items.length;
      var item = items[index];
      imgEl.src = item.getAttribute("data-full") || "";
      imgEl.alt = item.getAttribute("aria-label") || "";
      var cap = item.getAttribute("data-caption") || "";
      capEl.textContent = cap;
      capEl.style.display = cap ? "block" : "none";
      lightbox.hidden = false;
      document.body.style.overflow = "hidden";
    }

    function hide() {
      lightbox.hidden = true;
      imgEl.src = "";
      document.body.style.overflow = "";
    }

    items.forEach(function (item, i) {
      item.addEventListener("click", function () { show(i); });
    });

    lightbox.querySelector(".onehit-lightbox-close").addEventListener("click", hide);
    lightbox.querySelector(".onehit-lightbox-prev").addEventListener("click", function (e) {
      e.stopPropagation();
      show(index - 1);
    });
    lightbox.querySelector(".onehit-lightbox-next").addEventListener("click", function (e) {
      e.stopPropagation();
      show(index + 1);
    });
    lightbox.addEventListener("click", function (e) {
      if (e.target === lightbox) hide();
    });
    document.addEventListener("keydown", function (e) {
      if (lightbox.hidden) return;
      if (e.key === "Escape") hide();
      if (e.key === "ArrowLeft") show(index - 1);
      if (e.key === "ArrowRight") show(index + 1);
    });
  }
})();
