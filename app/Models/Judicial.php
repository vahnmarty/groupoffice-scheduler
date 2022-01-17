<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Judicial extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'jud_docket';

    public function scopeIncomplete($query)
    {
        return $query->where('completion', false);
    }

    public function isScheduleToday()
    {
        return $this->court_date == Carbon::today()->format('Y-m-d');
    }

    public function isScheduleTomorrow()
    {
        return $this->court_date == Carbon::tomorrow()->format('Y-m-d');
    }
}
