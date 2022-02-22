<?php

namespace App\Models;
use App\Models\Service;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $primarykey = 'id';
    public $incrementing = true;
    protected $fillable = ['id',
                            'service_id',
                            'name',
                            'email',
                            'companyName',
                            'tinNo',
                            'address',
                            'phone'];
    
    public function services(){
        return $this->hasMany(Service::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
