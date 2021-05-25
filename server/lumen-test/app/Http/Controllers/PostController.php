<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
  //post_test
  public function postTest(Request $request) {
    return response()->json($request);
      // $posts = Post::all();
      // return response()->json($posts);
  }


    // ブログ一覧表示
    public function showList() {
      $posts = Post::all();
      
      return view('list', ["posts" => $posts]);
    }
    public function jsonList() {
      $posts = Post::all();
      return response()->json($posts);
    }
    // ブログ詳細表示
    public function showDetail($id) {
      $post = Post::find($id);
      return view('detail', ['post' => $post]);
    }
    // ブログ登録画面
    public function showCreate() {
      return view('form');
    }
    // ブログ登録画面
    public function testStore(Request $request) {
      $posts = Post::all();

      $post = new Post;
      $post->id = count($posts) + 1;
      $post->name = $request[0];
      $post->contents = $request[1];
      $post->image_name = $request[3];
      $post->pas_wd = $request[2];
      $post->created_at = date("Y/m/d H:i:s");
      $post->save();
      return response()->json($request); 
      // return response()->json($t); 
      // return redirect('/');
    }



    // ブログ登録画面
    public function imageStore() {
      $lll = [1,2,3,4,5,6];
      // var_dump($request);
      // $request->pic->store('./img/', $request->upimg);
      return response()->json($lll);
    }


    // ブログ削除
    public function exeDestroy($id) {
      $post = Post::find($id);
      $post->delete();

      $posts = Post::all();
      for ($i = 0; $i < count($posts); $i++) {
        $post_id = $posts[$i];
        $post_id->id = 1+$i;
        $post_id->save();
      }
      // return redirect('/');
    }
    // ブログ編集画面
    public function showEdit($id) {
      $post = Post::find($id);
      return view('edit', ['post' => $post]);
    }
    public function itemEdit($id) {
      $post = Post::find($id);
      return response()->json($post);
    }
    // ブログ編集
    public function exeUpdate(Request $request) {
      $post = Post::find($request[0]);
      $post->name = $request[1];
      $post->contents = $request[2];
      $post->pas_wd = $request[3];
      $post->updated_at = date("Y/m/d H:i:s");
      $post->save();
      return response()->json($request); 
      // return redirect('/');
    }
}