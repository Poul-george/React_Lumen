<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    // ブログ一覧表示
    public function showList() {
      $posts = Post::all();
      return view('post.list', ['posts' => $posts]);
    }
}