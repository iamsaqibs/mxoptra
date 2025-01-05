<?php

use App\Http\Controllers\API\ConsignmentController;
use App\Http\Controllers\API\LoadingController;
use App\Http\Controllers\API\TrackingController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\DriverController;
use App\Http\Controllers\API\RunController;
use App\Http\Controllers\API\VehicleController;
use App\Http\Controllers\API\PodController;
use App\Http\Controllers\API\DistributionCenterController;
use Illuminate\Support\Facades\Route;

// API Version prefix
Route::prefix('v1')->group(function () {
    // Tracking routes
    Route::prefix('tracking')->group(function () {
        // Order tracking
        Route::get('orders/{orderId}', [TrackingController::class, 'getOrderTracking']);
        Route::put('orders/{orderId}', [TrackingController::class, 'updateOrderTracking']);
        Route::get('orders/{orderId}/history', [TrackingController::class, 'getOrderTrackingHistory']);

        // Vehicle tracking
        Route::get('vehicles/{vehicleId}', [TrackingController::class, 'getVehicleTracking']);
        Route::put('vehicles/{vehicleId}', [TrackingController::class, 'updateVehicleTracking']);
        Route::get('vehicles/{vehicleId}/history', [TrackingController::class, 'getVehicleTrackingHistory']);
    });

    // Loading routes
    Route::prefix('loading')->group(function () {
        Route::get('{type}/{id}', [LoadingController::class, 'getLoadingStatus']);
        Route::put('{type}/{id}', [LoadingController::class, 'updateLoadingStatus']);
        Route::post('{type}/{id}/start', [LoadingController::class, 'startLoading']);
        Route::post('{type}/{id}/complete', [LoadingController::class, 'completeLoading']);
        Route::get('{type}/{id}/history', [LoadingController::class, 'getLoadingHistory']);
    });

    // Consignment routes
    Route::prefix('consignments')->group(function () {
        Route::get('{referenceNumber}', [ConsignmentController::class, 'getConsignment']);
        Route::post('/', [ConsignmentController::class, 'createConsignment']);
        Route::put('{referenceNumber}/status', [ConsignmentController::class, 'updateConsignmentStatus']);
        Route::get('by-order/{orderId}', [ConsignmentController::class, 'getConsignmentsByOrder']);
        Route::get('{referenceNumber}/history', [ConsignmentController::class, 'getConsignmentHistory']);
    });

    // Order routes
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('{id}', [OrderController::class, 'show']);
        Route::put('{id}', [OrderController::class, 'update']);
        Route::delete('{id}', [OrderController::class, 'destroy']);
        Route::get('{id}/execution', [OrderController::class, 'getExecutionDetails']);
        Route::get('{id}/items', [OrderController::class, 'getItems']);
        Route::get('{id}/pod', [OrderController::class, 'getPodDetails']);
        Route::get('{id}/widget', [OrderController::class, 'getWidgetInfo']);
    });

    // Driver routes
    Route::prefix('drivers')->group(function () {
        Route::get('/', [DriverController::class, 'index']);
        Route::post('/', [DriverController::class, 'store']);
        Route::get('{id}', [DriverController::class, 'show']);
        Route::put('{id}', [DriverController::class, 'update']);
        Route::patch('{id}', [DriverController::class, 'updatePartial']);
        Route::delete('{id}', [DriverController::class, 'destroy']);
        Route::get('{id}/schedule', [DriverController::class, 'getSchedule']);
    });

    // Run routes
    Route::prefix('runs')->group(function () {
        Route::get('/', [RunController::class, 'index']);
        Route::post('/', [RunController::class, 'store']);
        Route::get('{id}', [RunController::class, 'show']);
        Route::put('{id}', [RunController::class, 'update']);
        Route::delete('{id}', [RunController::class, 'destroy']);
        Route::get('{id}/schedule', [RunController::class, 'getSchedule']);
        Route::get('{id}/orders', [RunController::class, 'getOrders']);
        Route::post('{id}/orders/{orderId}', [RunController::class, 'addOrder']);
        Route::delete('{id}/orders/{orderId}', [RunController::class, 'removeOrder']);
    });

    // Vehicle routes
    Route::prefix('vehicles')->group(function () {
        Route::get('/', [VehicleController::class, 'index']);
        Route::post('/', [VehicleController::class, 'store']);
        Route::get('{id}', [VehicleController::class, 'show']);
        Route::put('{id}', [VehicleController::class, 'update']);
        Route::patch('{id}', [VehicleController::class, 'updatePartial']);
        Route::delete('{id}', [VehicleController::class, 'destroy']);
        Route::get('{id}/schedule', [VehicleController::class, 'getSchedule']);
    });

    // POD routes
    Route::prefix('pods')->group(function () {
        Route::get('orders/{orderId}', [PodController::class, 'show']);
        Route::post('orders/{orderId}', [PodController::class, 'store']);
        Route::put('orders/{orderId}', [PodController::class, 'update']);
        Route::post('orders/{orderId}/photos', [PodController::class, 'uploadPhoto']);
        Route::delete('orders/{orderId}/photos/{photoId}', [PodController::class, 'deletePhoto']);
        Route::post('orders/{orderId}/notes', [PodController::class, 'addNote']);
        Route::get('orders/{orderId}/history', [PodController::class, 'getHistory']);
    });

    // Distribution Center routes
    Route::prefix('distribution-centers')->group(function () {
        Route::get('/', [DistributionCenterController::class, 'index']);
        Route::post('/', [DistributionCenterController::class, 'store']);
        Route::get('{id}', [DistributionCenterController::class, 'show']);
        Route::put('{id}', [DistributionCenterController::class, 'update']);
        Route::delete('{id}', [DistributionCenterController::class, 'destroy']);
        Route::get('{id}/schedule', [DistributionCenterController::class, 'getSchedule']);
        Route::get('{id}/capacity', [DistributionCenterController::class, 'getCapacity']);
        Route::get('{id}/workload', [DistributionCenterController::class, 'getWorkload']);
    });
});
