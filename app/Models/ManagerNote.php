<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManagerNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id', 'employee_user_id', 'manager_user_id', 'assessment_id',
        'kpi_id', 'note_type', 'content', 'is_visible_to_employee',
        'requires_followup', 'followup_by'
    ];

    protected function casts(): array
    {
        return [
            'is_visible_to_employee' => 'boolean',
            'requires_followup' => 'boolean',
            'followup_by' => 'date',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_user_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_user_id');
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function kpi(): BelongsTo
    {
        return $this->belongsTo(Kpi::class);
    }
}
