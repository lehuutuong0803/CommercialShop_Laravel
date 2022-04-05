<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailed_invoice extends Base
{
    use HasFactory;

    protected $table = 'detailed_invoices';
    protected $primaryKey = 'id';
    protected $guarded =[];

    public function product(){
        return $this -> belongsTo(Product::class,'product_dt','id');
    }
    public function invoice(){
        return $this -> belongsTo(Invoice::class,'invoice_dt','id');
    }

}
