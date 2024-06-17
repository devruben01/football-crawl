<?php

namespace App\Traits;

use App\Exceptions\UploadFileException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait Uploader
{
    /**
     * @param UploadedFile $file
     * @param $folder
     * @return string
     * @throws UploadFileException
     */
    public function storeFile(UploadedFile $file, $folder): string
    {
        if (!$file->isValid()) {
            throw new UploadFileException($file->getErrorMessage());
        }
        $folder = rtrim($folder, '/');
        $filePath = $file->storeAs(
            'public/' . $folder . '/' . auth()->id() . '/' . Str::random(20),
            $file->getClientOriginalName(),
            $this->getDisk()
        );

        return Storage::url($filePath);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function deleteFile(string $path): bool
    {
        return Storage::disk($this->getDisk())->delete($path);
    }

    /**
     * @return string
     */
    private function getDisk(): string
    {
        return Config::get('filesystems.default', 's3');
    }
}
