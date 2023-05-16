<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Address;
use App\Http\Requests\StoreAddressOptionsRequest;

class AddressOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Address/Add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressOptionsRequest $request)
    {
        try {
            $address = new Address();

            $address->user_id = auth()->user()->id;
            $address->address1 = $request->get('address1');
            $address->address2 = $request->get('address2');
            $address->city = $request->get('city');
            $address->postalcode = $request->get('postalcode');
            $address->country = $request->get('country');

            $address->save();

            return redirect()->route('address.index');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Delete address
            $address = Address::find($id);
            $address->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
