<?php

namespace App\Policies;

use App\Models\Slider;
use App\Models\User;

class SliderPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Slider $slider): bool
    {
        return $user->school_id === $slider->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Slider $slider): bool
    {
        return $user->school_id === $slider->school_id;
    }

    public function delete(User $user, Slider $slider): bool
    {
        return $user->school_id === $slider->school_id;
    }
}
