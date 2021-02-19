<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use League\Glide\Server;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Common;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'status' => 'boolean',
        'enable_marketing' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'slug','image', 'marketing_image', 'enable_marketing', 'description', 'status'];

    public function get_size($file_path)
    {
        return Storage::size($file_path);
    }

    public function imageFileSize()
    {
        if ($this->image) {
            $bytes = Storage::size($this->image);
            return Common::bytesToHuman($bytes);
        }
    }

    public function marketingImageFileSize()
    {
        if ($this->marketing_image) {
            $bytes = Storage::size($this->marketing_image);
            return Common::bytesToHuman($bytes);
        }
    }


    public function imageUrl(array $attributes)
    {
        if ($this->image) {
            return URL::to(App::make(Server::class)->fromPath($this->image, $attributes));
        }
    }

    public function marketingImageUrl(array $attributes)
    {
        if ($this->marketing_image) {
            return URL::to(App::make(Server::class)->fromPath($this->marketing_image, $attributes));
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
