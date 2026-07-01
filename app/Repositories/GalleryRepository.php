<?php

namespace App\Repositories;

use App\Models\Gallery;

class GalleryRepository extends BaseRepository
{
    protected function resolveModel(): Gallery
    {
        return new Gallery;
    }
}
