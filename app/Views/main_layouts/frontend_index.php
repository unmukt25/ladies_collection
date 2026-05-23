<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ladis Collection - Ladies Dress Shop</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- ── TOP BANNER OFFERS ──────────────────────────────────────── -->
  <div id="top-banner">
    <div class="banner-inner">
      <span>Free shipping on orders above ₹2,999</span>
      <span class="banner-dot">✦</span>
      <span>New Summer Collection — Now Live</span>
      <span class="banner-dot">✦</span>
      <span>Use code <strong>ELLE20</strong> for 20% off your first order</span>
      <span class="banner-dot">✦</span>
      <span>Easy 30-day returns &amp; exchanges</span>
      <span class="banner-dot">✦</span>
      <span>Free shipping on orders above ₹2,999</span>
      <span class="banner-dot">✦</span>
      <span>New Summer Collection — Now Live</span>
      <span class="banner-dot">✦</span>
      <span>Use code <strong>ELLE20</strong> for 20% off</span>
    </div>
    <i class="fas fa-times" id="banner-close" onclick="closeBanner()"></i>
  </div>

  <!-- ── TOP NAV ─────────────────────────────────────────── -->
  <nav id="top-nav">
    <button id="sidebar-toggle" onclick="toggleSidebar()" title="Toggle filters">
      <i class="fas fa-bars"></i>
    </button>

    <a class="brand" href="#">Ladies <span>Collection</span></a>

    <div class="nav-search-wrap">
      <i class="fas fa-search"></i>
      <input type="text" placeholder="Search dresses, styles…" id="navSearchInput" oninput="handleSearch(this.value)" />
    </div>

    <div class="nav-icons">
      <button class="nav-icon-btn" title="Account" onclick="toast('Account coming soon','fa-user')">
        <i class="far fa-user"></i>
      </button>
      <button class="nav-icon-btn" title="Wishlist"
        onclick="toast('Wishlist: ' + wishlist.size + ' saved items','fa-heart')">
        <i class="far fa-heart"></i>
        <div class="badge-dot" id="wishDot" style="display:none;"></div>
      </button>
      <button class="nav-icon-btn" title="Bag" onclick="toast('Bag: ' + cartCount + ' item(s)','fa-bag-shopping')">
        <i class="fas fa-bag-shopping"></i>
        <div class="cart-count" id="cartBadge" style="display:none;">0</div>
      </button>
    </div>
  </nav>

  <!-- Sidebar mobile overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobile()"></div>

  <!-- ── MAIN SHELL ────────────────────────────────────────── -->
  <div id="shell">

    <!-- ── SIDE NAV ──────────────────────────────────────── -->
    <aside id="sidebar">
      <div class="sidebar-inner" id="sidebarInner">

        <!-- Navigation -->
        <div class="sidebar-section" style="padding-top:22px;">
          <div class="sidebar-section-title">Navigate</div>
          <a class="side-nav-link active" onclick="setCategory(this,'All')">
            <i class="fas fa-grip-vertical"></i><span class="link-text">All Dresses</span>
          </a>
          <a class="side-nav-link" onclick="setCategory(this,'Casual')">
            <i class="fas fa-leaf"></i><span class="link-text">Casual</span>
          </a>
          <a class="side-nav-link" onclick="setCategory(this,'Evening')">
            <i class="fas fa-star"></i><span class="link-text">Evening &amp; Gala</span>
          </a>
          <a class="side-nav-link" onclick="setCategory(this,'Bridal')">
            <i class="fas fa-ring"></i><span class="link-text">Bridal</span>
          </a>
          <a class="side-nav-link" onclick="setCategory(this,'Party')">
            <i class="fas fa-champagne-glasses"></i><span class="link-text">Party</span>
          </a>
          <a class="side-nav-link" onclick="setCategory(this,'Office')">
            <i class="fas fa-briefcase"></i><span class="link-text">Office Wear</span>
          </a>
          <a class="side-nav-link" onclick="setCategory(this,'Sale')">
            <i class="fas fa-tags"></i><span class="link-text">Sale</span>
          </a>
        </div>

        <!-- Filters -->
        <div class="sidebar-section" style="margin-top:10px; padding-bottom:24px;">
          <div class="sidebar-section-title">Filter</div>

          <!-- Size -->
          <div class="filter-section">
            <div class="filter-label">Size</div>
            <div style="display:flex;flex-wrap:wrap;gap:6px;">
              <button class="size-chip" onclick="toggleSize(this,'XS')">XS</button>
              <button class="size-chip" onclick="toggleSize(this,'S')">S</button>
              <button class="size-chip" onclick="toggleSize(this,'M')">M</button>
              <button class="size-chip" onclick="toggleSize(this,'L')">L</button>
              <button class="size-chip" onclick="toggleSize(this,'XL')">XL</button>
              <button class="size-chip" onclick="toggleSize(this,'XXL')">XXL</button>
            </div>
          </div>

          <!-- Color -->
          <div class="filter-section">
            <div class="filter-label">Color</div>
            <div class="color-dot-wrap">
              <div class="color-dot" style="background:#e8c4b8;" title="Blush" onclick="toggleColor(this,'Blush')">
              </div>
              <div class="color-dot" style="background:#1a1a1a;" title="Black" onclick="toggleColor(this,'Black')">
              </div>
              <div class="color-dot" style="background:#f9f9f9;border:1.5px solid #ccc;" title="White"
                onclick="toggleColor(this,'White')"></div>
              <div class="color-dot" style="background:#6a8caf;" title="Blue" onclick="toggleColor(this,'Blue')"></div>
              <div class="color-dot" style="background:#8ab89a;" title="Sage" onclick="toggleColor(this,'Sage')"></div>
              <div class="color-dot" style="background:#c9716a;" title="Rose" onclick="toggleColor(this,'Rose')"></div>
              <div class="color-dot" style="background:#c8a96e;" title="Gold" onclick="toggleColor(this,'Gold')"></div>
              <div class="color-dot" style="background:#7a5c52;" title="Mocha" onclick="toggleColor(this,'Mocha')">
              </div>
            </div>
          </div>

          <!-- Price -->
          <div class="filter-section">
            <div class="filter-label">Price Range</div>
            <div class="price-range">
              <input type="range" class="range-slider" id="priceSlider" min="500" max="15000" value="15000" step="500"
                oninput="handlePrice(this.value)" />
              <div class="price-labels">
                <span>₹500</span><span id="priceLabel">Up to ₹15,000</span>
              </div>
            </div>
          </div>

          <!-- Style -->
          <div class="filter-section">
            <div class="filter-label">Style</div>
            <label class="filter-check"><input type="checkbox" onchange="toggleStyle(this,'Floral')" /> Floral</label>
            <label class="filter-check"><input type="checkbox" onchange="toggleStyle(this,'Solid')" /> Solid</label>
            <label class="filter-check"><input type="checkbox" onchange="toggleStyle(this,'Printed')" /> Printed</label>
            <label class="filter-check"><input type="checkbox" onchange="toggleStyle(this,'Embroidered')" />
              Embroidered</label>
            <label class="filter-check"><input type="checkbox" onchange="toggleStyle(this,'Sequined')" />
              Sequined</label>
          </div>

          <!-- Rating -->
          <div class="filter-section">
            <div class="filter-label">Minimum Rating</div>
            <div style="display:flex;gap:6px;flex-wrap:wrap;">
              <button class="size-chip" onclick="setRating(this,3)">3★+</button>
              <button class="size-chip" onclick="setRating(this,4)">4★+</button>
              <button class="size-chip active" onclick="setRating(this,0)">All</button>
            </div>
          </div>

          <!-- Reset -->
          <div class="reset-btn-wrap">
            <button onclick="clearAll()"
              style="width:100%;padding:11px;border-radius:10px;border:none;background:var(--rose);color:#fff;font-family:'Jost',sans-serif;font-size:.84rem;cursor:pointer;transition:background .2s;letter-spacing:.04em;">
              <i class="fas fa-rotate-left" style="margin-right:7px;"></i>Reset All Filters
            </button>
          </div>
        </div>

      </div><!-- /sidebar-inner -->
    </aside>

<!-- MAIN CONTENT IS IN CONTENT SECTION OF HOMEPAGE.PHP -->
   <?= $this->renderSection('content') ?>

  </div><!-- /shell -->

  <!-- ── FOOTER ───────────────────────────────────────────── -->
  <footer>
    <div class="footer-grid">
      <div>
        <div class="footer-brand">Maison <span>Élégante</span></div>
        <p class="footer-desc">Curated fashion for the modern woman. From everyday elegance to gala evenings — each
          piece is crafted with love and intention.</p>
        <div class="footer-socials">
          <div class="social-btn" title="Instagram"><i class="fab fa-instagram"></i></div>
          <div class="social-btn" title="Pinterest"><i class="fab fa-pinterest"></i></div>
          <div class="social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></div>
          <div class="social-btn" title="YouTube"><i class="fab fa-youtube"></i></div>
        </div>
      </div>
      <div>
        <div class="footer-col-title">Shop</div>
        <a class="footer-link" href="#">New Arrivals</a>
        <a class="footer-link" href="#">Best Sellers</a>
        <a class="footer-link" href="#">Evening Gowns</a>
        <a class="footer-link" href="#">Bridal Edit</a>
        <a class="footer-link" href="#">Sale</a>
      </div>
      <div>
        <div class="footer-col-title">Help</div>
        <a class="footer-link" href="#">Size Guide</a>
        <a class="footer-link" href="#">Shipping &amp; Returns</a>
        <a class="footer-link" href="#">Care Instructions</a>
        <a class="footer-link" href="#">Contact Us</a>
        <a class="footer-link" href="#">FAQs</a>
      </div>
      <div>
        <div class="footer-col-title">Newsletter</div>
        <p style="font-size:.82rem;opacity:.6;line-height:1.75;margin-bottom:4px;">Style tips, new arrivals &amp;
          exclusive offers — straight to your inbox.</p>
        <div class="newsletter-input-wrap">
          <input class="newsletter-input" type="email" placeholder="Your email address" />
          <button class="newsletter-btn" onclick="toast('Thank you for subscribing!','fa-envelope')">Join</button>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2025 Maison Élégante. All rights reserved.</span>
      <span>Privacy Policy · Terms · Cookies</span>
    </div>
  </footer>

  <div class="toast-container" id="toastWrap"></div>

  
  <script>
    /* ───────── DATA ───────── */
    // const DRESSES = [
    //   { id: 1, name: 'Aurora Floral Midi', cat: 'Casual', price: 2499, old: 3299, rating: 4.7, rev: 238, badge: 'New', colors: ['#e8c4b8', '#8ab89a', '#fff'], sizes: ['XS', 'S', 'M', 'L'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 2, name: 'Velvet Noir Evening Gown', cat: 'Evening', price: 8999, old: null, rating: 4.9, rev: 87, badge: '', colors: ['#2e2622', '#6a8caf'], sizes: ['S', 'M', 'L', 'XL'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 3, name: 'Ivory Lace Bridal Gown', cat: 'Bridal', price: 14500, old: null, rating: 5.0, rev: 42, badge: '', colors: ['#fff', '#e8c4b8'], sizes: ['XS', 'S', 'M', 'L', 'XL'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 4, name: 'Rose Petal Wrap Dress', cat: 'Casual', price: 1899, old: 2499, rating: 4.4, rev: 312, badge: 'Sale', colors: ['#c9716a', '#e8c4b8'], sizes: ['XS', 'S', 'M'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 5, name: 'Cobalt Sequin Mini', cat: 'Party', price: 4299, old: 5499, rating: 4.6, rev: 154, badge: 'Sale', colors: ['#6a8caf', '#2e2622'], sizes: ['S', 'M', 'L'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 6, name: 'Sage Linen Sundress', cat: 'Casual', price: 1599, old: null, rating: 4.3, rev: 426, badge: 'New', colors: ['#8ab89a', '#c8a96e'], sizes: ['XS', 'S', 'M', 'L', 'XL', 'XXL'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 7, name: 'Champagne Off-Shoulder', cat: 'Evening', price: 6799, old: 8200, rating: 4.8, rev: 99, badge: '', colors: ['#c8a96e', '#fff'], sizes: ['S', 'M', 'L'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 8, name: 'Oxford Pencil Dress', cat: 'Office', price: 3199, old: null, rating: 4.5, rev: 203, badge: '', colors: ['#2e2622', '#7a5c52', '#6a8caf'], sizes: ['XS', 'S', 'M', 'L', 'XL'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 9, name: 'Fuchsia Ruffle Maxi', cat: 'Party', price: 3799, old: null, rating: 4.2, rev: 67, badge: 'New', colors: ['#c9716a', '#e8c4b8', '#fff'], sizes: ['S', 'M', 'L', 'XL'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 10, name: 'Pearl Embroidered Kurta', cat: 'Casual', price: 2799, old: 3400, rating: 4.6, rev: 511, badge: 'Sale', colors: ['#fff', '#c8a96e', '#e8c4b8'], sizes: ['XS', 'S', 'M', 'L', 'XL', 'XXL'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 11, name: 'Midnight Halter Gown', cat: 'Evening', price: 11200, old: 13500, rating: 4.9, rev: 58, badge: '', colors: ['#2e2622'], sizes: ['S', 'M', 'L'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    //   { id: 12, name: 'Blush Satin A-Line', cat: 'Bridal', price: 12800, old: null, rating: 4.8, rev: 34, badge: 'New', colors: ['#e8c4b8', '#fff'], sizes: ['XS', 'S', 'M', 'L'], img: 'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=500&q=75' },
    // ];

    

    /* ───────── STATE ───────── */
    let category = 'All';
    let selSizes = new Set();
    let selColors = new Set();
    let selStyles = new Set();
    let maxPrice = 15000;
    let minRating = 0;
    let query = '';
    let sortMode = 'featured';
    let cartCount = 0;
    let wishlist = new Set();
    let collapsed = false;

    const COLOR_MAP = {
      Blush: '#e8c4b8',
      Black: '#1a1a1a',
      White: '#ffffff',
      Blue: '#6a8caf',
      Sage: '#8ab89a',
      Rose: '#c9716a',
      Gold: '#c8a96e',
      Mocha: '#7a5c52'
    };

    /* ───────── FILTER ───────── */
    function filtered() {
      return DRESSES.filter(d => {
        if (category === 'Sale' && !d.old) return false;
        if (category !== 'All' && category !== 'Sale' && d.cat !== category) return false;
        if (d.price > maxPrice) return false;
        if (d.rating < minRating) return false;
        if (selSizes.size && !d.sizes.some(s => selSizes.has(s))) return false;
        if (query && !d.name.toLowerCase().includes(query.toLowerCase())) return false;

        if (selColors.size && !d.colors.some(c => {
          return Array.from(selColors).some(sel => COLOR_MAP[sel] === c);
        })) return false;

        if (
          selStyles.size &&
          !d.style.some(s => selStyles.has(s))
        ) return false;

        return true;
      });
    }

    function sorted(arr) {
      const a = [...arr];
      if (sortMode === 'price-asc') return a.sort((x, y) => x.price - y.price);
      if (sortMode === 'price-desc') return a.sort((x, y) => y.price - x.price);
      if (sortMode === 'rating') return a.sort((x, y) => y.rating - x.rating);
      if (sortMode === 'newest') return a.sort((x, y) => y.id - x.id);
      return a;
    }

    /* ───────── RENDER ───────── */
    function render() {
      const data = sorted(filtered());
      const grid = document.getElementById('cardsGrid');
      document.getElementById('resultMeta').textContent = `Showing ${data.length} dress${data.length !== 1 ? 'es' : ''}`;

      if (!data.length) {
        grid.innerHTML = `<div class="empty-state">
      <i class="fas fa-magnifying-glass"></i>
      No dresses match your filters.
      <a href="#" onclick="clearAll();return false;">Clear all filters</a>
    </div>`;
        renderChips();
        return;
      }

      grid.innerHTML = data.map((d, i) => `
    <div class="dress-card" style="animation-delay:${i * 0.05}s">
      <div class="card-img-wrap">
        <img src="${d.img}" alt="${d.name}" loading="lazy"/>
        <div class="card-overlay">
          <div class="overlay-btns">
            <button class="overlay-btn ghost" onclick="event.stopPropagation();toast('Quick view: ${d.name}','fa-eye')">
              <i class="far fa-eye"></i> View
            </button>
            <button class="overlay-btn primary" onclick="event.stopPropagation();addCart(${d.id})">
              <i class="fas fa-bag-shopping"></i> Add
            </button>
          </div>
        </div>
        ${d.badge ? `<div class="card-badge ${d.badge.toLowerCase()}">${d.badge}</div>` : ''}
        <button class="wishlist-btn ${wishlist.has(d.id) ? 'liked' : ''}" id="wl${d.id}" onclick="event.stopPropagation();toggleWish(${d.id})">
          <i class="${wishlist.has(d.id) ? 'fas' : 'far'} fa-heart"></i>
        </button>
      </div>
      <div class="card-body">
        <div class="card-category">${d.cat}</div>
        <div class="card-name">${d.name}</div>
        <div class="card-swatches">${d.colors.map(c => `<div class="card-swatch" style="background:${c};"></div>`).join('')}</div>
        <div class="card-footer-row">
          <div class="price-wrap">
            <span class="price">₹${d.price.toLocaleString('en-IN')}</span>
            ${d.old ? `<span class="price-old">₹${d.old.toLocaleString('en-IN')}</span>` : ''}
          </div>
          <div class="card-rating">
            <span class="stars">${'★'.repeat(Math.floor(d.rating))}</span>
            <span class="rating-count">(${d.rev})</span>
          </div>
        </div>
      </div>
    </div>
  `).join('');

      renderChips();
    }

    function toggleStyle(checkbox, style) {
      if (checkbox.checked) {
        selStyles.add(style);
      } else {
        selStyles.delete(style);
      }

      render();
    }

    function renderChips() {
      const chips = [];
      if (category !== 'All') chips.push({ label: category, action: () => { category = 'All'; document.querySelectorAll('.side-nav-link').forEach(l => l.classList.remove('active')); document.querySelector('.side-nav-link').classList.add('active'); render(); } });
      if (maxPrice < 15000) chips.push({ label: `≤ ₹${maxPrice.toLocaleString('en-IN')}`, action: () => { maxPrice = 15000; document.getElementById('priceSlider').value = 15000; document.getElementById('priceLabel').textContent = 'Up to ₹15,000'; render(); } });
      if (query) chips.push({ label: `"${query}"`, action: () => { query = ''; document.getElementById('navSearchInput').value = ''; render(); } });
      selSizes.forEach(s => chips.push({ label: `Size: ${s}`, action: () => { selSizes.delete(s); document.querySelectorAll('.size-chip').forEach(b => { if (b.textContent === s) b.classList.remove('active'); }); render(); } }));

      document.getElementById('chipBar').innerHTML = chips.map((c, i) =>
        `<div class="filter-chip">${c.label}<i class="fas fa-times" data-ci="${i}"></i></div>`
      ).join('');

      document.querySelectorAll('#chipBar .fa-times').forEach(el => {
        el.addEventListener('click', () => { chips[+el.dataset.ci].action(); });
      });
    }

    /* ───────── CONTROLS ───────── */
    function setCategory(el, cat) {
      category = cat;
      document.querySelectorAll('.side-nav-link').forEach(l => l.classList.remove('active'));
      el.classList.add('active');
      render();
    }

    function toggleSize(btn, size) {
      selSizes.has(size) ? selSizes.delete(size) : selSizes.add(size);
      btn.classList.toggle('active');
      render();
    }

    function toggleColor(dot, color) {
      selColors.has(color) ? selColors.delete(color) : selColors.add(color);
      dot.classList.toggle('active');
      toast(`Color filter: ${color}`, 'fa-palette');
      render();
    }

    function handlePrice(val) {
      maxPrice = parseInt(val);
      document.getElementById('priceLabel').textContent = `Up to ₹${parseInt(val).toLocaleString('en-IN')}`;
      render();
    }

    function setRating(btn, val) {
      minRating = val;
      document.querySelectorAll('.size-chip').forEach(b => {
        if (b.textContent.includes('★') || b.textContent === 'All') b.classList.remove('active');
      });
      btn.classList.add('active');
      render();
    }

    function handleSearch(val) { query = val; render(); }

    function clearAll() {
      category = 'All'; selSizes.clear(); selColors.clear();
      maxPrice = 15000; minRating = 0; query = '';
      document.getElementById('priceSlider').value = 15000;
      document.getElementById('priceLabel').textContent = 'Up to ₹15,000';
      document.getElementById('navSearchInput').value = '';
      document.querySelectorAll('.size-chip').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.color-dot').forEach(d => d.classList.remove('active'));
      document.querySelectorAll('input[type=checkbox]').forEach(c => c.checked = false);
      document.querySelectorAll('.side-nav-link').forEach(l => l.classList.remove('active'));
      document.querySelector('.side-nav-link').classList.add('active');
      render();
    }

    /* ───────── CART / WISH ───────── */
    function addCart(id) {
      cartCount++;
      const badge = document.getElementById('cartBadge');
      badge.textContent = cartCount;
      badge.style.display = 'flex';
      const d = DRESSES.find(x => x.id === id);
      toast(`${d.name} added to bag`, 'fa-bag-shopping');
    }

    function toggleWish(id) {
      wishlist.has(id) ? wishlist.delete(id) : wishlist.add(id);
      const btn = document.getElementById(`wl${id}`);
      if (btn) {
        btn.classList.toggle('liked', wishlist.has(id));
        btn.innerHTML = `<i class="${wishlist.has(id) ? 'fas' : 'far'} fa-heart"></i>`;
      }
      document.getElementById('wishDot').style.display = wishlist.size ? 'block' : 'none';
      toast(wishlist.has(id) ? 'Saved to wishlist' : 'Removed from wishlist', 'fa-heart');
    }

    /* ───────── SIDEBAR ───────── */
    function toggleSidebar() {
      const sb = document.getElementById('sidebar');
      const mobile = window.innerWidth <= 992;
      if (mobile) {
        sb.classList.toggle('mobile-open');
        document.getElementById('sidebarOverlay').classList.toggle('active', sb.classList.contains('mobile-open'));
      } else {
        collapsed = !collapsed;
        sb.classList.toggle('collapsed', collapsed);
      }
    }
    function closeMobile() {
      document.getElementById('sidebar').classList.remove('mobile-open');
      document.getElementById('sidebarOverlay').classList.remove('active');
    }

    /* ───────── BANNER ───────── */
    function closeBanner() {
      document.getElementById('top-banner').style.display = 'none';
      document.getElementById('top-nav').classList.add('banner-gone');
      document.getElementById('sidebar').style.top = 'var(--nav-h)';
      document.getElementById('sidebar').style.height = 'calc(100vh - var(--nav-h))';
    }

    /* ───────── TOAST ───────── */
    function toast(msg, icon = 'fa-circle-check') {
      const wrap = document.getElementById('toastWrap');
      const el = document.createElement('div');
      el.className = 'toast-msg';
      el.innerHTML = `<i class="fas ${icon}"></i><span>${msg}</span>`;
      wrap.appendChild(el);
      setTimeout(() => {
        el.style.animation = 'toastOut .3s ease forwards';
        setTimeout(() => el.remove(), 320);
      }, 2800);
    }

    /* ───────── INIT ───────── */
    render();
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>