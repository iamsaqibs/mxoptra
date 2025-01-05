<?php

namespace App\Services;

use App\Models\Pod;
use App\Models\Order;
use App\Models\PodPhoto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class PodService
{
    public function getPod(string $orderId): Pod
    {
        $order = Order::findOrFail($orderId);
        return $order->pod()->firstOrFail();
    }

    public function createPod(string $orderId, array $data): Pod
    {
        $order = Order::findOrFail($orderId);

        return $order->pod()->create([
            'signature' => $data['signature'] ?? null,
            'signature_timestamp' => $data['signature_timestamp'] ?? now(),
            'signed_by' => $data['signed_by'] ?? null,
            'notes' => $data['notes'] ?? null,
            'status' => $data['status'] ?? 'PENDING',
            'metadata' => $data['metadata'] ?? [],
        ]);
    }

    public function updatePod(string $orderId, array $data): Pod
    {
        $pod = $this->getPod($orderId);
        $pod->update($data);
        return $pod;
    }

    public function uploadPodPhoto(string $orderId, UploadedFile $photo, ?string $description = null): Pod
    {
        $pod = $this->getPod($orderId);

        $path = $photo->store('pod_photos/' . $orderId, 'public');

        $pod->photos()->create([
            'path' => $path,
            'description' => $description,
            'uploaded_at' => now(),
            'metadata' => [],
        ]);

        return $pod->fresh('photos');
    }

    public function deletePodPhoto(string $orderId, string $photoId): void
    {
        $pod = $this->getPod($orderId);
        $photo = $pod->photos()->findOrFail($photoId);

        Storage::disk('public')->delete($photo->path);
        $photo->delete();
    }

    public function addPodNote(string $orderId, string $note): Pod
    {
        $pod = $this->getPod($orderId);

        $currentNotes = $pod->notes ?? [];
        $currentNotes[] = [
            'note' => $note,
            'created_at' => now()->toIso8601String(),
            'user_id' => auth()->id(),
        ];

        $pod->update(['notes' => $currentNotes]);
        return $pod;
    }

    public function getPodHistory(string $orderId): array
    {
        $pod = $this->getPod($orderId);

        return [
            'pod_id' => $pod->id,
            'order_id' => $orderId,
            'status_history' => $pod->status_history ?? [],
            'signature_history' => $pod->signature_history ?? [],
            'photo_history' => $pod->photos()
                ->orderBy('uploaded_at', 'desc')
                ->get()
                ->map(function ($photo) {
                    return [
                        'id' => $photo->id,
                        'path' => $photo->path,
                        'description' => $photo->description,
                        'uploaded_at' => $photo->uploaded_at,
                    ];
                }),
            'notes_history' => $pod->notes ?? [],
        ];
    }
}
