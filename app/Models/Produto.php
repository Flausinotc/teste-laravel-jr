<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    // Definindo os campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade',
        'categoria',
        'imagem_url'
    ];
}
