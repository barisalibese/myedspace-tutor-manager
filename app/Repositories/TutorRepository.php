<?php

namespace App\Repositories;

use App\Models\Tutor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TutorRepository extends BaseRepository
{
    public function getTotalActiveTutors()
    {
        return $this->model->whereJsonLength('subjects', '>', 0)->count();
    }

    public function getAverageHourlyRate()
    {
        return $this->model->whereJsonLength('subjects', '>', 0)->avg('hourly_rate');
    }

    public function getMinRateTutor(): ?Model
    {
        return $this->model->whereJsonLength('subjects', '>', 0)->orderBy('hourly_rate')->first();
    }

    public function getMaxRateTutor(): ?Model
    {
        return $this->model->whereJsonLength('subjects', '>', 0)->orderByDesc('hourly_rate')->first();
    }

    public function getHighestPaidSubject(): ?Model
    {
        return $this->model->select(DB::raw('json_unquote(json_extract(subjects, "$[*]")) as subjects'), DB::raw('avg(hourly_rate) as avg_hourly_rate'))
            ->groupBy('subjects')
            ->orderByDesc('avg_hourly_rate')
            ->first();
    }

    public function getTutorsBySearchFilter(array $data): Collection
    {
        if (! empty($data['subjects'])) {
            $this->model = $this->model->whereJsonContains('subjects', $data['subjects']);
        }

        return $this->model->select('id', 'name', 'avatar', 'hourly_rate', 'subjects')->where('name', 'like', '%'.$data['searchText'].'%')->whereJsonLength('subjects', '>', 0)->where('hourly_rate', '>=', $data['hourlyRate'])->orderBy('hourly_rate')->get();
    }

    protected function setModel(): Model
    {
        return new Tutor;
    }
}
