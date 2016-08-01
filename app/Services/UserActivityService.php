<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserActivityService
{
    /**
     * Log activity for user.
     *
     * @param Request $request
     * @param Model $model
     * @param $content
     */
    public function log(Request $request, Model $model, $content)
    {
        $request->user()->activities()->create([
            'ip_address' => $request->ip(),
            'type' => class_basename($model),
            'type_id' => $model->id,
            'content' => $content
        ]);
    }
}

