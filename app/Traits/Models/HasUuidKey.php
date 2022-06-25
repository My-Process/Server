<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait HasUuidKey
{
    public function getUuidAttribute(): ?UuidInterface
    {
        $attribute = $this->attributes[$this->getRouteKeyName()] ?? null;

        return !$attribute ? null : Uuid::fromString($attribute);
    }

    public function setUuidAttribute($uuid): void
    {
        if (!$uuid instanceof UuidInterface) {
            $uuid = Uuid::fromString($uuid);
        }

        $this->attributes[$this->getRouteKeyName()] = $uuid->toString();
    }

    public static function bootHasUuidKey(): void
    {
        static::creating(fn (Model $model) => $model->generateUuid());
    }

    public function generateUuid(): void
    {
        if (empty($this->attributes[$this->getRouteKeyName()])) {
            $this->setAttribute($this->getRouteKeyName(), Str::orderedUuid());
        }
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
