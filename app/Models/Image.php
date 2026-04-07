<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public static function getUrlByFilePath($filePath, $w = null, $h = null)
    {
        if (!$w && !$h) {
            return Storage::url($filePath);
        }
        $path = dirname($filePath);
        $fileName = basename($filePath);
        $file = "{$path}/crop_{$w}x{$h}_{$fileName}";
        return Storage::url($file);
    }

    public function getUrl($w = null, $h = null)
    {
        $baseName = basename($this->path);
        $dirName = dirname($this->path);

        $candidates = [];

        if ($w && $h) {
            $candidates[] = $dirName . "/crop_{$w}x{$h}_{$baseName}";
        }

        if ($w) {
            $candidates[] = $dirName . "/crop_{$w}_{$baseName}";
            $candidates[] = $dirName . "/resize_{$w}_{$baseName}";
        }

        foreach ($candidates as $candidate) {
            if (file_exists(storage_path('app/public/' . $candidate))) {
                return asset('storage/' . $candidate);
            }
        }

        return asset('storage/' . $this->path);
    }
}
