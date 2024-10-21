<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type',
        'license_plate',
        'driver_name',
        'status',
    ];

    const STATUS_AVAILABLE = 'Available';
    const STATUS_UNAVAILABLE = 'Unavailable';

    public static function getStatuses()
    {
        return [
            self::STATUS_AVAILABLE,
            self::STATUS_UNAVAILABLE,
        ];
    }

    public static function isValidStatus($status)
    {
        return in_array($status, self::getStatuses());
    }

    // Relation avec Delivery (One-to-Many)
    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
