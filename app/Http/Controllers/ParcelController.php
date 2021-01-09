<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return response()->json(auth()->user()->parcels()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $parcel = auth()->user()->parcels()->create([
            'title' => $request->title,
            'details' => $request->details,
            'from' => $request->from,
            'to' => $request->to,
            'uid' => Parcel::uid(),
            'weight' => $request->weight,
            'height' => $request->height,
            'fee' => 10,
        ]);


        //init transaction
        $transaction = $parcel->transaction()->create([
            'amount' => $parcel->fee,
            'reference' => Transaction::reference()
        ]);

        $parcel->refresh();

        return response()->json($parcel);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function show(Parcel $parcel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function edit(Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request, Parcel $parcel)
    {
        $request->validate([
            'reference' => ['required', 'exists:transactions,reference']
        ])
        dd($parcel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parcel $parcel)
    {
        //
    }
}
