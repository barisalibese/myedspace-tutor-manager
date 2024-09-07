<?php

namespace App\Services;

use App\Repositories\TutorRateChangeRepository;
use App\Repositories\TutorRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TutorService
{
    private TutorRepository $repository;

    private TutorRateChangeRepository $tutorRateChangeRepository;

    public function __construct()
    {
        $this->repository = new TutorRepository;
        $this->tutorRateChangeRepository = new TutorRateChangeRepository;
    }

    public function getTotalActiveTutors(): int
    {
        return $this->repository->getTotalActiveTutors();
    }

    public function getHighestPaidSubject(): ?string
    {
        return $this->repository->getHighestPaidSubject()->subjects[0] ?? null;
    }

    public function getAverageHourlyRate(): float
    {
        return (float) number_format($this->repository->getAverageHourlyRate(), 2);
    }

    /**
     * @throws \Exception
     */
    public function updateHourlyRates(Collection $records, int $percentage, string $type): string
    {
        DB::beginTransaction();
        try {
            $logItems = [];
            $records->map(function ($item) use ($percentage, $type, &$logItems) {
                $newHourlyRate = number_format($this->calculateNewRate($percentage, $type, $item), 2);

                $logItems[] = [
                    'tutor_id' => $item->id,
                    'old_hourly_rate' => $item->hourly_rate,
                    'new_hourly_rate' => $newHourlyRate,
                ];

                $item->hourly_rate = $newHourlyRate;
                $item->save();

                return $item;
            });

            $this->tutorRateChangeRepository->bulkCreate($logItems);
            DB::commit();

            return 'Successfully updated hourly rates.';
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception('There was an error updating the hourly rates.');
        }
    }

    public function getMaxRateTutor(): int|float
    {
        return $this->repository->getMaxRateTutor()?->hourly_rate ?? 0;
    }

    public function searchTutors(array $data = []): \Illuminate\Support\Collection
    {
        return $this->repository->getTutorsBySearchFilter($data);
    }

    private function calculateNewRate(int $percentage, string $type, Model $item): float|int
    {
        $percentageValue = ($item->hourly_rate) * ($percentage / 100);

        return $type == 'increase' ? $item->hourly_rate + $percentageValue : $item->hourly_rate - $percentageValue;
    }
}
