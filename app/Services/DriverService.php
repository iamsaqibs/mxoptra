<?php

namespace App\Services;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class DriverService
{
    public function listDrivers(
        ?string $territoryId = null,
        ?string $status = null,
        ?bool $availability = null
    ): Collection {
        $query = Driver::query();

        if ($territoryId) {
            $query->where('territory_id', $territoryId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($availability !== null) {
            $query->where('is_available', $availability);
        }

        return $query->get();
    }

    public function createDriver(array $data): Driver
    {
        return Driver::create($data);
    }

    public function getDriver(string $id): Driver
    {
        return Driver::findOrFail($id);
    }

    public function updateDriver(string $id, array $data): Driver
    {
        $driver = $this->getDriver($id);
        $driver->update($data);
        return $driver;
    }

    public function updateDriverPartial(string $id, array $data): Driver
    {
        $driver = $this->getDriver($id);
        $driver->fill($data);
        $driver->save();
        return $driver;
    }

    public function deleteDriver(string $id): void
    {
        $driver = $this->getDriver($id);
        $driver->delete();
    }

    public function getDriverSchedule(string $id, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $driver = $this->getDriver($id);
        $query = $driver->runs()->with(['orders']);

        if ($dateFrom) {
            $query->where('start_time', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('end_time', '<=', $dateTo);
        }

        $runs = $query->get();

        return [
            'driver' => [
                'id' => $driver->id,
                'name' => $driver->name,
                'status' => $driver->status,
            ],
            'schedule' => $runs->map(function ($run) {
                return [
                    'run_id' => $run->id,
                    'start_time' => $run->start_time,
                    'end_time' => $run->end_time,
                    'status' => $run->status,
                    'orders_count' => $run->orders->count(),
                ];
            }),
        ];
    }
}
