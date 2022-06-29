<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
    ];

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

    public static function getRole(string $role)
    {
        return self::getAllFromCache()->filter(function ($value) use ($role) {
            return is_numeric($role) ? $value->id == (int) $role : $value->name == $role || $value->slug == $role;
        })->first();
    }

    public function hasPermissionTo(string $permission): bool
    {
        $permissionsOfRole = Cache::rememberForever('permissions::of::role::'.$this->id, fn () => $this->permissions()->get());

        return $permissionsOfRole->filter(function ($value) use ($permission) {
            return is_numeric($permission) ? $value->id == (int) $permission : $value->name == $permission || $value->slug == $permission;
        })->isNotEmpty();
    }
}
