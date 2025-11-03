@extends('layout.home')
@section('title', 'À propos de nous')

@section('content')
<div class="container mt-4 py-5">
    <h1 class="text-center  mb-4">À propos de Choco Fruits</h1>
    <div class="row align-items-center">
        <div class="col-md-6">
            <p class="lead">
                Chez <strong>Choco Fruits</strong>, nous croyons en la magie des fruits et du chocolat. Notre mission est de vous offrir une expérience gustative unique en combinant la fraîcheur des fruits soigneusement sélectionnés avec la richesse du chocolat artisanal. Chaque produit est conçu pour ravir vos papilles tout en célébrant la nature et l'art culinaire.
            </p>
            <p>
                Nos fruits sont séchés avec soin pour préserver leur saveur naturelle et leur texture délicieuse. Que ce soit des bananes, des figues, des fraises, des pêches, des kiwis ou des mangues, chaque morceau est une explosion de saveurs. Nous les associons à des chocolats de qualité supérieure pour créer des mélanges irrésistibles qui allient douceur et gourmandise.
            </p>
            <p>
                Nous nous engageons à utiliser des ingrédients naturels et à respecter des normes élevées de qualité pour garantir votre satisfaction. Que vous cherchiez un cadeau parfait ou une collation saine et délicieuse, <strong>Choco Fruits</strong> est là pour vous.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/fruits.jpg') }}" alt="Fruits Choco Fruits" class="img-fluid rounded shadow">
        </div>
    </div>
    <div class="text-center mt-5">
        <h2>Pourquoi nous choisir ?</h2>
        <p class="mt-3">
            Nous sommes passionnés par la qualité, l'innovation et la satisfaction de nos clients. Découvrez nos produits et laissez-vous séduire par la fusion parfaite entre fruits et chocolat.
        </p>
        <a href="{{ route('boutique') }}" class="btn btn-dark mt-3">Explorer nos produits</a>
    </div>
</div>
@endsection