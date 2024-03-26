<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    public function uploadFile(UploadedFile $image, ?string $path = 'images', string $disk = 'public'): string
    {
        if ($image->getClientOriginalExtension() === 'mp4') {
            $name = $path . '/' . Str::uuid()->toString() . '.mp4';
        } else {
            $extension = in_array($image->extension(), ['png', 'jpeg', 'jpg', 'svg', 'webp','avif']) ? 'webp' : $image->extension();
            $name = $path . '/' . Str::uuid()->toString() . '.' . $extension;
        }

        $image->storeAs($disk, $name);
        return $name;
    }

    public function replaceFile(UploadedFile $image, ?string $old_image_name = null, ?string $path = 'images', string $disk = 'public'): string
    {
        $this->removeFile($old_image_name ?? '', $disk);
        return $this->uploadFile($image, $path, $disk);
    }

    public function copyImage($filePath, $newFileName, $disk = 'public', $delete_url = null,$folder_name = null): string
    {
        $folder = '';
        $splitted = explode('/', $filePath);

        if (count($splitted) > 1) {
            $folder = $folder_name ?? $splitted[0];
            $fileName = $splitted[1];
        } else {
            $fileName = $splitted[0];
        }
        $teamImageExt = explode('.', $fileName)[1];

        $newImageName = ($folder ? $folder . '/' : '') . $newFileName . '.' . $teamImageExt;
        Storage::disk($disk)->copy($filePath, $newImageName);
        if ($delete_url) {
            Storage::disk($disk)->delete($delete_url);
        }
        return $newImageName;
    }

    public function removeFile($image_name, string $disk = 'public')
    {
        Storage::disk($disk)->delete($image_name);
    }
}


