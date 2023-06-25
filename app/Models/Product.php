<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property varchar $name name
@property decimal $price price
   
 */
class Product extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'products';

    /**
    * Mass assignable columns
    */
    protected $fillable=['price',
'name',
'price'];

    /**
    * Date time columns.
    */
    protected $dates=[];




}