<?php

namespace App\Http\Controllers;
use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Ville::create($request->all());

        return redirect()->route('villes.index')->with('success', 'Ville ajoutée avec succès.');
    }

    public function edit($id)
    {
        $ville = Ville::findOrFail($id);
        return view('villes.edit', compact('ville'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $ville = Ville::findOrFail($id);
        $ville->update($request->all());

        return redirect()->route('ville.index')->with('success', 'Ville mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $ville = Ville::findOrFail($id);
        $ville->delete();
        return redirect()->route('ville.index')->with('success', 'Ville supprimée avec succès.');
    }
}
