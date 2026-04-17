<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShareableReportToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'report_export_id', 'created_by_user_id',
        'token', 'recipient_email', 'recipient_name', 'password_protected',
        'password_hash', 'expires_at', 'view_count', 'last_viewed_at', 'is_revoked'
    ];

    protected function casts(): array
    {
        return [
            'password_protected' => 'boolean',
            'expires_at' => 'datetime',
            'last_viewed_at' => 'datetime',
            'is_revoked' => 'boolean',
        ];
    }

    protected $hidden = [
        'password_hash',
    ];

    // ── Relationships ────────────────────────────────────────────────────────

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function reportExport(): BelongsTo
    {
        return $this->belongsTo(ReportExport::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
