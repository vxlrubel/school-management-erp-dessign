<?php

namespace App\Repositories;

use App\Models\Slider;

class SliderRepository extends BaseRepository
{
    protected function resolveModel(): Slider
    {
        return new Slider;
    }
}
