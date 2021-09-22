<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'document_nro',
        'first_name',
        'last_name',
        'email',
        'address',
        'phone',
        'gender',
        'birthday',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function medicalAppointments()
    {
        return $this->hasMany(MedicalAppointment::class);
    }
}