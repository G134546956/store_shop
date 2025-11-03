@extends('layout.admin')

@section('title', 'Tableau de bord - store shop Admin')

@section('content')
<!-- Header -->
<div class="container-fluid bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fw-bold">Tableau de bord administrateur</h1>
                <p class="lead mb-0">Gérez les produits, commands et clients de store shop</p>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="mb-0">{{ now()->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Content -->
<div class="container mb-5">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <!-- <i class="bi bi-people-fill text-primary fs-4"></i> -->
                        <i class="bi bi-people-fill text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Clients</h6>
                        {{-- {{ count($clients) }} --}}
                        <h3 class="mb-0">#</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-calendar2-check text-success fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Commands</h6>
                        {{-- {{ count($reservations) }} --}}
                        <h3 class="mb-0"></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-car-front-fill text-warning fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Produits</h6>
                        {{-- {{ count($services) }} --}}
                        <h3 class="mb-0">{{ count($produits) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="bi bi-envelope-fill text-info fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Messages</h6>
                        {{-- {{ count($contacts) }} --}}
                        <h3 class="mb-0">#</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Activité récente</h2>
        </div>
        
        <!-- Recent Reservations -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Dernières commands</h5>
                </div>
                {{-- <div class="card-body p-0">
                    @if(count($reservations) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Référence</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations->take(5) as $reservation)
                                    <tr>
                                        <td>{{ $reservation->reference }}</td>
                                        <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                                        <td>{{ $reservation->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if($reservation->status == 'pending')
                                                <span class="badge bg-warning text-dark">En attente</span>
                                            @elseif($reservation->status == 'confirmed')
                                                <span class="badge bg-success">Confirmée</span>
                                            @elseif($reservation->status == 'completed')
                                                <span class="badge bg-info">Terminée</span>
                                            @elseif($reservation->status == 'cancelled')
                                                <span class="badge bg-danger">Annulée</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $reservation->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center">
                            <p class="text-muted mb-0">Aucune réservation trouvée</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white text-end py-3">
                    <a href="{{ route('reserv.index') }}" class="btn btn-sm btn-primary">Voir toutes les réservations</a>
                </div> --}}
            </div>
        </div>
        
        <!-- Recent Messages -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Derniers messages</h5>
                </div>
                {{-- <div class="card-body p-0">
                    @if(count($contacts) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Sujet</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts->take(5) as $contact)
                                    <tr>
                                        <td>{{ $contact->nom }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->tel }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->message }}</td>
                                        <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center">
                            <p class="text-muted mb-0">Aucun message trouvé</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white text-end py-3">
                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-primary">Voir tous les messages</a>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Management Sections -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-4">Gestion</h2>
        </div>
        <!-- Clients Management -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>
                        <h4 class="mb-0">Clients</h4>
                    </div>
                    <p class="text-muted">Gérez les comptes clients, consultez leurs informations et historique.</p>
                    <div class="d-grid gap-2">
                      {{-- {{ route('clients.index') }} --}}
                        <a href="#" class="btn btn-outline-primary">Liste des clients</a>
                        {{-- {{ route('clients.create') }} --}}
                        <!-- <a href="" class="btn btn-outline-primary">Ajouter un client</a> -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reservations Management -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-calendar2-check text-success"></i>
                        </div>
                        <h4 class="mb-0">Commands</h4>
                    </div>
                    <p class="text-muted">Gérez les commands, modifiez leur statut et consultez les détails.</p>
                    <div class="d-grid gap-2">
                      {{-- {{ route('reserv.index') }} --}}
                        <a href="#" class="btn btn-outline-success">Toutes les commands</a>
                        <!-- <a href="#" class="btn btn-outline-success">Réservations en attente</a> -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- produits Management -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-car-front-fill text-secondary"></i>
                        </div>
                        <h4 class="mb-0">Produits</h4>
                    </div>
                    <p class="text-muted">Gérez les produit proposés, ajoutez, modifiez ou supprimez des produits.</p>
                    <div class="d-grid gap-2">
                      {{--  --}}
                        <a href="{{route('admin.produits.index')}}" class="btn btn-outline-secondary">Liste des produit</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- catégories Management -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-car-front-fill text-secondary"></i>
                        </div>
                        <h4 class="mb-0">Catégories</h4>
                    </div>
                    <p class="text-muted">Gérez les catégories proposés, ajoutez, modifiez ou supprimez des catégories.</p>
                    <div class="d-grid gap-2">
                        <a href="{{route('admin.categories.index')}}" class="btn btn-outline-secondary">Liste des categories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
