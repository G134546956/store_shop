@extends('layout.home')
@section('title', 'Détail produit')

@section('content')
<div class="container py-5">
  <div class="row g-4">
    <!-- Image -->
    <div class="col-12 col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="ratio ratio-1x1 bg-light">
          <img id="mainProductImage" src="{{ asset('images/produits/' . ($produit->image ?? 'placeholder.png')) }}" 
               alt="{{ $produit->nom }}" 
               class="w-100 h-100 object-fit-cover">
        </div>
      </div>

      <!-- Galerie (si plusieurs images disponibles) -->
      @if(isset($produit->gallery) && is_array($produit->gallery) && count($produit->gallery))
      <div class="mt-3 d-flex gap-2">
        @foreach($produit->gallery as $g)
          <button class="btn btn-outline-light p-0 border-0 thumb" type="button" data-src="{{ asset('images/produits/' . $g) }}">
            <img src="{{ asset('images/produits/' . $g) }}" style="width:72px;height:72px;object-fit:cover;border-radius:.35rem" alt="">
          </button>
        @endforeach
      </div>
      @endif
    </div>

    <!-- Details & commande -->
    <div class="col-12 col-md-6">
      <h2 class="mb-1">{{ $produit->nom }}</h2>
      <p class="text-muted small mb-2">{{ $produit->reference ?? '' }}</p>

      <div class="mb-3">
        @if(isset($produit->promo_price) && $produit->promo_price < $produit->prix)
          <div class="small text-muted text-decoration-line-through">{{ number_format($produit->prix,2) }} MAD</div>
          <div class="h4 text-dark">{{ number_format($produit->promo_price,2) }} MAD</div>
        @else
          <div class="h4 text-dark">{{ number_format($produit->prix,2) }} MAD</div>
        @endif
      </div>

      <p class="text-muted mb-3">{{ $produit->description ?? 'Aucune description fournie.' }}</p>

      <div class="mb-3 small text-muted">
        Stock : <strong>{{ $produit->stock ?? '—' }}</strong>
      </div>

      <!-- Formulaire de commande directe -->
      {{--  --}}
      <form method="POST" action="{{ route('commande.create') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $produit->id }}">

        <div class="row g-2 align-items-center mb-3">
          <div class="col-auto">
            <label class="form-label small mb-1">Quantité</label>
            <input type="number" name="quantity" id="quantity" class="form-control form-control-sm" value="1" min="1" max="{{ $produit->stock ?? 999 }}">
            @error('quantity') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>

          <div class="col">
            <label class="form-label small mb-1">Nom</label>
            <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" class="form-control form-control-sm" required>
            @error('customer_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-2 mb-3">
          <div class="col-md-6">
            <label class="form-label small mb-1">Email</label>
            <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" class="form-control form-control-sm" required>
            @error('customer_email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label small mb-1">Téléphone</label>
            <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" class="form-control form-control-sm">
            @error('customer_phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label small mb-1">Adresse de livraison</label>
          <input type="text" name="address" value="{{ old('address') }}" class="form-control form-control-sm" placeholder="Rue, ville, code postal" required>
          @error('address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-dark">Commander maintenant</button>
          <a href="{{ route('boutique') }}" class="btn btn-outline-secondary">Retour à la boutique</a>
        </div>

        <div class="mt-3 small text-muted">
          Paiement sécurisé • Livraison soignée • Retours sous 14 jours
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Thumbnail preview script (no cart related code) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const main = document.getElementById('mainProductImage');
  document.querySelectorAll('.thumb').forEach(btn => {
    btn.addEventListener('click', function () {
      const src = this.dataset.src;
      if (main && src) main.src = src;
    });
  });
});
</script>
@endsection
