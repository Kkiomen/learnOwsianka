<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogContent;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function callbackGenerateData(Request $request, int $entityId)
    {
        $body = $request->all();

        if(empty($body) || !isset($body['type']) || !isset($body['data'])) {
            return response()->json(['status' => 1, 'error' => 'Invalid request'], 400);
        }

        if($body['type'] === 'ARTICLE_CONTENT') {
            $data = $body['data'];
            $content = $data['content'];
            $blogContent = BlogContent::where('id', $entityId)->first();
            $blogContent->content = $content;
            $blogContent->save();

            return response()->json(['status' => 0, 'message' => 'Success']);
        }

        dd($body, $entityId);
    }
}
