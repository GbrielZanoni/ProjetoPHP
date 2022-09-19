<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
/*
    Controller mostra todos os posts feitos
*/
class PostController extends Controller
{
   public function index(Request $request)
   {
    return Post::all();
   }
   /*
    Armazenamento dos Posts feitos
   */
   public function store(Request $request)
   {
       $post = new Post;
       $post->usuario = $request->usuario;
       $post->titulo = $request->titulo;
       $post->descricao = $request->descricao;
       $post->save();

       return response()->json([
        "message" => "Postagem foi realizada."
       ], 200);
   }
/*
    Mostra um post específico pelo seu ID
*/
   public function show(Request $request, $id)
   {
        if(Post::where('id',$id)->exists()){
            return Post::find($id);
        }else{
            return response()->json([
                "message" => "Postagem não foi encontrada"
            ], 404);
        }
   }
   /*
      Para editar a postagem
   */
   public function edit(Request $request, $id)
   {
        if(Post::where('id',$id)->exists()){
            $post = Post::find($id);
            $post->usuario = $request->usuario;
            $post->titulo = $request->titulo;
            $post->descricao = $request->descricao;
            $post->save();
            return response()->json([
                "message" => "Postagem editada."
            ], 200);
       }else{
            return response()->json([
               "message" => "Postagem não existe."
            ], 404);

       }
   }
   /*
      Função para deletar um post específico pelo seu ID, também quanto todas as postagems que
      foram realizadas neste Post para evitar erros.
   */
   public function destroy(Request $request, $id)
   {
        if(Post::where('id',$id)->exists()){
            $post = Post::find($id);
            $post->comment()->delete();
            $post->delete();
            return response()->json([
                "message" => "Postagem deletada."
            ], 200);
        }else{
            return response()->json([
                "message" => "Postagem não existe."
             ], 404);

        }
   }
}
