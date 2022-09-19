<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

 /*
    Mostra todos os comentários do Post especificado pelo ID
*/
class CommentController extends Controller
{
    public function index($id)
    {
        if(Post::where('id', $id)->exists()){
            $comments = Post::find($id)->comment;
            return $comments;
        }else{
            return response()->json([
                "message" => "Postagem não existe."
            ], 404);
        }
    }
    /*
    Funcão p/ fazer o comentário em uma postagem
    */
    public function store(Request $request, $id)
    {
        $comment = new Comment;
        $comment->usuario = $request->usuario;
        $comment->descricao = $request->descricao;
        $comment->fk_postagem_id = $id;
        $comment->save();
        return response()->json([
            "message" => "Comentario realizado."
        ],200);
    }

    /*
    Funcão p/ mostrar um comentário específico
    */
    public function show($id)
    {
        if(Comment::where('id', $id)->exists()){
            return Comment::find($id);
        }else{
            return response()->json([
                "message" => "Comentario não existe."
            ], 404);

        }
    }

    /*
    Funcão p/ editar o comentário baseado em seu ID
    */
    public function edit(Request $request, $id)
    {
        if(Comment::where('id', $id)->exists()){
            $comment = Comment::find($id);
            $comment->usuario = $request->usuario;
            $comment->descricao = $request->descricao;
            $comment->save();
            return response()->json([
                "message" => "Comentario editado"
            ], 200);
        }else{
            return response()->json([
                "message" => "Comentario não existe."
            ], 404);

        }
    }
    /*
    Funcão p/ deletar o comentário pelo seu ID
    */
    public function destroy($id)
    {
        if(Comment::where('id', $id)->exists()){
            $comment = Comment::find($id);
            $comment->delete($id);
            return response()->json([
                "message" => "Comentario deletado"
            ],200);
        }else{
            return response()->json([
                "message" => "Comentario não existe."
            ], 404);

        }
    }
}
