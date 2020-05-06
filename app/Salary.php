<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salaries';
    protected $primaryKey = null;
    public $timestamps = false;
    protected $fillable = ['emp_no', 'salary', 'from_date', 'to_date'];
    public $incrementing = false;
    protected $keyType = null;
    protected $dates = ['from_date', 'to_date'];
    protected $casts = [
        'from_date' => 'datetime:Y-m-d',
        'to_date' => 'datetime:Y-m-d'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
