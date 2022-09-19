<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'descricao',
        'usuario',
        'fk_postagem_id',
    ];

    public function post(){
        return $this->BelongsTo(Post::class, 'fk_postagem_id');
    }
}
