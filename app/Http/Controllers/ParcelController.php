<?php

namespace App\Http\Controllers;

use App\Models\DeliverParcel;
use App\Models\Parcel;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function public()
    {
        return response()->json(Parcel::whereStatus('confirmed')->whereTakenAt(null)->paginate(20));
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
    public function take(Request $request, Parcel $parcel)
    {
        $r = DeliverParcel::whereParcelId($parcel->id)->first();

        if ($r) {
            throw ValidationException::withMessages([
                'parcel' => [trans('already taken')],
            ]);
        }



        $parcel = auth()->user()->parcels()->create([
            'parcel_id' => $parcel->id
        ]);

        $parcel = Parcel::find($parcel->parcel_id);

        $parcel->taken_at = now();
        $parcel->save();

        return response()->json($parcel->refresh());
    }

    public function pickUp(Request $request, Parcel $parcel)
    {
        $r = DeliverParcel::whereParcelId($parcel->id)->first();

        if ($r->delivered_at) {
            throw ValidationException::withMessages([
                'parcel' => [trans('action unalloyed')],
            ]);
        }

        $r->picked_at = now();

        $r->save();

        return response()->json($r->refresh());
    }

    public function markAsDelivered(Request $request, Parcel $parcel)
    {
        $r = DeliverParcel::whereParcelId($parcel->id)->first();

        if ($r->delivered_at) {
            throw ValidationException::withMessages([
                'parcel' => [trans('action unalloyed')],
            ]);
        }

        $r->delivered_at = now();

        $r->save();

        $user = auth()->user();

        $user->credit += ($r->parcel->fee / 100 * 30);

        $user->save();

        return response()->json($r->refresh());
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
            'reference' => ['required', 'exists:transactions,reference', function ($attribute, $value, $fail) use ($parcel) {
                if ($parcel->status == 'confirmed') {
                    $fail('Already confirmed');
                }
                if ($parcel->transaction->status != 'success') {
                    $fail('Please make payment first');
                }
            },]
        ]);

        $parcel->status = 'confirmed';
        $parcel->save();

        return response()->json($parcel->refresh());
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
