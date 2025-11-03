@extends('layout.home')

@section('title', 'Suivi de commande')

@section('content')
<div class="order-tracking container py-5">

    <!-- Page Title -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase" style="color: #c59d5f;">Suivi de votre commande</h2>
        <p class="text-muted mt-3" style="max-width: 700px; margin: 0 auto;">
            Pour suivre votre commande, veuillez saisir votre <strong>ID de commande</strong> et votre 
            <strong>email de facturation</strong> ci-dessous, puis cliquez sur <em>« Suivre »</em>.
            Vous trouverez ces informations dans votre reçu ou dans l’email de confirmation.
        </p>
    </div>

    <!-- Tracking Form -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="order_id" class="form-label fw-semibold">ID de commande :</label>
                        <input type="text" id="order_id" name="order_id" class="form-control form-control-lg rounded-pill" placeholder="Ex: CMD-2025-001" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email de facturation :</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="exemple@email.com" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark rounded-pill py-2 fw-semibold">
                            <i class="bi bi-search me-2"></i> Suivre ma commande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional extra info -->
    <div class="text-center mt-5">
        <p class="text-muted">
            Besoin d'aide ? <a href="{{ route('contact') }}" class="text-decoration-none" style="color: #c59d5f;">Contactez-nous</a>.
        </p>
    </div>
</div>

<style>
    /* Page-specific styles */
    .order-tracking {
        background: #f9f9f9;
        border-radius: 16px;
    }

    .card {
        background-color: #fff;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .form-control:focus {
        border-color: #c59d5f;
        box-shadow: 0 0 0 0.2rem rgba(197, 157, 95, 0.25);
    }

    button.btn-dark:hover {
        background-color: #c59d5f;
        border-color: #c59d5f;
        color: #fff;
    }
</style>
@endsection
