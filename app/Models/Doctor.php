<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'document_nro',
        'first_name',
        'last_name',
        'email',
        'phone',
        'specialty_id',
    ];

    protected $searchableFields = ['*'];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function medicalAppointments()
    {
        return $this->hasMany(MedicalAppointment::class);
    }
}
