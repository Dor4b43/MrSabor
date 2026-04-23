<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255',
        ]);

        Address::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'reference' => $request->reference,
        ]);

        return back()->with('success', 'Dirección agregada correctamente.');
    }

    public function destroy(Address $address)
    {
        abort_if($address->user_id !== Auth::id(), 403);
        $address->delete();
        return back()->with('success', 'Dirección eliminada.');
    }
}
