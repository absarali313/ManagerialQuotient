<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'organization_id', 'triggered_by_result_id', 'recipient_user_id',
        'alert_type', 'severity', 'previous_score', 'current_score', 'delta',
        'message', 'metadata', 'is_read', 'read_by_user_id', 'read_at',
        'is_actioned', 'actioned_at'
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
            'is_read' => 'boolean',
            'read_at' => 'datetime',
            'is_actioned' => 'boolean',
            'actioned_at' => 'datetime',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function targetUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }

    public function readBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'read_by_user_id');
    }

    public function triggeredByResult(): BelongsTo
    {
        return $this->belongsTo(AssessmentResult::class, 'triggered_by_result_id');
    }
}
