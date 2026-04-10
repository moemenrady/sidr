<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    // رفع صورة
    public static function upload($file, $folder)
    {
        if (!$file) return null;

        return $file->store($folder, 'public');
    }

    // حذف صورة
    public static function delete($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    // استبدال صورة
    public static function replace($oldPath, $file, $folder)
    {
        self::delete($oldPath);
        return self::upload($file, $folder);
    }
}