<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $table = 'marcas';
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function Eletro()
    {
        return $this->hasMany(Eletro::class);
    }
}
