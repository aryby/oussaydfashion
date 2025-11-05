<?php

namespace App\Models;

use TypiCMS\NestableTrait;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, NestableTrait;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'description',
        'description_ar',
        'parent_id',
        'featured',
        'menu',
        'image'
    ];

    protected $casts = [
        'parent_id' =>  'integer',
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('menu', true);
        });
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('featured', 1);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getNameAttribute($value)
    {
        if (app()->getLocale() == 'ar' && $this->name_ar) {
            return $this->name_ar;
        }
        return $value;
    }

    public function setDescriptionArAttribute($value)
    {
        $this->attributes['description_ar'] = $value;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
