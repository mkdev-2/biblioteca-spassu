<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'livros';
    protected $primaryKey = 'CodLi';

    protected $fillable = [
        'Titulo', 'Editora', 'Edicao', 'AnoPublicacao', 'Valor'
    ];


    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'Livro_CodLi', 'Autor_CodAu');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'Livro_CodLi', 'Assunto_CodAs');
    }
}