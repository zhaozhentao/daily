<?php

namespace Daily\Handler;

use Daily\Handler\Exception\ImageUploadException;
use Illuminate\Support\Facades\Log;
use Image;
use Auth;

/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/19
 * Time: 下午2:51
 */
class UploadImageHandler
{
    protected $file;
    protected $allowed_extensions = ["png", "jpg", "gif", 'jpeg'];

    public function uploadImage($file)
    {
        $this->file = $file;
        $this->checkAllowedExtensionsOrFail();

        $local_image = $this->saveImageToLocale('topic', 1440);
        return ['filename' => get_user_static_domain() . $local_image];
    }

    protected function checkAllowedExtensionsOrFail()
    {
        $extension = strtolower($this->file->getClientOriginalExtension());
        if ($extension && !in_array($extension, $this->allowed_extensions)) {
            throw new ImageUploadException('You can only upload image with extensions: ' . implode($this->allowed_extensions, ','));
        }
    }

    private function saveImageToLocale($type, $resize, $file_name = '')
    {
        $folderName = ($type == 'avatar')
            ? 'uploads/avatars'
            : 'uploads/images/' . date("Ym", time()) . '/' . date("d", time()) . '/' . Auth::user()->id;

        $destinationPath = public_path() . '/' . $folderName;
        $extension = $this->file->getClientOriginalExtension() ?: 'png';
        $safeName = $file_name ?: str_random(10) . '.' . $extension;
        $this->file->move($destinationPath, $safeName);

        if ($this->file->getClientOriginalExtension() != 'gif') {
            $img = Image::make($destinationPath . '/' . $safeName);
            $img->resize($resize, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save();
        }

        return $folderName . '/' . $safeName;
    }
}
