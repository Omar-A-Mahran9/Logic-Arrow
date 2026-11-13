<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    /** Service keys sent by the website form, with their dashboard (Arabic) labels. */
    public const SERVICES = [
        'apps' => 'تطبيقات الأعضاء والعملاء',
        'websites' => 'المواقع والبوابات',
        'ai' => 'المساعدون الأذكياء',
        'dashboards' => 'لوحات الإدارة',
        'automation' => 'أتمتة سير العمل',
        'integration' => 'التكامل',
    ];

    protected $fillable = ['name', 'company', 'phone', 'email', 'service', 'message', 'locale'];

    public function serviceLabel(): ?string
    {
        return $this->service ? (self::SERVICES[$this->service] ?? $this->service) : null;
    }

    protected function casts(): array
    {
        return ['read_at' => 'datetime'];
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('read_at');
    }

    public function markAsRead(): void
    {
        if ($this->read_at === null) {
            $this->forceFill(['read_at' => now()])->save();
        }
    }
}
