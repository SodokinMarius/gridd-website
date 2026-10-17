<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'url',
        'country',
        'order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function countryName(): ?string
    {
        return $this->country ? config('countries.'.$this->country) : null;
    }

    public function flagUrl(): ?string
    {
        if (! $this->country || $this->country === 'int') {
            return null;
        }

        return 'https://flagcdn.com/'.$this->country.'.svg';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('name');
    }
}
