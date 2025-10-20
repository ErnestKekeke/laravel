<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // ..........................................
    public function all_posts(){
        $posts = Post::all();
        if(empty($posts)){
            return response()->json(["msg" => "No Post Yet!"])->setStatusCode(200);
        }

        // return response()->json($posts)->setStatusCode(201);

        $allPosts = array();
        foreach($posts as $post){
            $p = array();
            $p['id'] = $post['id'];
            $p['userId'] = $post['userId'];
            $p['title'] = $post['title'];
            $p['body'] = $post['body'];

            array_push($allPosts, $p);
        }

        return response()->json($allPosts)->setStatusCode(200);
    }

    // ..........................................
    public function single_post(int $id){

        $post = Post::find($id);
        if(empty($post)){
            return response()->json(["msg" => "post id:{$id} unavailble"])->setStatusCode(200);
        }

        $p = array();
        $p['id'] = $post['id'];
        $p['userId'] = $post['userId'];
        $p['title'] = $post['title'];
        $p['body'] = $post['body'];

        return response()->json($p)->setStatusCode(200);
    }

    // ............................................
    public function create_post(Request $request){
        $post = new Post();
        $post->userId = (int)strip_tags(trim($request->userId));
        $post->title = strip_tags(trim($request->title));
        $post->body = strip_tags(trim($request->body));

        if($this->checkFieldsEmpty($post)){
            return response()->json(["msg" => "Enter all neccessary Fields"])->setStatusCode(400);
        }

        $post->save();
        return response()->json(["msg" => "Post Created successfully!"])->setStatusCode(201);
    }

    // ............................................
    public function update_post(Request $request, int $id){
        $post = Post::find($id);
        if(empty($post)){
            return response()->json(["msg" => "post id:{$id} unavailble"])->setStatusCode(200);
        }

        $post->userId = (int)strip_tags(trim($request->userId));
        // echo $post->userId;
        $post->title = strip_tags(trim($request->title));
        //  echo $post->title;
        $post->body = strip_tags(trim($request->body));
        //  echo $post->body;

        if($this->checkFieldsEmpty($post)){
            return response()->json(["msg" => "Enter all neccessary Fields"])->setStatusCode(400);
        }

        $post->save();
        return response()->json(["msg" => "Post Updated successfully!"])->setStatusCode(200);
    }

    // ............................................
    public function delete_post(int $id){
        $post = Post::find($id);
        if(empty($post)){
            return response()->json(["msg" => "post id:{$id} unavailble"])->setStatusCode(200);
        }

        $post->delete();
        return response()->json(["msg" => "Post Delete successfully!"])->setStatusCode(200);
    }

    // ............................................
    private function checkFieldsEmpty(Post $post): bool {
        if(empty($post['userId']) || empty($post['title'])|| empty($post['body'])){
            return true;
        }
        return false;
    }
}