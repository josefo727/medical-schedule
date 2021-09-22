<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'record',
        'evaluation',
        'diagnosis',
        'recommendations',
        'medical_appointment_id',
    ];

    protected $searchableFields = ['*'];

    public function medicalAppointment()
    {
        return $this->belongsTo(MedicalAppointment::class);
    }
}
