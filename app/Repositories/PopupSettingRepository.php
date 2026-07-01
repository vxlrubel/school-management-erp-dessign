<?php

namespace App\Repositories;

use App\Models\PopupSetting;

class PopupSettingRepository extends BaseRepository
{
    protected function resolveModel(): PopupSetting
    {
        return new PopupSetting;
    }
}
