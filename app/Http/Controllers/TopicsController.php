<?php

namespace App\Http\Controllers;

use Daily\Handler\Exception\ImageUploadException;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function create()
    {
        return view('topics.create_edit');
    }

    public function store(Request $request)
    {
    }

    public function uploadImage(Request $request)
    {
        if ($file = $request->file('file')) {
            try {
                $upload_status = app('Daily\Handler\UploadImageHandler')->uploadImage($file);
            } catch (ImageUploadException $exception) {
                return ['error' => $exception->getMessage()];
            }
            $data['filename'] = $upload_status['filename'];
        } else {
            $data['error'] = 'Error while uploading file';
        }

        return $data;
    }

}
