<?php

namespace App\Models;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $table = 'invoices';

    
    protected $primarykey = 'id';
    protected $fillable = ['id',
                          'due_date',
                          'total',
                          'vat',
                          'subtotal',
                          'credit',
                          'incVat',
                          'service_id',
                          'name',
                          'companyName',
                          'tinNo',
                          'address',
                          'email',
                          'phone',
                          'status',
                          'status_value',
                          'invoice_number',
                          'invoice_date'];



    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    
}
