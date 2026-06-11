<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>BookCycle – Student Textbook Exchange</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>

<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- HEADER -->
<header>
  <div class="header-inner">

    <a href="index.php" class="logo">
      <div class="logo-icon">📚</div>
      BookCycle
    </a>

    <nav>
      <a href="index.php" class="active">Browse</a>
      <a href="create-listings.php">Sell a Book</a>
      <a href="listings.php">My Listings</a>
      <a href="#how">How it Works</a>
    </nav>

    <div class="header-actions">
      <a href="login.php" class="btn btn-ghost">Log In</a>
      <a href="register.php" class="btn btn-accent">Sign Up</a>
      </div>

  </div>
</header>

<!-- HERO -->
<section class="hero">
  <div class="hero-inner">

  <div class="hero-text">

    <h1>Your campus.<br>
    <span>Cheaper textbooks.</span><br>
    Zero hassle.</h1>

    <p>
      BookCycle connects Eduvos students to buy and sell second-hand textbooks safely.
    </p>

    <div class="hero-ctas">
      <button class="btn btn-accent btn-ghost">
        Browse Books →
      </button>

      <a href="create-listings.php">
        <button class="btn btn-green">
          Sell a Textbook
        </button>
      </a>
    </div>
 
      <div class="hero-stats">
        <div class="stat"><div class="stat-num">5K+</div><div class="stat-label">Students</div></div>
        <div class="stat"><div class="stat-num">1.2K</div><div class="stat-label">Listings</div></div>
        <div class="stat"><div class="stat-num">3</div><div class="stat-label">Campuses</div></div>
        <div class="stat"><div class="stat-num">R180</div><div class="stat-label">Avg. Saving</div></div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="hero-search">
        <input type="text" placeholder="Search by title, ISBN, or course code…" id="heroSearchInput"/>
        <button onclick="doSearch()">🔍</button>
      </div>
      <div class="featured-books" id="heroBooks"></div>
    </div>
  </div>
</section>

<!-- SEARCH BAR -->
<div class="search-bar-section">
  <div class="search-bar-inner">
    <div class="search-main">
      <input type="text" placeholder="Search books, ISBN, course…" id="mainSearch" oninput="filterBooks()"/>
      <span class="search-icon">🔍</span>
    </div>
    <div class="filter-group">
      <select class="filter-select" id="filterSubject" onchange="filterBooks()">
        <option value="">All Subjects</option>
        <option>IT & Computer Science</option>
        <option>Business & Commerce</option>
        <option>Engineering</option>
        <option>Law</option>
        <option>Health Sciences</option>
        <option>Humanities</option>
      </select>
      <select class="filter-select" id="filterUni" onchange="filterBooks()">
        <option value="">All Campuses</option>
        <option>Eduvos Pretoria Campus</option>
        <option>Eduvos Bedfordview Campus</option>
        <option>Eduvos Midrand Campus</option>
      </select>
      <select class="filter-select" id="filterCond" onchange="filterBooks()">
        <option value="">Any Condition</option>
        <option>New</option>
        <option>Good</option>
        <option>Fair</option>
      </select>
    </div>
    <button class="search-btn" onclick="filterBooks()">Search</button>
  </div>
</div>

<!-- MAIN -->
<main>

  <!-- CATEGORIES -->
  <div class="categories" id="catChips"></div>

  <!-- LISTINGS HEADER -->
  <div class="section-header">
    <h2 class="section-title">Recent Listings</h2>
    <a href="#" class="section-link">View all →</a>
  </div>

  <!-- BOOK GRID -->
  <div class="book-grid" id="bookGrid"></div>

  <!-- SELL CTA -->
  <div class="sell-cta">
    <div>
      <h2>Got textbooks collecting dust?</h2>
      <p>List them in under 2 minutes. Reach thousands of verified students. Get paid securely through our escrow system.</p>
      <div class="sell-cta-actions">
        <button class="btn btn-accent" onclick="openModal('sell-modal');return false;">List a Textbook</button>
        <button class="btn btn-ghost" onclick="openModal('auth-modal');return false;">Create Free Account</button>
      </div>
    </div>
    <div style="font-size:4rem;opacity:.15;position:relative;z-index:1;">📚</div>
  </div>

  <!-- HOW IT WORKS -->
  <div id="how" class="how-it-works">
    <div class="section-header">
      <h2 class="section-title">How BookCycle Works</h2>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step-num">1</div>
        <div class="step-icon">🎓</div>
        <h3>Verify your student email</h3>
        <p>Sign up with your official school email address to unlock verified access and build trust with other students.</p>
      </div>
      <div class="step">
        <div class="step-num">2</div>
        <div class="step-icon">📖</div>
        <h3>List or browse textbooks</h3>
        <p>Search by course code, ISBN, or subject. Sellers add photos, condition notes, and a price — no guesswork.</p>
      </div>
      <div class="step">
        <div class="step-num">3</div>
        <div class="step-icon">💬</div>
        <h3>Chat securely in-app</h3>
        <p>Message sellers directly through our secure in-app chat. No sharing phone numbers with strangers.</p>
      </div>
      <div class="step">
        <div class="step-num">4</div>
        <div class="step-icon">🔒</div>
        <h3>Pay with escrow protection</h3>
        <p>Funds are held securely until you confirm receipt of the book. No more payment scams or lost money.</p>
      </div>
      <div class="step">
        <div class="step-num">5</div>
        <div class="step-icon">⭐</div>
        <h3>Rate your experience</h3>
        <p>Build your reputation. Leave honest reviews that help the whole student community transact with confidence.</p>
      </div>
    </div>
  </div>

  <!-- TRUST -->
  <div class="trust">
    <div class="trust-item"><div class="trust-icon">✅</div><div class="trust-label">Verified Students Only</div><div class="trust-desc">School email required</div></div>
    <div class="trust-item"><div class="trust-icon">🔐</div><div class="trust-label">Escrow Payments</div><div class="trust-desc">Money held until delivery confirmed</div></div>
    <div class="trust-item"><div class="trust-icon">⭐</div><div class="trust-label">Ratings & Reviews</div><div class="trust-desc">Transparent seller history</div></div>
    <div class="trust-item"><div class="trust-icon">📱</div><div class="trust-label">Mobile-First Design</div><div class="trust-desc">Optimized for low-data</div></div>
    <div class="trust-item"><div class="trust-icon">🚨</div><div class="trust-label">Fraud Reporting</div><div class="trust-desc">Dedicated support team</div></div>
  </div>

</main>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="#" class="logo">
          <div class="logo-icon">📚</div> BookCycle
        </a>
        <p>A secure, student-verified C2C marketplace for second-hand textbooks at Eduvos Institutions in Gauteng. Save money. Study more.</p>
      </div>
      <div class="footer-col">
        <h4>Marketplace</h4>
        <a href="#">Browse All Books</a>
        <a href="#">New Arrivals</a>
        <a href="#">By Campus</a>
        <a href="#">By Subject</a>
      </div>
      <div class="footer-col">
        <h4>Account</h4>
        <a href="#" onclick="openModal('auth-modal');return false;">Sign Up</a>
        <a href="#" onclick="openModal('auth-modal');return false;">Log In</a>
        <a href="#">My Listings</a>
        <a href="#">My Orders</a>
      </div>
      <div class="footer-col">
        <h4>Help</h4>
        <a href="#">How It Works</a>
        <a href="#">Safety Tips</a>
        <a href="#">Report a Listing</a>
        <a href="#">Contact Us</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 BookCycle — ITECA3-12 Project | Zoë Qobo </span>
      <div style="display:flex;gap:20px;">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookies</a>
      </div>
    </div>
  </div>
</footer>

<!-- MOBILE NAV -->
<nav class="mobile-nav">
  <a href="#" class="active"><span>🏠</span><span>Home</span></a>
  <a href="#"><span>🔍</span><span>Search</span></a>
  <a href="#" onclick="openModal('sell-modal');return false;"><span>➕</span><span>Sell</span></a>
  <a href="#"><span>💬</span><span>Messages</span></a>
  <a href="#" onclick="openModal('auth-modal');return false;"><span>👤</span><span>Account</span></a>
</nav>

<!-- AUTH MODAL -->
<div class="modal-overlay" id="auth-modal" onclick="closeModalOnBg(event,'auth-modal')">
  <div class="modal">
    <button class="modal-close" onclick="closeModal('auth-modal')">✕</button>
    <div class="tab-switcher">
      <button class="tab-btn active" onclick="switchTab('login')">Log In</button>
      <button class="tab-btn" onclick="switchTab('signup')">Sign Up</button>
    </div>
    <div id="login-form">
      <h2>Welcome back</h2>
      <p class="subtitle">Log in to your BookCycle account.</p>
      <div class="form-group">
        <label>Student Email</label>
        <input type="email" placeholder="you@university.ac.za"/>
        <div class="form-note">Use your official tertiary institution email address</div>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" placeholder="••••••••"/>
      </div>
      <button class="btn btn-accent btn-full" onclick="fakeLogin()">Log In</button>
      <div class="divider">or</div>
      <button class="social-btn">🎓 Continue with Eduvos SSO</button>
    </div>
    <div id="signup-form" style="display:none;">
      <h2>Join BookCycle</h2>
      <p class="subtitle">Save money on textbooks. Start selling today.</p>
      <div class="form-row">
        <div class="form-group"><label>First Name</label><input type="text" placeholder="Zoë"/></div>
        <div class="form-group"><label>Last Name</label><input type="text" placeholder="Qobo"/></div>
      </div>
      <div class="form-group">
        <label>Student Email</label>
        <input type="email" placeholder="s12345678@university.ac.za"/>
        <div class="form-note">✅ Must be an official tertiary institution email for verification</div>
      </div>
      <div class="form-group">
        <label>Institution</label>
        <select>
          <option>Eduvos Pretoria Campus</option>
          <option>Eduvos Midrand Campus</option>
          <option>Eduvos Bedfordview Campus</option>
        </select>
      </div>
      <div class="form-group"><label>Password</label><input type="password" placeholder="Min. 8 characters"/></div>
      <button class="btn btn-accent btn-full" onclick="fakeLogin()">Create My Account</button>
    </div>
  </div>
</div>

<!-- SELL MODAL -->
<div class="modal-overlay" id="sell-modal" onclick="closeModalOnBg(event,'sell-modal')">
  <div class="modal">
    <button class="modal-close" onclick="closeModal('sell-modal')">✕</button>
    <h2>List a Textbook</h2>
    <p class="subtitle">Fill in the details below. It only takes 2 minutes.</p>
    <div class="form-group"><label>Book Title *</label><input type="text" placeholder="e.g. Computer Networks: A Top-Down Approach"/></div>
    <div class="form-group"><label>Author(s)</label><input type="text" placeholder="e.g. Kurose & Ross"/></div>
    <div class="form-row">
      <div class="form-group"><label>ISBN</label><input type="text" placeholder="978-…"/></div>
      <div class="form-group"><label>Edition</label><input type="text" placeholder="e.g. 8th"/></div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Subject / Module</label>
        <select>
          <option>IT & Computer Science</option>
          <option>Business & Commerce</option>
          <option>Engineering</option>
          <option>Law</option>
          <option>Health Sciences</option>
          <option>Humanities</option>
        </select>
      </div>
      <div class="form-group">
        <label>Condition</label>
        <select>
          <option>New (sealed/unused)</option>
          <option>Good (minor wear)</option>
          <option>Fair (notes/highlights)</option>
        </select>
      </div>
    </div>
    <div class="form-group"><label>Asking Price (R) *</label><input type="number" placeholder="e.g. 250"/></div>
    <div class="form-group">
      <label>Description</label>
      <textarea placeholder="Any highlights, missing pages, extra notes included…"></textarea>
    </div>
    <button class="btn btn-accent btn-full" onclick="submitListing()">Publish Listing</button>
  </div>
</div>

<!-- BOOK DETAIL MODAL -->
<div class="modal-overlay" id="book-modal" onclick="closeModalOnBg(event,'book-modal')">
  <div class="modal">
    <button class="modal-close" onclick="closeModal('book-modal')">✕</button>
    <div id="book-detail-content"></div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
  <span class="toast-icon" id="toast-icon">✅</span>
  <span id="toast-msg">Action completed!</span>
</div>
  
<script src="assets/js/script.js"></script>
</body>
</html>