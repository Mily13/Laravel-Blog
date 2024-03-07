<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;

class TagsController extends Controller{

    public function getTags(Request $request){
        $search = $request->input('q');
        $tags = Tags::where('name', 'like', "%$search%")->get();
        return response()->json($tags);
    }
}
