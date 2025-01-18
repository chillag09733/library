<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    public function index()
    {
        return Lending::all();
    }

    public function show($user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)
            ->where('copy_id', $copy_id)
            ->where('start', $start)
            ->get();
        return $lending[0];
    }

    public function store(Request $request)
    {
        $record = new Lending();
        $record->fill($request->all());
        $record->save();
    }

    public function update(Request $request, $user_id, $copy_id, $start)
    {
        $record = $this->show($user_id, $copy_id, $start);
        $record->fill($request->all());
        $record->save();
    }

    public function destroy($user_id, $copy_id, $start)
    {
        $this->show($user_id, $copy_id, $start)->delete();
    }

    //összes kölcsönzési adatok a példányok adataival
    public function lendingsWithCopies()
    {
        $records = Lending::with('toCopies')->get();
        return $records;
    }

    //bejelentkezett felhasználó összes kölcsönzési adata
    public function userLendings()
    {
        $user = Auth::user();
        $records = Lending::with('toCopies')
            //csak a bejelentkezett felhasz adatait mutassa
            ->where('user_id', $user->id)
            ->get();
        return $records;
    }

    // public function lendingWithUsers(){
    //     //összekapcsoljuk: hol írtunk milyen függvényt
    //     $records = Lending::with('lendingToUsers')
    //     //egyenlőségjel default, nem kell feltétlen beleírni
    //     ->where('start', '=', '2023-10-24')
    //     ->get();
    //     return $records;
    // }

    //paraméterrel
    public function lendingWithUsers($date){
        //összekapcsoljuk: hol írtunk milyen függvényt
        $records = Lending::with('lendingToUsers')
        //egyenlőségjel default, nem kell feltétlen beleírni
        ->where('start', '=', $date)
        ->get();
        return $records;
    }
}
