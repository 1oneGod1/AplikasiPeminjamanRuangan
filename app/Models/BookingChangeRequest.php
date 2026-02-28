<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingChangeRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'booking_id',
        'requested_by',
        'type',
        'reason',
        'status',
        'admin_note',
        'handled_by',
        'handled_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'handled_at' => 'datetime',
        ];
    }

    /**
     * Request type constants.
     */
    public const TYPE_EDIT = 'edit';
    public const TYPE_CANCEL = 'cancel';

    /**
     * Status constants.
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_COMPLETED = 'completed';

    /**
     * Relationship: change request belongs to booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Relationship: change request belongs to requester (user).
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    /**
     * Relationship: change request handled by admin user (optional).
     */
    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    /**
     * Scope: only pending requests.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Check if request is pending.
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if request is for edit.
     */
    public function isEditRequest(): bool
    {
        return $this->type === self::TYPE_EDIT;
    }

    /**
     * Check if request is for cancellation.
     */
    public function isCancellationRequest(): bool
    {
        return $this->type === self::TYPE_CANCEL;
    }
}
