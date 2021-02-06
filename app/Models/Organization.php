<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use League\Glide\Server;

class Organization extends Model
{
    use SoftDeletes;

    protected $casts = [
        'enable_marketing' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'email', 'phone', 'address' , 'city', 'region', 'country', 'postal_code', 'marketing_image', 'enable_marketing'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
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
            $query->where('name', 'like', '%'.$search.'%');
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
