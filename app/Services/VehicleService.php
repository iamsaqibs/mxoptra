<?php

namespace App\Services;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class VehicleService
{
    public function listVehicles(
        ?string $territoryId = null,
        ?string $status = null,
        ?string $type = null
    ): Collection {
        $query = Vehicle::query();

        if ($territoryId) {
            $query->where('territory_id', $territoryId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($type) {
            $query->where('type', $type);
        }

        return $query->get();
    }

    public function createVehicle(array $data): Vehicle
    {
        return Vehicle::create($data);
    }

    public function getVehicle(string $id): Vehicle
    {
        return Vehicle::findOrFail($id);
    }

    public function updateVehicle(string $id, array $data): Vehicle
    {
        $vehicle = $this->getVehicle($id);
        $vehicle->update($data);
        return $vehicle;
    }

    public function updateVehiclePartial(string $id, array $data): Vehicle
    {
        $vehicle = $this->getVehicle($id);
        $vehicle->fill($data);
        $vehicle->save();
        return $vehicle;
    }

    public function deleteVehicle(string $id): void
    {
        $vehicle = $this->getVehicle($id);
        $vehicle->delete();
    }

    public function getVehicleSchedule(string $id, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $vehicle = $this->getVehicle($id);
        $query = $vehicle->runs()->with(['orders']);

        if ($dateFrom) {
            $query->where('start_time', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('end_time', '<=', $dateTo);
        }

        $runs = $query->get();

        return [
            'vehicle' => [
                'id' => $vehicle->id,
                'reference_number' => $vehicle->reference_number,
                'status' => $vehicle->status,
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
