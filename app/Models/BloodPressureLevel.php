<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPressureLevel extends Model
{
    use HasFactory;

    public function suggestions(){
        return $this->hasMany(Suggestion::class);
    }

    public static function getBloodPressureLevel($systolic, $diastolic, $age)
{
    return self::where('age_min', '<=', $age)
        ->where(function ($query) use ($age) {
            $query->where('age_max', '>=', $age)
                ->orWhereNull('age_max');  // Handle null age_max case
        })
        ->where('systolic_min', '<=', $systolic)
        ->where(function ($query) use ($systolic) {
            $query->where(function ($subquery) use ($systolic) {
                $subquery->where('systolic_max', '>=', $systolic)
                    ->orWhereNull('systolic_max'); // Handle null systolic_max case
            });
        })
        ->where('diastolic_min', '<=', $diastolic)
        ->where(function ($query) use ($diastolic) {
            $query->where(function ($subquery) use ($diastolic) {
                $subquery->where('diastolic_max', '>=', $diastolic)
                    ->orWhereNull('diastolic_max'); // Handle null diastolic_max case
            });
        })
        ->first();
}

}
