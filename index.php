<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Riot Games Inspired Sign-in</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <style>
    /* Reset and base */
    *, *::before, *::after {
      box-sizing: border-box;
    }
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Inter', sans-serif;
      background-color: #0b0b23;
      color: #121212;
      overflow-x: hidden;
    }

    /* Background image container */
    .background {
      position: fixed;
      inset: 0;
      z-index: -1;
      background: url("https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/f3168043-ac14-4c25-99a4-71905faafdda.png") no-repeat center center/cover;
      filter: brightness(0.45);
    }

    /* Overlay for subtle dark overlay */
    .overlay {
      position: fixed;
      inset: 0;
      background: rgba(11,11,35,0.75);
      z-index: -1;
    }

    /* Container to horizontally and vertically center content */
    .container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    /* Sign-in box */
    .signin-box {
      background: white;
      border-radius: 12px;
      padding: 40px 48px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 8px 24px rgba(0,0,0,0.25);
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .signin-box h2 {
      margin: 0;
      font-weight: 700;
      font-size: 1.5rem;
      color: #090909;
      text-align: center;
    }

    /* Input styling */
    label {
      display: block;
      font-size: 0.75rem;
      font-weight: 600;
      color: #666666;
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      border-radius: 8px;
      border: 1px solid #d9d9d9;
      font-size: 1rem;
      outline-offset: 2px;
      transition: border-color 0.3s ease;
    }
    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #0078d4;
      outline: none;
      box-shadow: 0 0 6px #0078d4;
    }

    /* Social buttons container */
    .social-buttons {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: -4px;
      margin-bottom: 12px;
    }
    button.social-btn {
      border: none;
      border-radius: 8px;
      padding: 10px 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.25s ease;
      flex: 1 1 0;
      max-width: 48px;
      min-width: 48px;
      height: 40px;
    }
    button.social-btn:focus {
      outline: 2px solid #3742fa;
      outline-offset: 2px;
    }
    button.social-btn:hover {
      transform: scale(1.05);
    }

    /* Individual brand colors and icons */
    .facebook {
      background: #1877f2;
      color: white;
    }
    .google {
      background: white;
      border: 1px solid #ddd;
      color: #444;
    }
    .apple {
      background: black;
      color: white;
    }
    .xbox {
      background: #107c10;
      color: white;
    }
    .playstation {
      background: #003791;
      color: white;
    }

    .material-icons {
      font-size: 20px;
    }

    /* Checkbox container */
    .checkbox-group {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.875rem;
      color: #444;
      user-select: none;
    }
    .checkbox-group input[type="checkbox"] {
      width: 18px;
      height: 18px;
      cursor: pointer;
    }

    /* Submit arrow button */
    .submit-btn {
      border: 2px solid #c0c0c0;
      background: transparent;
      border-radius: 50%;
      width: 56px;
      height: 56px;
      margin: 20px auto 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      color: #777;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 0 0 0 transparent;
    }
    .submit-btn:hover {
      border-color: #0078d4;
      color: #0078d4;
      box-shadow: 0 0 8px #0078d4;
    }
    .submit-btn:focus {
      outline: 2px solid #0078d4;
      outline-offset: 3px;
      box-shadow: 0 0 10px #0078d4;
    }

    /* Create account and help links container */
    .help-links {
      display: flex;
      justify-content: center;
      gap: 12px;
      font-weight: 700;
      font-size: 0.75rem;
      color: #444;
      text-transform: uppercase;
      margin-top: 36px;
    }
    .help-links a {
      color: #444;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .help-links a:hover,
    .help-links a:focus {
      color: #0078d4;
      outline: none;
      text-decoration: underline;
    }

    /* Header and Footer styling */
    header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 60px;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(12px);
      display: flex;
      align-items: center;
      padding: 0 24px;
      z-index: 10;
      color: white;
    }

    header .logo {
      font-weight: 800;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: default;
    }
    header .logo img {
      width: 32px;
      height: 32px;
      user-select: none;
    }

    /* Hamburger menu button - mobile only */
    .hamburger {
      display: none;
      cursor: pointer;
      margin-left: auto;
      flex-direction: column;
      gap: 6px;
      width: 28px;
      height: 24px;
    }
    .hamburger span {
      height: 3px;
      background: white;
      border-radius: 3px;
      display: block;
      width: 100%;
      transition: background-color 0.3s ease;
    }

    /* Responsive nav - mobile overlay */
    nav.mobile-nav {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(11,11,35,0.96);
      z-index: 20;
      padding: 60px 24px 24px 24px;
      flex-direction: column;
      gap: 32px;
    }
    nav.mobile-nav.show {
      display: flex;
    }
    nav.mobile-nav a {
      color: white;
      font-size: 1.25rem;
      font-weight: 700;
      text-decoration: none;
      border-bottom: 2px solid transparent;
      padding-bottom: 4px;
      transition: border-color 0.3s ease;
    }
    nav.mobile-nav a:hover,
    nav.mobile-nav a:focus {
      border-color: #0078d4;
      outline: none;
    }

    /* Footer styles */
    footer {
      background: rgba(0,0,0,0.7);
      color: #ddd;
      font-size: 0.75rem;
      padding: 8px 24px;
      text-align: center;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      backdrop-filter: blur(12px);
      z-index: 10;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 12px;
    }
    footer a {
      color: #ddd;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }
    footer a:hover,
    footer a:focus {
      color: #0078d4;
      outline: none;
      text-decoration: underline;
    }

    /* Responsive typography and layout */
    @media (max-width: 767px) {
      .signin-box {
        max-width: 100%;
        padding: 32px 24px;
        border-radius: 8px;
      }
      .container {
        padding: 16px;
      }
      header .logo {
        font-size: 1.25rem;
      }
      .hamburger {
        display: flex;
      }
    }
    @media (min-width: 768px) {
      nav.mobile-nav {
        display: none !important;
      }
    }
    @media (min-width: 1440px) {
      .signin-box {
        max-width: 500px;
        padding: 56px 64px;
        border-radius: 16px;
      }
      .container {
        padding: 40px;
      }
    }
  </style>
</head>
<body>
  <div class="background" role="img" aria-label="Vibrant game-themed illustration with characters from fantasy shooter games"></div>
  <div class="overlay"></div>

  <header>
    <div class="logo" aria-label="Riot Games logo">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/688ff8f7-5b3e-4e12-8d0b-b6df15583baf.png" alt="Riot Games logo placeholder" />
      Riot Games
    </div>
    <div class="hamburger" role="button" aria-label="Toggle navigation menu" tabindex="0" aria-expanded="false" aria-controls="mobile-nav" id="hamburgerBtn">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </header>

  <nav class="mobile-nav" id="mobile-nav" role="navigation" aria-label="Mobile navigation menu">
    <a href="#">Support</a>
    <a href="#">Privacy Notice</a>
    <a href="#">Terms of Service</a>
    <a href="#">Cookie Preferences</a>
    <a href="#">Create Account</a>
  </nav>

  <main class="container" role="main">
    <form class="signin-box" aria-labelledby="signinHeading" novalidate>
      <h2 id="signinHeading">Sign in</h2>
      
      <label for="username">Username</label>
      <input id="username" name="username" type="text" autocomplete="username" required aria-required="true" />
      
      <label for="password">Password</label>
      <input id="password" name="password" type="password" autocomplete="current-password" required aria-required="true" />

      <div class="social-buttons" aria-label="Social sign-in options">
        <button type="button" class="social-btn facebook" aria-label="Sign in with Facebook">
          <span class="material-icons">facebook</span>
        </button>
        <button type="button" class="social-btn google" aria-label="Sign in with Google">
          <span class="material-icons">google</span>
        </button>
        <button type="button" class="social-btn apple" aria-label="Sign in with Apple">
          <span class="material-icons">apple</span>
        </button>
        <button type="button" class="social-btn xbox" aria-label="Sign in with Xbox">
          <svg width="20" height="20" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M12 0l3.224 12.09-2.275-1.425c-.75.335-1.582.506-2.447.506-.73 0-1.43-.147-2.064-.425l-2.438 1.316L12 0zM12 24l-4.263-16.404 2.2-.549c.61.27 1.27.419 1.982.419.742 0 1.434-.179 2.077-.523l2.006 4.416-3.77 9.641zm7.937-3.97L17.418 10.44l2.14 9.503 1.379-1.913zm-7.03-2.638 1.021 2.539 3.128-7.998-1.98-4.353-2.169 13.812z"/></svg>
        </button>
        <button type="button" class="social-btn playstation" aria-label="Sign in with PlayStation">
          <svg width="20" height="20" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M9.96 17.132 6.171 8.354l2.65-.978 1.14 2.8 1.973-6.145 3.566 12.887-2.498-3.293-3.042 1.307z"/></svg>
        </button>
      </div>

      <label class="checkbox-group">
        <input type="checkbox" name="staySignedIn" />
        Stay signed in
      </label>

      <button type="submit" class="submit-btn" aria-label="Proceed to sign in">
        <span class="material-icons" aria-hidden="true">arrow_forward</span>
      </button>

      <div class="help-links" role="group" aria-label="Sign in assistance links">
        <a href="#">Can't sign in?</a>
        <a href="#">Create account</a>
      </div>
    </form>
  </main>

  <footer>
    <a href="#" aria-label="Support">Support</a>
    <span aria-hidden="true">|</span>
    <a href="#" aria-label="Privacy Notice">Privacy Notice</a>
    <span aria-hidden="true">|</span>
    <a href="#" aria-label="Terms of Service">Terms of Service</a>
    <span aria-hidden="true">|</span>
    <a href="#" aria-label="Cookie Preferences">Cookie Preferences</a>
    <span aria-hidden="true">|</span>
    <a href="#" aria-label="Change Language">EN</a>
  </footer>

  <script>
    // Hamburger menu toggle
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileNav = document.getElementById('mobile-nav');

    hamburgerBtn.addEventListener('click', () => {
      const expanded = hamburgerBtn.getAttribute('aria-expanded') === 'true' || false;
      hamburgerBtn.setAttribute('aria-expanded', !expanded);
      mobileNav.classList.toggle('show');
    });

    hamburgerBtn.addEventListener('keydown', e => {
      if(e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        hamburgerBtn.click();
      }
    });
  </script>
</body>
</html>

