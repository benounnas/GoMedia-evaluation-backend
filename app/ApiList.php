<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiList extends Model
{
    //

    protected $guarded = [];
    public function transaction_logs()
    {
        return $this->hasMany("App\TransactionLog");
    }
}
