<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogContent;
use App\Models\Post;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function callbackGenerateData(Request $request, int $entityId)
    {
        $body = $request->all();

        if(empty($body) || !isset($body['type']) || !isset($body['data'])) {
            return response()->json(['status' => 1, 'error' => 'Invalid request'], 400);
        }

        if($body['type'] === 'ARTICLE') {
            $data = $body['data'];
            $content = $data['content'];
            $blogContent = BlogContent::where('id', $entityId)->first();
            $blogContent->content = $content;
            $blogContent->status_generated = 2;
            $blogContent->save();

            return response()->json(['status' => 0, 'message' => 'Success']);
        }else if($body['type'] === 'BLOG_POST') {
            $data = $body['data'];
            $content = $data['content'];
            $post = Post::where('id', $entityId)->first();
            $post->content = $content;
            $post->save();

            return response()->json(['status' => 0, 'message' => 'Success']);
        }

        return response()->json(['status' => 1, 'error' => 'Invalid request'], 400);
    }
}
