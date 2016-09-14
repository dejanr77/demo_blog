<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Notify extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address',
        'type',
        'type_id',
        'body',
        'new',
        'from',
        'to'
    ];

    public static function notify($from, $to, $model, $body )
    {
        if (is_array($to))
        {
            foreach($to as $u)
            {
                if ($u['id'] == $from) continue;

                Notify::create([
                    'ip_address' => request()->ip(),
                    'type' => class_basename($model),
                    'type_id' => $model->id,
                    'from' => $from,
                    'to' => $u['id'],
                    'body' => $body
                ]);
            }
        }
        else
        {
            if ($to == $from) return null;

            Notify::create([
                'ip_address' => request()->ip(),
                'type' => class_basename($model),
                'type_id' => $model->id,
                'from' => $from,
                'to' => $to,
                'body' => $body
            ]);
        }


    }

    public function notificationTo()
    {
        return $this->belongsTo('App\User','to');
    }


    public function notificationFrom()
    {
        return $this->belongsTo('App\User','from');
    }
}
