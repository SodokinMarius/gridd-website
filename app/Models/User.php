<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Rôles disponibles pour l'espace d'administration.
     */
    public const ROLE_ADMIN = 'admin';
    public const ROLE_EDITOR = 'editor';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

 protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
];

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
}
