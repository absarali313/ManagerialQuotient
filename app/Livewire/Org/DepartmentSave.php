<?php

namespace App\Livewire\Org;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class DepartmentSave extends Component
{
    public ?Department $department = null;

    public string $name = '';

    public ?string $code = null;

    public ?string $description = null;

    public ?int $headUserId = null;

    public bool $isActive = true;

    public function mount(?Department $department = null): void
    {
        if ($department && $department->exists) {
            $this->department = $department;
            $this->name = $department->name;
            $this->code = $department->code;
            $this->description = $department->description;
            $this->headUserId = $department->head_user_id;
            $this->isActive = $department->is_active;
        }
    }

    public function getEmployeesProperty(): Collection
    {
        return User::where('organization_id', $this->organizationId())
            ->where('is_active', true)
            ->where('user_type', 'employee')
            ->orderBy('name')
            ->get();
    }

    private function organizationId(): int
    {
        $user = auth()->user();

        return $user->isOrganization() ? $user->ownedOrganization->id : $user->organization_id;
    }

    public function save(): void
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')
                    ->where('organization_id', $this->organizationId())
                    ->ignore($this->department?->id),
            ],
            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('departments', 'code')
                    ->where('organization_id', $this->organizationId())
                    ->ignore($this->department?->id),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'headUserId' => ['nullable', 'exists:users,id'],
            'isActive' => ['boolean'],
        ];

        $validated = $this->validate($rules);

        $data = [
            'name' => $validated['name'],
            'code' => $validated['code'],
            'description' => $validated['description'],
            'head_user_id' => $validated['headUserId'],
            'is_active' => $validated['isActive'],
            'organization_id' => $this->organizationId(),
        ];

        if (! $this->department || ! $this->department->exists) {
            $this->department = Department::create($data);
            session()->flash('success', "Department $this->name has been created.");
        } else {
            $this->department->update($data);
            session()->flash('success', "Department $this->name has been updated.");
        }

         to_route('org_departments_edit', $this->department);
    }

    public function render(): View
    {
        return view('livewire.org.department.department-save');
    }
}
