<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Invoice;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $primarykey = 'id';

    protected $fillable = ['id',
                            'name',
                            'description',
                            'price'];


    public function invoices(){
        return $this->belongsToMany(Invoice::class);
    }
}