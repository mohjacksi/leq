<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lijna extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'lijnas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'lijna_code',
        'leq_id',
        'jimara_dengderan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lijnaRekxraws()
    {
        return $this->hasMany(Rekxraw::class, 'lijna_id', 'id');
    }

    public function lijnaHnartnaDengans()
    {
        return $this->hasMany(HnartnaDengan::class, 'lijna_id', 'id');
    }

    public function leq()
    {
        return $this->belongsTo(Leq::class, 'leq_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
