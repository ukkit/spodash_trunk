<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sprint_calendar extends Model
{
    use SoftDeletes;

    public $table = 'sprint_calendars';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'sprint_number',
        'sprint_start_date',
        'sprint_end_date',
        'sprint_end_date_same_as_next_start_date',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sprint_number' => 'integer',
        'sprint_start_date' => 'date',
        'sprint_end_date' => 'date',
        'sprint_end_date_same_as_next_start_date' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sprint_number' => 'required',
        'sprint_start_date' => 'required',
        'sprint_end_date' => 'required',
        // 'sprint_end_date_same_as_next_start_date' => 'required'
    ];

    public static function current_sprint()
    {
        $list = Sprint_calendar::all();
        $today = Carbon::now()->toDateString();
        $start = null;
        $end = null;

        foreach ($list as $li) {
            $st_date = Carbon::parse($li->sprint_start_date)->toDateString();
            $end_date = Carbon::parse($li->sprint_end_date)->toDateString();
            if (($today >= $st_date) and ($today <= $end_date)) {
                return $li->sprint_number;
            }
        }
    }

    // public static function current_sprint()
    // {
    //     $list = Sprint_calendar::all();
    //     $start = null;
    //     $end = Null;
    //     $sprint = Null;
    //     $today = Carbon::now()->toDateString();
    //     foreach($list as $sc) {
    //         $end = Carbon::parse($sc->sprint_start_date)->toDateString();
    //         if ($start == Null) {
    //             $start = $end;
    //         } else {
    //             if (($today >= $start) && ($today <= $end)) {
    //                 $sprint = $sc->sprint_number;
    //             }
    //             $start = $end;
    //         }
    //     }
    //     return $sprint;
    // }
}
