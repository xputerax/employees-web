<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentEmployee extends Pivot
{
    protected $table = 'dept_emp';
    protected $primaryKey = null;
    public $timestamps = false;
    protected $fillable = ['emp_no', 'dept_no', 'from_date', 'to_date'];
    public $incrementing = false;
    protected $keyType = null;
    protected $dates = ['from_date', 'to_date'];
    protected $casts = [
        'from_date' => 'datetime:Y-m-d',
        'to_date' => 'datetime:Y-m-d'
    ];
}
