<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationPreference extends Model
{
    protected $fillable = [
        'user_id',
        'email_assessment_reminder', 'email_cycle_start', 'email_monthly_summary',
        'email_performance_alert', 'email_promotion_update',
        'inapp_assessment_reminder', 'inapp_performance_alert', 
        'inapp_promotion_update', 'inapp_manager_note'
    ];

    protected function casts(): array
    {
        return [
            'email_assessment_reminder' => 'boolean',
            'email_cycle_start' => 'boolean',
            'email_monthly_summary' => 'boolean',
            'email_performance_alert' => 'boolean',
            'email_promotion_update' => 'boolean',
            'inapp_assessment_reminder' => 'boolean',
            'inapp_performance_alert' => 'boolean',
            'inapp_promotion_update' => 'boolean',
            'inapp_manager_note' => 'boolean',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
