<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{


  // jsonTest
  public function jsonTest() {
    $tests = Test::all();


    return response()->json($tests);
  }
}