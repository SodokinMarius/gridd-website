<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * NB : ce modèle s'appelle volontairement "JobPosting" et non "Job" pour éviter
 * tout conflit avec le système de files d'attente natif de Laravel (table "jobs").
 */
class JobPosting extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'title',
        'slug',
        'contract_type',
        'location',
        'description',
        'deadline',
        'is_published',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_published' => 'boolean',
    ];

    public function isExpired(): bool
    {
        return $this->deadline !== null && $this->deadline->isPast();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('deadline')->orWhere('deadline', '>=', now()->toDateString());
            });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
