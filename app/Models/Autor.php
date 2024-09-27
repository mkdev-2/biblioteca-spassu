<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'autores'; 
    protected $primaryKey = 'CodAu';

    protected $fillable = [
        'Nome'
    ];

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_autor', 'Autor_CodAu', 'Livro_CodLi');
    }
}
