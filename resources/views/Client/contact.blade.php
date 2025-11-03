@extends('layout.home')
@section('content')

{{-- <h2>page contact us</h2> --}}
<!-- Hero Section -->
<section class="bg-primary text-white text-center py-5">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Contactez-nous</h1>
        <p class="lead">Nous sommes à votre disposition pour répondre à toutes vos questions</p>
    </div>
</section>



<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Information -->
            {{-- <div class="col-lg-5 mb-4 mb-lg-0">
                <h2 class="mb-4">Nos coordonnées</h2>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="bg-primary rounded-circle p-3 me-3 text-white">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <h5>Adresse</h5>
                        <p class="mb-0">Gh1 N°20 Imm9 <br> Jardins Abrar, 4eme Etage <br> Mhamid, Marrakech 40054
                        <!-- <p class="mb-0">123 Avenue Mohammed V<br>Marrakech, 40000<br>Maroc</p> -->
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="bg-primary rounded-circle p-3 me-3 text-white">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div>
                        <h5>Téléphone</h5>
                        <p class="mb-0">+212 600 000 000<br>+212 600 000 001</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="bg-primary rounded-circle p-3 me-3 text-white">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div>
                        <h5>Email</h5>
                        <p class="mb-0">contact@moroccotravel.ma<br>reservations@moroccotravel.ma</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="bg-primary rounded-circle p-3 me-3 text-white">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div>
                        <h5>Horaires d'ouverture</h5>
                        <p class="mb-0">Lundi - Vendredi: 9h00 - 18h00<br>Samedi: 9h00 - 13h00<br>Dimanche: Fermé</p>
                    </div>
                </div>
                
                <h4 class="mt-5 mb-3">Suivez-nous</h4>
                <div class="d-flex">
                    <a href="#" class="text-decoration-none me-3">
                        <div class="bg-primary rounded-circle p-3 text-white">
                            <i class="bi bi-facebook"></i>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none me-3">
                        <div class="bg-primary rounded-circle p-3 text-white">
                            <i class="bi bi-instagram"></i>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none me-3">
                        <div class="bg-primary rounded-circle p-3 text-white">
                            <i class="bi bi-twitter"></i>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <div class="bg-primary rounded-circle p-3 text-white">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                    </a>
                </div>
            </div>
             --}}
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="mb-4">Envoyez-nous un message</h2>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nom complet *</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="subject" class="form-label">Sujet *</label>
                                    <select class="form-select @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                                        <option value="" selected disabled>Choisir un sujet</option>
                                        <option value="reservation" {{ old('subject') == 'reservation' ? 'selected' : '' }}>Réservation</option>
                                        <option value="information" {{ old('subject') == 'information' ? 'selected' : '' }}>Demande d'information</option>
                                        <option value="devis" {{ old('subject') == 'devis' ? 'selected' : '' }}>Demande de devis</option>
                                        <option value="reclamation" {{ old('subject') == 'reclamation' ? 'selected' : '' }}>Réclamation</option>
                                        <option value="autre" {{ old('subject') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-check mb-4">
                                <input class="form-check-input @error('privacy') is-invalid @enderror" type="checkbox" id="privacy" name="privacy" required>
                                <label class="form-check-label" for="privacy">
                                    J'accepte que mes données soient traitées conformément à la politique de confidentialité *
                                </label>
                                @error('privacy')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg">Envoyer le message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Questions fréquentes</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Combien de temps vais-je devoir attendre pour recevoir ma commande ?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                En ce qui concerne la commande, la réponse est immédiate. Nous travaillons de manière simple et rapide, sans dépasser 48 heures, et la commande est à votre disposition.
                                {{-- Pour les transferts aéroport et les excursions d'une journée, nous recommandons de réserver au moins 48 heures à l'avance. Pour les circuits de plusieurs jours, il est préférable de réserver au moins une semaine à l'avance, surtout pendant la haute saison touristique (mars-mai et septembre-novembre). --}}
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Comment puis-je payer mes commandes ?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Nous acceptons plusieurs modes de paiement : carte bancaire, virement bancaire, PayPal ou en espèces le jour du service. 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Quelle est votre politique d'annulation ?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pour les commandes, l'annulation est gratuite jusqu'à 24 heures avant la confirmation. Des frais peuvent s'appliquer pour les annulations tardives.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




























@endsection