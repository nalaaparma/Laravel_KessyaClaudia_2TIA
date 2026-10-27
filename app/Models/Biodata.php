<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'biodata_6';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'alamat',
        'pendidikan',
        'keahlian',
        'deskripsi',
        'foto',
    ];
}
