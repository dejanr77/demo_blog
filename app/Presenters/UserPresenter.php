<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function fullName()
    {
        $profile = $this->profile;

        $title = ($profile->title == '') ? '' : $profile->title.'. ';
        $first_name = ($profile->first_name == '') ? '' : $profile->first_name;
        $last_name = ($profile->last_name == '') ? '' : $profile->last_name;

        return $title.$first_name.' '.$last_name;
    }

    public function publicFullName()
    {
        if($this->profile)
        {
            return $this->fullName();
        }

        return $this->name;

    }
}