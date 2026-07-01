<?php

namespace App\Policies;

use App\Models\PopupSetting;
use App\Models\User;

class PopupSettingPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PopupSetting $popupSetting): bool
    {
        return $user->school_id === $popupSetting->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, PopupSetting $popupSetting): bool
    {
        return $user->school_id === $popupSetting->school_id;
    }

    public function delete(User $user, PopupSetting $popupSetting): bool
    {
        return $user->school_id === $popupSetting->school_id;
    }
}
