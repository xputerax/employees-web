<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Salary;
use \App\Title;
use \App\Department;
use \App\DepartmentManager;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'emp_no';
    public $timestamps = false;
    protected $dates = ['hire_date'];
    protected $casts = [
        'hire_date' => 'datetime:Y-m-d'
    ];
    protected $fillable = ['birth_date', 'first_name', 'last_name', 'gender', 'hire_date'];
    protected $hidden = ['salaries', 'titles', 'departments', 'managed_departments', 'pivot'];

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function titles()
    {
        return $this->hasMany(Title::class);
    }

    public function is_manager()
    {
        return DepartmentManager::where('emp_no', $this->emp_no)->count() > 0;
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'dept_emp', 'emp_no', 'dept_no');
    }

    public function managed_departments()
    {
        return $this->belongsToMany(Department::class, 'dept_manager', 'emp_no', 'dept_no');
    }
}
