<?php

namespace App\Services;

use App\Models\DistributionCenter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class DistributionCenterService
{
    public function listDistributionCenters(
        ?string $territoryId = null,
        ?string $status = null
    ): Collection {
        $query = DistributionCenter::query();

        if ($territoryId) {
            $query->where('territory_id', $territoryId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }

    public function createDistributionCenter(array $data): DistributionCenter
    {
        return DistributionCenter::create($data);
    }

    public function getDistributionCenter(string $id): DistributionCenter
    {
        return DistributionCenter::findOrFail($id);
    }

    public function updateDistributionCenter(string $id, array $data): DistributionCenter
    {
        $center = $this->getDistributionCenter($id);
        $center->update($data);
        return $center;
    }

    public function deleteDistributionCenter(string $id): void
    {
        $center = $this->getDistributionCenter($id);
        $center->delete();
    }

    public function getDistributionCenterSchedule(string $id, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $center = $this->getDistributionCenter($id);
        $query = $center->runs()->with(['orders', 'driver', 'vehicle']);

        if ($dateFrom) {
            $query->where('start_time', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('end_time', '<=', $dateTo);
        }

        $runs = $query->get();

        return [
            'distribution_center' => [
                'id' => $center->id,
                'name' => $center->name,
                'status' => $center->status,
            ],
            'schedule' => $runs->map(function ($run) {
                return [
                    'run_id' => $run->id,
                    'start_time' => $run->start_time,
                    'end_time' => $run->end_time,
                    'status' => $run->status,
                    'driver' => $run->driver,
                    'vehicle' => $run->vehicle,
                    'orders_count' => $run->orders->count(),
                ];
            }),
        ];
    }

    public function getDistributionCenterCapacity(string $id, ?string $date = null): array
    {
        $center = $this->getDistributionCenter($id);
        $date = $date ?? now()->toDateString();

        $runs = $center->runs()
            ->whereDate('start_time', $date)
            ->with(['orders', 'vehicle'])
            ->get();

        $totalCapacity = [
            'weight' => 0,
            'volume' => 0,
            'pallets' => 0,
        ];

        $usedCapacity = [
            'weight' => 0,
            'volume' => 0,
            'pallets' => 0,
        ];

        foreach ($runs as $run) {
            if ($run->vehicle) {
                $totalCapacity['weight'] += $run->vehicle->capacity['weight'] ?? 0;
                $totalCapacity['volume'] += $run->vehicle->capacity['volume'] ?? 0;
                $totalCapacity['pallets'] += $run->vehicle->capacity['pallets'] ?? 0;
            }

            foreach ($run->orders as $order) {
                $usedCapacity['weight'] += $order->total_weight ?? 0;
                $usedCapacity['volume'] += $order->total_volume ?? 0;
                $usedCapacity['pallets'] += $order->total_pallets ?? 0;
            }
        }

        return [
            'date' => $date,
            'total_capacity' => $totalCapacity,
            'used_capacity' => $usedCapacity,
            'available_capacity' => [
                'weight' => $totalCapacity['weight'] - $usedCapacity['weight'],
                'volume' => $totalCapacity['volume'] - $usedCapacity['volume'],
                'pallets' => $totalCapacity['pallets'] - $usedCapacity['pallets'],
            ],
            'utilization_percentage' => [
                'weight' => $totalCapacity['weight'] > 0 ? ($usedCapacity['weight'] / $totalCapacity['weight']) * 100 : 0,
                'volume' => $totalCapacity['volume'] > 0 ? ($usedCapacity['volume'] / $totalCapacity['volume']) * 100 : 0,
                'pallets' => $totalCapacity['pallets'] > 0 ? ($usedCapacity['pallets'] / $totalCapacity['pallets']) * 100 : 0,
            ],
        ];
    }

    public function getDistributionCenterWorkload(string $id, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $center = $this->getDistributionCenter($id);
        $dateFrom = $dateFrom ?? now()->toDateString();
        $dateTo = $dateTo ?? now()->addDays(7)->toDateString();

        $runs = $center->runs()
            ->whereBetween('start_time', [$dateFrom, $dateTo])
            ->with(['orders', 'driver', 'vehicle'])
            ->get()
            ->groupBy(function ($run) {
                return $run->start_time->format('Y-m-d');
            });

        $workload = [];

        foreach ($runs as $date => $dateRuns) {
            $workload[$date] = [
                'total_runs' => $dateRuns->count(),
                'total_orders' => $dateRuns->sum(function ($run) {
                    return $run->orders->count();
                }),
                'total_drivers' => $dateRuns->unique('driver_id')->count(),
                'total_vehicles' => $dateRuns->unique('vehicle_id')->count(),
                'status_breakdown' => $dateRuns->groupBy('status')
                    ->map(function ($statusRuns) {
                        return $statusRuns->count();
                    }),
                'hourly_distribution' => $dateRuns
                    ->groupBy(function ($run) {
                        return $run->start_time->format('H');
                    })
                    ->map(function ($hourRuns) {
                        return $hourRuns->count();
                    }),
            ];
        }

        return [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'distribution_center' => [
                'id' => $center->id,
                'name' => $center->name,
                'status' => $center->status,
            ],
            'workload' => $workload,
        ];
    }
}
