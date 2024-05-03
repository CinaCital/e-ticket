<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penerbangan;
use App\Models\User;
use App\Models\Checkout;
use App\Models\Transaksi;


class Checkout extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function listTransaksi()
    {
        return $this->belongsTo(Penerbangan::class,'penerbangan_id','id');
    }

    public function listUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function listReal()
    {
        return $this->belongsTo(Transaksi::class,'transaksi_id','id');
    }  
}

