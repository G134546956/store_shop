@extends('layout.home')
@section('title', 'Accueil')
@section('content')

<style>
/* Hero */
.hero {
  background: linear-gradient(180deg, rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url('{{ asset("images/hero.jpg") }}') center/cover no-repeat;
  min-height: 60vh;
  display:flex;
  align-items:center;
  color:#fff;
  border-radius: .5rem;
  margin-top: 1rem;
  box-shadow: 0 8px 30px rgba(0,0,0,0.08);
}
.hero .lead { color: #f7f1ea; }
.btn-cta { background: var(--brand); border-color: var(--brand); color: #fff; }

/* Feature cards */
.feature-icon {
  width:56px;height:56px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  background: #fff; color:var(--brand); box-shadow: 0 6px 18px rgba(16,16,16,0.06);
}

/* Products */
.product-img { height:220px; object-fit:cover; border-radius:.5rem; transition: transform .35s ease; }
.card:hover .product-img{ transform: scale(1.04); }

/* Newsletter */
.newsletter { background: linear-gradient(180deg,#fff,#fff); padding:1.5rem; border-radius:.75rem; box-shadow: 0 8px 24px rgba(0,0,0,0.04); }

/* Small responsiveness */
@media (max-width:767px){
  .hero { min-height: 44vh; padding: 2rem 1rem; }
  .product-img { height:160px; }
}
</style>

<header class="hero p-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 text-lg-start text-center">
        <h1 class="display-5 fw-bold">Choco Fruits — L'alliance parfaite du fruit et du chocolat</h1>
        <p class="lead mt-3">Fruits soigneusement sélectionnés, séchés et enrobés de chocolat artisanal — plaisir sain et raffiné pour vous ou à offrir.</p>
        <div class="mt-4 d-flex justify-content-center justify-content-lg-start gap-2">
          <a href="{{ route('boutique') }}" class="btn btn-cta btn-lg">Voir la boutique</a>
          <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">En savoir plus</a>
        </div>
      </div>

      <div class="col-lg-5 offset-lg-1 d-none d-lg-block text-end">
        <img src="{{ asset('images/fruits.jpg') }}" alt="Fruits Choco Fruits" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</header>

<main class="my-5">
  <div class="container">

    <!-- Trust / Features -->
    <section class="row text-center g-4 mb-5">
      <div class="col-12 col-md-4">
        <div class="p-3">
          <div class="feature-icon mx-auto mb-3"><i class="bi bi-award fs-4"></i></div>
          <h5 class="mb-2">Qualité supérieure</h5>
          <p class="text-muted small">Sélection rigoureuse des fruits et chocolat de première qualité, fabrication artisanale.</p>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="p-3">
          <div class="feature-icon mx-auto mb-3"><i class="bi bi-heart-pulse fs-4"></i></div>
          <h5 class="mb-2">Sain & naturel</h5>
          <p class="text-muted small">Ingrédients naturels, sans additifs inutiles — une collation gourmande et responsable.</p>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="p-3">
          <div class="feature-icon mx-auto mb-3"><i class="bi bi-truck fs-4"></i></div>
          <h5 class="mb-2">Livraison soignée</h5>
          <p class="text-muted small">Emballages protecteurs et livraison rapide pour garantir fraîcheur et présentation.</p>
        </div>
      </div>
    </section>

    <!-- Featured products -->
    <section class="mb-5">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="h5 mb-0">Produits en vedette</h3>
        <a href="{{ route('boutique') }}" class="small text-decoration-none">Voir tout →</a>
      </div>

      <div class="row g-4">
        @if(isset($produits) && $produits->count())
          @foreach($produits->take(4) as $produit)
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card border-0 h-100 shadow-sm">
              <img src="{{ asset('images/' . ($produit->image ?? 'placeholder.png')) }}" alt="{{ $produit->nom }}" class="product-img w-100">
              <div class="card-body">
                <h6 class="card-title mb-1">{{ $produit->nom }}</h6>
                <p class="text-muted small mb-2">{{ Str::limit($produit->description ?? '', 60) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <strong>{{ number_format($produit->prix, 2) }} MAD</strong>
                  <a href="{{ route('produit.show', $produit->id) }}" class="btn btn-sm btn-outline-dark">Détails</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        @else
          <!-- Static placeholders if no products passed -->
          @for($i=0;$i<4;$i++)
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card border-0 h-100 shadow-sm">
              <img src="{{ asset('images/placeholder.png') }}" alt="Produit" class="product-img w-100">
              <div class="card-body">
                <h6 class="card-title mb-1">Produit</h6>
                <p class="text-muted small mb-2">Description courte du produit.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <strong>-- MAD</strong>
                  <a href="{{ route('boutique') }}" class="btn btn-sm btn-outline-dark">Voir</a>
                </div>
              </div>
            </div>
          </div>
          @endfor
        @endif
      </div>
    </section>

    <!-- Why choose us + Newsletter -->
    <section class="row align-items-center g-4">
      <div class="col-md-7">
        <h4>Pourquoi choisir Choco Fruits ?</h4>
        <p class="text-muted">Nous allions le savoir-faire artisanal et des ingrédients naturels pour proposer des produits élégants et sains. Chaque lot est préparé avec attention, conditionné pour préserver la qualité, et expédié avec soin. Idéal pour un cadeau ou une pause gourmande.</p>
        <ul class="list-unstyled text-muted small">
          <li>• Ingrédients traçables et sélectionnés</li>
          <li>• Processus artisanal et contrôle qualité</li>
          <li>• Emballage cadeau disponible</li>
        </ul>
        <a href="{{ route('about') }}" class="btn btn-outline-dark mt-2">En savoir plus</a>
      </div>

      <div class="col-md-5">
        <div class="newsletter">
          <h6 class="mb-2">Restez informé</h6>
          <p class="text-muted small mb-3">Inscrivez-vous à notre newsletter pour recevoir les offres exclusives et nouveautés.</p>
          {{-- {{ route('newsletter.subscribe') ?? '#' }} --}}
          <form method="POST" action="#">
            @csrf
            <div class="input-group">
              <input type="email" name="email" class="form-control form-control-sm" placeholder="Votre email" required>
              <button class="btn btn-dark btn-sm" type="submit">S'abonner</button>
            </div>
          </form>
        </div>
      </div>
    </section>

  </div>
</main>

@endsection