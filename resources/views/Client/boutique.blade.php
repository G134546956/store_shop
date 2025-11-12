@extends('layout.home')
@section('title', 'Boutique')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Boutique — Nos produits</h1>
            <p class="text-muted small mb-0">Fruits séchés & chocolat artisanal — frais, gourmands et prêts à offrir.</p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <div class="btn-group btn-group-sm" role="group" aria-label="Affichage">
                <button id="gridViewBtn" class="btn btn-outline-secondary active" title="Affichage grille">
                    <i class="bi bi-grid-3x3-gap"></i>
                </button>
                <button id="listViewBtn" class="btn btn-outline-secondary" title="Affichage liste">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Filters / Search / Sorting -->
    <div class="row mb-4 gy-2 gx-3 align-items-center">
        <div class="col-12 col-md-6">
            <form class="d-flex" method="GET" action="{{ route('boutique') }}">
                <input name="q" class="form-control form-control-sm me-2" placeholder="Rechercher produits, ex: kiwi, mix..." value="{{ request('q') }}">
                <button class="btn btn-dark btn-sm">Rechercher</button>
            </form>
        </div>

        <div class="col-6 col-md-3">
            <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">Toutes les catégories</option>
                <option value="fruits" {{ request('category')=='fruits' ? 'selected' : '' }}>Fruits</option>
                <option value="chocolat" {{ request('category')=='chocolat' ? 'selected' : '' }}>Chocolat</option>
                <option value="cadeau" {{ request('category')=='cadeau' ? 'selected' : '' }}>Cadeaux</option>
            </select>
        </div>

        <div class="col-6 col-md-3">
            <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">Tri par défaut</option>
                <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Prix croissant</option>
                <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Nouveautés</option>
            </select>
        </div>
    </div>

    <!-- Product Grid / List -->
    <div id="productsWrapper" class="row g-4" data-view="grid">
        @if($produits->count())
            @foreach($produits as $produit)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-item">
                <div class="card h-100 border-0 shadow-sm product-card position-relative overflow-hidden">
                    {{-- Badges --}}
                    @if(isset($produit->is_new) && $produit->is_new)
                      <span class="badge bg-success position-absolute m-2">Nouveau</span>
                    @endif
                    @if(isset($produit->promo) && $produit->promo)
                      <span class="badge bg-danger position-absolute m-2" style="right:0;">Promo</span>
                    @endif

                    <a href="{{ route('produit.show', $produit->id) }}" class="d-block">
                        <div class="ratio ratio-4x3 bg-light">
                            <img loading="lazy" src="{{ asset('images/produits/' . ($produit->image ?? 'placeholder.png')) }}" alt="{{ $produit->nom }}" class="object-fit-cover w-100 h-100 product-img">
                        </div>
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-1 text-truncate">{{ $produit->nom }}</h6>
                        <p class="text-muted small mb-2 flex-grow-1">{{ Str::limit($produit->description ?? 'Délicieux et naturel', 80) }}</p>

                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                @if(isset($produit->promo_price) && $produit->promo_price < $produit->prix)
                                    <div class="small text-muted text-decoration-line-through">{{ number_format($produit->prix,2) }} MAD</div>
                                    <div class="fw-bold text-dark">{{ number_format($produit->promo_price,2) }} MAD</div>
                                @else
                                    <div class="fw-bold">{{ number_format($produit->prix,2) }} MAD</div>
                                @endif
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('produit.show', $produit->id) }}" class="btn btn-outline-dark btn-sm" title="Détails">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <button
                                    class="btn btn-dark btn-sm add-to-cart"
                                    data-id="{{ $produit->id }}"
                                    data-name="{{ $produit->nom }}"
                                    data-price="{{ $produit->prix }}"
                                    title="Ajouter au panier">
                                    <i class="bi bi-bag-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">Aucun produit trouvé.</div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $produits->withQueryString()->links() }}
    </div>
</div>

<!-- Minimal styles / animations -->
<style>
.product-card { transition: transform .25s ease, box-shadow .25s ease; border-radius: .6rem; overflow: hidden; }
.product-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(15,15,15,0.08); }

.product-img { transition: transform .45s ease; }
.product-card:hover .product-img { transform: scale(1.06); }

.text-truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

[data-view="list"] .product-item { flex-direction: row; display: flex; }
[data-view="list"] .product-item .card { flex-direction: row; }
[data-view="list"] .product-item .ratio { width: 160px; min-width:160px; height: auto; }
[data-view="list"] .product-item .card-body { max-width: calc(100% - 170px); }

@media (max-width: 768px) {
  [data-view="list"] .product-item { display:block; }
  [data-view="list"] .ratio { width:100%; }
}
</style>

<!-- Scripts: view toggle + simple add-to-cart visual (AJAX endpoint optional) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // View toggle
    const productsWrapper = document.getElementById('productsWrapper');
    const gridBtn = document.getElementById('gridViewBtn');
    const listBtn = document.getElementById('listViewBtn');
    const setView = (v) => {
        productsWrapper.setAttribute('data-view', v);
        gridBtn.classList.toggle('active', v === 'grid');
        listBtn.classList.toggle('active', v === 'list');
        try { localStorage.setItem('shop_view', v); } catch(e){}
    };
    const saved = localStorage.getItem('shop_view') || 'grid';
    setView(saved);

    gridBtn.addEventListener('click', () => setView('grid'));
    listBtn.addEventListener('click', () => setView('list'));

    // Add to cart (visual UX). Replace fetch URL with your actual cart route if available.
    document.querySelectorAll('.add-to-cart').forEach(btn=>{
        btn.addEventListener('click', async (e)=>{
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            const price = btn.dataset.price;
            // simple animation / feedback
            btn.classList.add('btn-success');
            btn.innerHTML = '<i class="bi bi-check-lg"></i>';
            setTimeout(()=>{
                btn.classList.remove('btn-success');
                btn.classList.add('btn-dark');
                btn.innerHTML = '<i class="bi bi-bag-plus"></i>';
            }, 900);

            // Optional: send to server
            try {
                await fetch('/cart/add', {
                    method: 'POST',
                    headers: {'Content-Type':'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''},
                    body: JSON.stringify({ product_id: id, quantity: 1 })
                });
            } catch (err) {
                // silent fail — server integration optional
            }
        });
    });
});
</script>
@endsection