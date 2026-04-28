<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_type', 'organization_id', 'department_id', 'team_id', 'job_role_id', 'reports_to_user_id',
        'name', 'email', 'password', 'phone', 'employee_id', 'avatar_path', 'joined_at',
        'system_role', 'current_mq_score', 'promotion_readiness', 'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'joined_at' => 'date',
            'is_active' => 'boolean',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    /**
     * For employees: the org they belong to.
     * For org users: the org they own.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function ownedOrganization(): HasOne
    {
        return $this->hasOne(Organization::class, 'owner_user_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function jobRole(): BelongsTo
    {
        return $this->belongsTo(JobRole::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reports_to_user_id');
    }

    public function directReports(): HasMany
    {
        return $this->hasMany(User::class, 'reports_to_user_id');
    }

    public function notificationPreferences(): HasOne
    {
        return $this->hasOne(NotificationPreference::class);
    }

    public function latestAssessmentResult(): HasOne
    {
        return $this->hasOne(AssessmentResult::class)->latestOfMany();
    }

    public function performanceHistory(): HasMany
    {
        return $this->hasMany(PerformanceHistory::class)->orderBy('recorded_on', 'asc');
    }

    public function latestPerformanceHistory(): HasOne
    {
        return $this->hasOne(PerformanceHistory::class)
            ->latestOfMany('recorded_on');
    }

    // ── Identity Resolution ──────────────────────────────────────────────────

    /**
     * Returns the name to display in the UI.
     * If org type, it returns the company name.
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->isOrganization() && $this->ownedOrganization) {
            return $this->ownedOrganization->name;
        }

        return $this->name;
    }

    /**
     * Returns the sub-label (e.g. "Employee" or "Job Title").
     */
    public function getDisplaySubtitleAttribute(): string
    {
        if ($this->isOrganization()) {
            return 'Organization Account';
        }

        return $this->jobRole->title ?? 'Employee';
    }

    public function getDisplayAvatarAttribute(): string
    {
        if ($this->isOrganization() && $this->ownedOrganization && $this->ownedOrganization->logo_path) {
            return asset($this->ownedOrganization->logo_path);
        }

        return "https://ui-avatars.com/api/?name=" . urlencode($this->name) . "&background=111827&color=fff";
    }

    // ── Role Helpers ─────────────────────────────────────────────────────────

    public function isOrganization(): bool
    {
        return $this->user_type === 'org';
    }

    public function isEmployee(): bool
    {
        return $this->user_type === 'employee';
    }

    public function isManager(): bool
    {
        // Managers are employees with elevated roles
        return $this->isEmployee() && in_array($this->system_role, ['manager', 'hr']);
    }

    public function isOrgAdmin(): bool
    {
        // Org Admin can be the Organization user or an employee with admin role
        return $this->isOrganization() || $this->system_role === 'org_admin';
    }
}
