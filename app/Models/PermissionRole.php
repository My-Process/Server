<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Cache;

class PermissionRole extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'permission_id',
        'role_id',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }

    public static function getAllFromCache()
    {
        return Cache::rememberForever('permissions::roles', fn () => self::all());
    }

    public static function getRolePermissions(Role $role)
    {
        return self::getAllFromCache()->where('role_id', $role->id);
    }
}
