<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;
    protected $fillable = ['descricao','data_limite','status'];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

}
