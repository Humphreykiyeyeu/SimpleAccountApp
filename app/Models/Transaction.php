<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = ['user_id', 'transaction_type', 'transaction_number',
        'journal_number', 'description', 'debit', 'credit', 'balance'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
