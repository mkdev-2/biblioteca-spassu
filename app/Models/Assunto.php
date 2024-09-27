<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assunto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'assuntos';

    protected $primaryKey = 'CodAs';
    
    protected $fillable = [
        'Descricao'
    ];

    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assunto', 'Assunto_codAs', 'Livro_CodLi');
    }
}