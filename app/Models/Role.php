<?php

namespace App\Models;

use App\Traits\Models\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    use HasFactory;
    use HasPermissions;

    protected $fillable = [
        'name',
        'type',
        'description',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(RoleUser::class)
            ->withTimestamps();
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class)
            ->using(PermissionRole::class)
            ->withTimestamps();
    }

    public static function getAllFromCache()
    {
        return Cache::rememberForever('roles', fn () => self::all());
    }

    public static function getRole(int|string $role)
    {
        return self::getAllFromCache()->filter(function ($value) use ($role) {
            return $value->id === $role || $value->name === $role || $value->slug === $role;
        })->first();
    }
}
