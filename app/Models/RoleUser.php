<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Cache;

class RoleUser extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllFromCache()
    {
        return Cache::rememberForever('roles::users', fn () => self::all());
    }

    public static function getUserRoles(User $user)
    {
        return self::getAllFromCache()->where('user_id', $user->id);
    }
}
