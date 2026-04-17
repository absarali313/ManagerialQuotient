<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportExport extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'generated_by_user_id', 'user_id', 'report_type',
        'format', 'status', 'file_path', 'file_name', 'file_size_bytes',
        'expires_at', 'filters'
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'filters' => 'array',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by_user_id');
    }

    /** The subject of the report (null if it's an org-wide report) */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
