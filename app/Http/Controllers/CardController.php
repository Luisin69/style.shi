<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class CardController extends Controller
{
    //
     public function index()
    {
        
        $cards = Auth::user()->cards;
        return view('mis-tarjetas', compact('cards'));
    }

    public function create()
    {
        return view('crear-tarjeta');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_on_card' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
        ]);

        Card::create([
            'user_id' => Auth::id(),
            'name_on_card' => $request->name_on_card,
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'cvv' => $request->cvv,
        ]);

        return redirect()->route('cards.index')->with('success', 'Card added!');
    }

    public function edit(Card $card)
    {
       // $this->authorize('update', $card); // optional but good practice
        return view('card-edit', compact('card'));
    }

    public function update(Request $request, Card $card)
    {
        $request->validate([
            'name_on_card' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
        ]);

        $card->update($request->all());

        return redirect()->route('cards.index')->with('success', 'Card updated!');
    }

    public function destroy(Card $card)
    {
        //$this->authorize('delete', $card); // optional
        $card->delete();

        return redirect()->route('cards.index')->with('success', 'Card removed!');
    }
}
