<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalAppointment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['date', 'status', 'doctor_id', 'patient_id'];

    protected $searchableFields = ['*'];

    protected $table = 'medical_appointments';

    protected $casts = [
        'date' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
