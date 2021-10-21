<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory;

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function getImagePathAttribute()
    {
        return 'items/' . $this->attachments[0]->name;
    }

    public function getImageUrlAttribute()
    {
        if (config('filesystems.default') == 'gcs') {
            return Storage::temporaryUrl($this->image_path, now()->addMinutes(5));
        }
        return Storage::url($this->image_path);
    }

    public function getImagePathsAttribute()
    {
        $attachments = $this->attachments;
        $paths = [];
        foreach ($attachments as $attachment) {
            $paths[] = 'items/' . $attachment->name;
        }
        return $paths;
    }

    public function getImageUrlsAttribute()
    {
        $image_paths = $this->image_paths;
        $urls = [];
        foreach ($image_paths as $path) {
            $urls[] = Storage::url($path);
        }
        return $urls;
    }

    protected $fillable = [
        'title',
        'body',
        'price',
    ];
}
