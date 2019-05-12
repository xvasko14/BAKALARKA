<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Finance extends Model
{
    public $table = "Finance";
    protected $fillable = [ 'Nazov','Prijem', 'Vydavok','Datum'];


}



