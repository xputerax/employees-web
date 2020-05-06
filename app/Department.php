<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Employee;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'dept_no';
    public $timestamps = false;
    protected $fillable = ['dept_no', 'dept_name'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $hidden = ['employees', 'managers'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'dept_emp', 'dept_no', 'emp_no');
    }

    public function managers()
    {
        return $this->belongsToMany(Employee::class, 'dept_manager', 'dept_no', 'emp_no');
    }
}
