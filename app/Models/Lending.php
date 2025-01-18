<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    /** @use HasFactory<\Database\Factories\LendingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'copy_id',
        'start'
    ];

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('copy_id', '=', $this->getAttribute('copy_id'))
            ->where('start', '=', $this->getAttribute('start'));
        return $query;
    }

    public function toCopies(){
        //model neve, honnan, hová
        return $this->belongsTo(Copy::class, "copy_id", "copy_id");
    }

    public function lendingToUsers(){
        //model neve, honnan, hová
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
