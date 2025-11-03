<?php

namespace App\Http\Controllers;
use App\Models\produit;
use App\Models\categorie;

use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Produit::query();

        // Search
        if ($request->filled('q')) {
            $query->where('nom', 'like', '%' . $request->q . '%');
        }

        // Filter by category
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie); // or 'categorie_id' if you store IDs
        }

        // Filter by price
        if ($request->filled('min')) {
            $query->where('prix', '>=', $request->min);
        }
        if ($request->filled('max')) {
            $query->where('prix', '<=', $request->max);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('prix', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('prix', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        // Paginate results
        $produits = $query->paginate(12)->withQueryString(); // 12 per page

        return view('Client.boutique', compact('produits'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
