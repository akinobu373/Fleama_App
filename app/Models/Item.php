<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory;

    public function attachment()
    {
        return $this->hasOne(Attachment::class);
    }

    public function getImagePathAttribute()
    {
        return 'images/items/' . $this->attachment->image;
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }
}
