<?php

namespace App\Models;

use App\Traits\Models\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Permission extends Model
{
    use HasFactory;
    use HasUuidKey;

    protected $fillable = [
        'scope',
        'name',
        'slug',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)
            ->using(PermissionRole::class)
            ->withTimestamps();
    }

    public static function getAllFromCache()
    {
        return Cache::rememberForever('permissions', fn () => self::all());
    }

    public static function existsOnCache(string $permission)
    {
        return self::getAllFromCache()->filter(function ($value) use ($permission) {
            return is_numeric($permission) ? $value->id == (int) $permission : $value->name == $permission || $value->slug == $permission;
        })->isNotEmpty();
    }
}
