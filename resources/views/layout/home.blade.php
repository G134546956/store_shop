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

      <!-- Search (desktop) -->
      <div class="d-none d-lg-flex align-items-center flex-grow-1">
        <form action="{{ route('boutique') }}" method="GET" class="d-flex nav-search w-100">
          <input name="q" value="{{ request('q') }}" class="form-control form-control-sm me-2" placeholder="Rechercher des produits, ex: kiwi, mix, cadeau..." aria-label="Recherche">
          <button class="btn btn-dark btn-sm" type="submit">Rechercher</button>
        </form>
      </div>

      <!-- Desktop icons -->
      <div class="d-flex align-items-center ms-auto gap-3">
        <a href="{{ route('boutique') }}" class="d-none d-lg-inline text-decoration-none text-muted small me-2" title="Boutique">
          <i class="bi bi-shop me-2" style="font-size:1rem; color:var(--muted)"></i>
          Boutique
        </a>

        
        {{-- Suivi commande (amélioré : lien + menu rapide pour rechercher par référence/email) --}}
        <div class="d-flex align-items-center gap-2">
          <!-- Link texte (desktop) -->
          <a href="{{ route('lignecommande') }}" 
             class="d-none d-lg-inline text-decoration-none text-muted small me-2"
             title="Suivre une commande">
            <i class="bi bi-clock-history me-1" style="color:var(--muted)"></i>
            Suivre une commande
          </a>
          {{-- login --}}
          <div class="position-relative">
            <a href="{{ route('login') }}"class="text-decoration-none text-muted" title="login" aria-label="login">
          {{-- <button class="icon-btn" title="Compte" data-bs-toggle="modal" data-bs-target="#loginModal"> --}}
            {{-- <i class="bi bi-person"></i></a> --}}
            <i class="bi bi-person" style="font-size:1.2rem; color:var(--muted)"></i>
            Login
          {{-- </button> --}}
        </div>
        <div class="position-relative">
          {{-- {{ route('cart') ?? '#' }} --}}
          <a href="#" class="text-decoration-none text-dark position-relative">
            <i class="bi bi-bag" style="font-size:1.25rem"></i>
            <span class="cart-badge">{{ session('cart_count', 0) }}</span>
          </a>
        </div>
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
        <li class="nav-item"><a class="nav-link" href="#">Suivi de commande</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
      </ul>

      <div class="mt-4">
        <button class="btn btn-dark w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginModal">Se connecter</button>
        {{-- {{ route('register') ?? '#' }} --}}
        <a href="#" class="btn btn-outline-dark w-100">S'inscrire</a>
      </div>
    </div>
  </div>

  <!-- Login modal (simple) -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        {{-- {{ route('login.attempt') }} --}}
        <form action="#" method="POST">
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
