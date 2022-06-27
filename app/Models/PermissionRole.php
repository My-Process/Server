<?php

namespace App\Models;

use App\Traits\Models\HasUuidKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionRole extends Pivot
{
    use HasUuidKey;

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
}
