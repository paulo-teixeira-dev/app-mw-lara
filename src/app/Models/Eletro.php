<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eletro extends Model
{
    use HasFactory;
    protected $table = 'eletrodomesticos';
    public $timestamps = false;
    protected $fillable = ['nome','descricao','tensao','marca_id'];

    public function Marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
