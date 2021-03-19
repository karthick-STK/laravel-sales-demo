<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;    
    
    protected $fillable = ['p_name','p_price','p_cat','qty','total'];

    protected $guarded = ['id'];    

}
