@extends('layout.home')
@section('title', 'Boutique')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Boutique — Nos produits</h1>
    <p class="text-center text-muted mb-4">Produits frais séchés, enrobés de chocolat artisanal. Commande rapide et paiement sécurisé.</p>

    <!-- Filters / Search / Sorting -->
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4 gap-3">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#filterCategories" aria-expanded="false">Catégories</button>
            {{-- <button class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#filterPrice" aria-expanded="false">Prix</button> --}}
            <div class="collapse ms-2" id="filterCategories">
                <div class="card card-body p-2 shadow-sm">
                    <form method="GET" class="d-flex gap-2 align-items-center">
                        <select name="category" class="form-select form-select-sm">
                            <option value="">Toutes</option>
                            <option value="fruits">Fruits</option>
                            <option value="Chocolat">Chocolat</option>
                            <option value="cadeau">Cadeau</option>
                        </select>
                        <button class="btn btn-dark btn-sm">Filtrer</button>
                    </form>
                </div>
            </div>
            <div class="collapse ms-2" id="filterPrice">
                <div class="card card-body p-2 shadow-sm">
                    <form method="GET" class="d-flex gap-2 align-items-center">
                        <input type="number" name="min" class="form-control form-control-sm" placeholder="Min">
                        <input type="number" name="max" class="form-control form-control-sm" placeholder="Max">
                        <button class="btn btn-dark btn-sm">Appliquer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <form class="d-flex" method="GET" action="{{ route('boutique') }}">
                <input name="q" class="form-control form-control-sm" placeholder="Rechercher..." value="{{ request('q') }}">
                <button class="btn btn-dark btn-sm ms-2">Rechercher</button>
            </form>

            <form method="GET" class="ms-2">
                <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Tri par défaut</option>
                    <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Prix croissant</option>
                    <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                    <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Nouveautés</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="row g-4">
        @if($produits->count())
            @foreach($produits as $produit)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm product-card"> 
                    <div class="position-relative overflow-hidden" style="min-height: 240px;">
                        <img src="{{ asset('images/produits/' . ($produit->image ?? 'placeholder.png')) }}" 
                             alt="{{ $produit->nom }}" 
                             class="w-100 h-100 object-cover product-img">
                        <div class="product-overlay d-flex flex-column justify-content-end p-3">
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="bg-white/80 px-2 py-1 rounded">
                                    <strong class="small">{{ $produit->nom }}</strong><br>
                                    <span class="text-muted small">{{ number_format($produit->prix, 2) }} MAD</span>
                                </div>
                                <div class="d-flex gap-2">
                                    {{-- {{ route('produit.show', $produit->id) }} --}}
                                    <a href="" class="btn btn-sm btn-light" title="Voir le produit">Voir</a>
                                    <button 
                                        class="btn btn-sm btn-dark" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#quickViewModal"
                                        data-id="{{ $produit->id }}"
                                        data-name="{{ $produit->nom }}"
                                        data-price="{{ number_format($produit->prix, 2) }}"
                                        data-image="{{ asset('images/' . ($produit->image ?? 'placeholder.png')) }}"
                                        data-desc="{{ Str::limit($produit->description ?? 'Produit délicieux', 200) }}">
                                        Commander
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-1">{{ $produit->nom }}</h6>
                        <p class="card-text text-muted mb-2">{{ number_format($produit->prix, 2) }} MAD</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Stock : {{ $produit->stock ?? '—' }}</small>
                            {{-- {{ route('produit.show', $produit->id) }} --}}
                            <a href="#" class="small text-decoration-none">Détails →</a>
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

<!-- Quick View / Commander modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body p-4">
        <div class="row g-3">
          <div class="col-md-6 text-center">
            <img id="qv-image" src="" alt="" class="img-fluid rounded shadow-sm">
          </div>
          <div class="col-md-6">
            <h4 id="qv-name"></h4>
            <p id="qv-desc" class="text-muted small"></p>
            <p class="h5 text-dark" id="qv-price"></p>
{{-- {{ route('commande.create') }} --}}
            <form method="POST" action="" class="mt-3">
                @csrf
                <input type="hidden" name="product_id" id="qv-product-id" value="">
                <div class="mb-2">
                    <label class="form-label small">Quantité</label>
                    <input type="number" name="quantity" value="1" min="1" class="form-control w-50">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark">Passer la commande</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Styles specific to the page -->
<style>
.product-img { object-fit: cover; height: 100%; transition: transform .35s ease; }
.product-card:hover .product-img { transform: scale(1.05); }
.product-overlay {
    position: absolute;
    left: 0; right: 0; bottom: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(0,0,0,0.45) 100%);
    color: #fff;
    transition: transform .3s ease;
}
@media (min-width: 992px) {
    .product-overlay { padding: 1rem; }
}
.card-body { background: #fff; }
</style>

<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fill quick view modal from data attributes
    var quickModal = document.getElementById('quickViewModal');
    quickModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        if (!button) return;
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var price = button.getAttribute('data-price');
        var image = button.getAttribute('data-image');
        var desc = button.getAttribute('data-desc');

        document.getElementById('qv-product-id').value = id;
        document.getElementById('qv-name').textContent = name;
        document.getElementById('qv-price').textContent = price + ' MAD';
        document.getElementById('qv-image').src = image;
        document.getElementById('qv-image').alt = name;
        document.getElementById('qv-desc').textContent = desc;
    });
});
</script>
@endsection