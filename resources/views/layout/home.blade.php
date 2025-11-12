<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choco Fruits - @yield('title', 'Accueil')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      --brand:#d6a354;
      --muted:#6c6c6c;
      --nav-height:72px;
    }

    body{
      font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      margin:0;
      padding-top:var(--nav-height);
      background:#fff;
      color:#222;
    }

    /* Navbar */
    .site-navbar{
      height:var(--nav-height);
      box-shadow: 0 4px 18px rgba(20,20,20,0.04);
      background:#fff;
    }

    .navbar-brand img{
      height:52px;
      transition:transform .25s ease;
    }
    .navbar-brand img:hover{ transform:scale(1.04); }

    .nav-link{ color:inherit; font-weight:500;}
    .nav-link.active, .nav-link:hover{ color:var(--brand); }

    .cart-badge{
      position:absolute;
      top:-6px; right:-10px;
      background:#000; color:#fff;
      border-radius:50%; font-size:11px;
      width:18px; height:18px; display:flex; align-items:center; justify-content:center;
    }

    /* Search */
    .nav-search .form-control{ min-width:200px; max-width:420px; }

    /* Product / content spacing handled by pages */
    @media (max-width:991px){
      .nav-search .form-control{ min-width:140px; }
      .navbar-brand img{ height:44px; }
      body{ padding-top:64px; }
    }

    /* small UI polish */
    .icon-btn{ background:transparent; border:none; font-size:1.05rem; color:inherit; }
    .offcanvas-body .nav-link{ padding:0.5rem 0; }
    /* ligne commandd */
    .icon-btn {
  background: none;
  border: none;
  cursor: pointer;
  transition: transform 0.2s ease, color 0.2s ease;
}

.icon-btn:hover i {
  color: #c59d5f;
  transform: scale(1.1);
}

  </style>
</head>
<body>
  <nav class="site-navbar navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <!-- Mobile toggler (offcanvas) -->
      <button class="btn btn-light d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Ouvrir le menu">
        <i class="bi bi-list"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand me-3" href="{{ route('home') }}">
        <img src="{{ asset('images/logo_fruits.jpg') }}" alt="Choco Fruits">
      </a>

      <!-- Left: primary links (visible on lg+) -->
      <div class="d-none d-lg-flex align-items-center gap-3">
        <a href="{{ route('home') }}" class="text-decoration-none text-muted" title="Accueil" aria-label="Accueil">
          <i class="bi bi-house me-1" style="color:var(--muted)"></i> Accueil
        </a>

        <a href="{{ route('boutique') }}" class="text-decoration-none text-muted" title="Boutique" aria-label="Boutique">
          <i class="bi bi-shop me-1" style="color:var(--muted)"></i> Boutique
        </a>

        <a href="{{ route('lignecommande') }}" class="text-decoration-none text-muted" title="Suivre une commande" aria-label="Suivre une commande">
          <i class="bi bi-clock-history me-1" style="color:var(--muted)"></i> Suivi
        </a>

        <a href="{{ route('about') }}" class="text-decoration-none text-muted" title="À propos" aria-label="À propos">
          <i class="bi bi-info-circle me-1" style="color:var(--muted)"></i> À propos
        </a>
      </div>

      <!-- Right: search + login + cart -->
      <div class="ms-auto d-flex align-items-center gap-3">
        <!-- Search: hidden on very small screens -->
        <form action="{{ route('boutique') }}" method="GET" class="d-none d-md-flex align-items-center">
          <input name="q" value="{{ request('q') }}" class="form-control form-control-sm me-2" placeholder="Rechercher..." aria-label="Recherche">
          <button class="btn btn-dark btn-sm" type="submit">Rechercher</button>
        </form>

        <!-- Login icon (opens modal or link) -->
        <a href="{{ route('login') }}" class="text-decoration-none text-muted" title="Se connecter" aria-label="Se connecter" data-bs-toggle="modal" data-bs-target="#loginModal">
          <i class="bi bi-person" style="font-size:1.2rem; color:var(--muted)"></i>
          Se connecter
        </a>

        <!-- Cart icon -->
        {{-- <a href="{{ route('cart') ?? '#' }}" class="text-decoration-none text-dark position-relative" title="Panier" aria-label="Panier">
          <i class="bi bi-bag" style="font-size:1.2rem"></i>
          <span class="cart-badge">{{ session('cart_count', 0) }}</span>
        </a> --}}
        
        <!-- Mobile: boutique quick icon (visible only on small screens) -->
        <a href="{{ route('boutique') }}" class="d-flex d-lg-none text-decoration-none text-muted ms-2" title="Boutique" aria-label="Boutique">
          <i class="bi bi-shop" style="font-size:1.25rem; color:var(--muted)"></i>
        </a>
      </div>
    </div>
  </nav>

  <!-- Offcanvas mobile menu -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
    </div>
    <div class="offcanvas-body">
      <form action="{{ route('boutique') }}" method="GET" class="mb-3">
        <div class="input-group">
          <input name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Rechercher..." aria-label="Recherche mobile">
          <button class="btn btn-dark btn-sm" type="submit"><i class="bi bi-search"></i></button>
        </div>
      </form>

      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Choco Fruits</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('boutique') }}">Boutique</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('lignecommande') }}">Suivi de commande</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
      </ul>

      <div class="mt-4">
        <button class="btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginModal">Se connecter</button>
        {{-- {{ route('register') ?? '#' }} --}}
        <a href="{{ route('register' ?? '#' ) }}" class="btn btn-outline-dark w-100">S'inscrire</a>
      </div>
    </div>
  </div>

  <!-- Login modal (simple) -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        {{-- {{ route('login.attempt') }} --}}
        <form action="{{ route('login.submit') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Connexion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
          </div>
          <div class="modal-body">
            <div class="mb-2">
              <label class="form-label small">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-sm" required>
              @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="mb-2">
              <label class="form-label small">Mot de passe</label>
              <input type="password" name="password" class="form-control form-control-sm" required>
              @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="form-check mb-2">
              <input id="remember" type="checkbox" name="remember" class="form-check-input">
              <label class="form-check-label small" for="remember">Se souvenir</label>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-dark">Se connecter</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <main class="container">
    @yield('content')
  </main>

  <!-- Footer: professional, responsive, phone-centered (updated: white bg, black titles) -->
  <footer class="site-footer" aria-label="Pied de page">
    <div class="footer-top">
      <div class="footer-brand">
        <div class="logo">Choco<span>Fruits</span></div>
        <p>Produits artisanaux — fruits enrobés de chocolat, livrés soigneusement partout au Maroc.</p>

        <div class="socials" aria-label="Réseaux sociaux">
        <a href="https://facebook.com" aria-label="Facebook" class="soc">
          <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="social-icon">
        </a>

        <a href="https://instagram.com" aria-label="Instagram" class="soc">
          <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="social-icon">
        </a>

        <a href="https://wa.me/2126xxxxxxxx" aria-label="WhatsApp" class="soc">
          <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="social-icon">
        </a>
      </div>

      </div>

      <div class="footer-links">
        <div class="links-block">
          <h4>Rubriques</h4>
          <ul>
            <li><a href="{{ route('boutique') }}">Produits</a></li>
            <li><a href="#">Offres</a></li>
            <li><a href="#">FAQ</a></li>
          </ul>
        </div>

        <div class="links-block">
          <h4>Assistance</h4>
          <ul>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="#">Conditions d'utilisation</a></li>
            <li><a href="#">Politique de confidentialité</a></li>
            <li><a href="#">Politique de retour</a></li>
          </ul>
        </div>

        <div class="links-block">
          <h4>Livraison</h4>
          <ul>
            <li><a href="#">Livraison au Maroc</a></li>
            <li><a href="#">Tarifs</a></li>
            <li><a href="{{ route('lignecommande') }}">Suivi de commande</a></li>
          </ul>
        </div>

        {{-- <div class="newsletter">
          <h4>Inscription newsletter</h4>
          <p class="muted">Recevez nos offres et nouveautés directement par email.</p>
          <form class="news-form" method="POST" action="#">
            @csrf
            <label for="footer-email" class="sr-only">Email</label>
            <input id="footer-email" name="email" type="email" placeholder="Votre email" required>
            <button type="submit">S'abonner</button>
          </form>
        </div> --}}
      </div>
    </div>

    <div class="footer-bottom">
      <p>© <span id="year"></span> ChocoFruits. Tous droits réservés.</p>
      <nav aria-label="Liens rapides">
        <a href="#">Politique de confidentialité</a>
        <a href="#">Conditions</a>
        <a href="{{ route('contact') }}">Nous contacter</a>
      </nav>
    </div>
  </footer>

  <style>
  :root{
    --f-bg:#ffffff;
    --f-muted:#333333;
    --f-accent:#ef8a25;
    --f-maxw:1200px;
    --f-gap:22px;
  }

  /* White footer with dark text */
  .site-footer{
    background: var(--f-bg);
    color:var(--f-muted);
    padding:40px 18px;
    box-sizing:border-box;
    border-top:1px solid rgba(0,0,0,0.06);
  }
  .footer-top{
    max-width:var(--f-maxw);
    margin:0 auto;
    display:grid;
    grid-template-columns: 320px 1fr;
    gap:var(--f-gap);
    align-items:start;
    padding-bottom:26px;
    border-bottom:1px solid rgba(0,0,0,0.06);
  }

  /* brand */
  .footer-brand .logo{
    font-weight:700;
    font-size:22px;
    color:#000; /* black title */
    margin-bottom:8px;
  }
  .footer-brand .logo span{ color:var(--f-accent); margin-left:6px; font-weight:800;}
  .footer-brand p{ color:rgba(0,0,0,0.7); margin:8px 0 14px; line-height:1.5; max-width:320px;}

  /* social icons centered and real fill */
  .socials{display:flex; gap:10px; align-items:center; justify-content:center; margin-top:6px;}
  .soc{ display:inline-flex; width:44px; height:44px; background:transparent; border-radius:8px; align-items:center; justify-content:center; text-decoration:none; transition:transform .15s ease, background .15s ease; border:1px solid rgba(0,0,0,0.06); }
  .soc svg{ width:20px; height:20px; fill:var(--f-muted); }
  .soc:hover{ transform:translateY(-3px); background:rgba(239,138,37,0.06); }

  /* links grid and titles black */
  .footer-links{
    display:grid;
    grid-template-columns: repeat(3, 1fr) 320px;
    gap:var(--f-gap);
    align-items:start;
    padding-inline:10px;
  }
  .links-block h4, .newsletter h4{
    color:#000; /* black section titles */
    margin:0 0 10px;
    font-size:16px;
  }
  .links-block ul{ list-style:none; padding:0; margin:0; }
  .links-block ul li{ margin:8px 0; }
  .links-block ul li a{
    color:rgba(0,0,0,0.65);
    text-decoration:none;
    font-size:14px;
    transition: color .12s;
  }
  .links-block ul li a:hover{ color:var(--f-accent); text-decoration:underline; }

  .newsletter p{ margin:0 0 10px; font-size:14px; color:rgba(0,0,0,0.65); }
  .news-form{ display:flex; gap:8px; align-items:center; justify-content:flex-start; }
  .news-form input{
    flex:1;
    padding:10px 12px;
    border-radius:8px;
    border:1px solid rgba(0,0,0,0.08);
    background:#fafafa;
    color:var(--f-muted);
    outline:none;
  }
  .news-form input::placeholder{ color:rgba(0,0,0,0.35); }
  .news-form button{
    padding:10px 14px;
    border-radius:8px;
    border:0;
    background:var(--f-accent);
    color:#fff;
    cursor:pointer;
    font-weight:600;
    box-shadow: 0 6px 18px rgba(239,138,37,0.12);
  }

  .footer-bottom{
    max-width:var(--f-maxw);
    margin:20px auto 0;
    display:flex;
    justify-content:space-between;
    gap:12px;
    align-items:center;
    padding-top:18px;
    font-size:14px;
    color:rgba(0,0,0,0.6);
  }
  .footer-bottom nav{ display:flex; gap:14px; align-items:center; }
  .footer-bottom nav a{ color:rgba(0,0,0,0.6); text-decoration:none; font-size:13px; }
  .footer-bottom nav a:hover{ color:var(--f-accent); text-decoration:underline; }

  .sr-only{
    position:absolute !important;
    height:1px; width:1px;
    overflow:hidden; clip:rect(1px,1px,1px,1px);
    white-space:nowrap; border:0; padding:0; margin:-1px;
  }

  /* responsive: center content on small screens */
  @media (max-width: 900px){
    .footer-top{ grid-template-columns: 1fr; text-align:center; }
    .footer-links{ grid-template-columns: repeat(2, 1fr); }
    .footer-brand p{ max-width:100%; margin-left:auto; margin-right:auto; }
    .footer-bottom{ flex-direction:column; gap:10px; text-align:center; }
    .footer-bottom nav{ justify-content:center; }
    .news-form{ justify-content:center; }
    .socials{ justify-content:center; }
  }
  @media (max-width:520px){
    .footer-links{ grid-template-columns: 1fr; }
    .news-form{ flex-direction:column; align-items:center; }
    .news-form button{ width:100%; }
    .soc{ margin-inline:6px; }
  }
  .socials {
  display: flex;
  gap: 10px;
  align-items: center;
}

.socials .social-icon {
  width: 28px;
  height: 28px;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.socials .social-icon:hover {
  transform: scale(1.1);
  opacity: 0.8;
}

  </style>

  <script>
  // set current year after footer is rendered
  (function(){ var y = document.getElementById('year'); if(y) y.textContent = new Date().getFullYear(); })();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
