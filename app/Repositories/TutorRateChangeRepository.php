<?php

namespace App\Repositories;

use App\Models\TutorRateChange;
use Illuminate\Database\Eloquent\Model;

class TutorRateChangeRepository extends BaseRepository
{
    public function bulkCreate(array $data)
    {
        return $this->model->insert($data);
    }

    protected function setModel(): Model
    {
        return new TutorRateChange;
    }
}
