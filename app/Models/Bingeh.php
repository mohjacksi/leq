<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bingeh extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'bingehs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'bingeh_code',
        'jimara_dengderan',
        'lijna_id',
        'rekxraw_id',
        'jimara_rekxistiya',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bingehHnartnaDengans()
    {
        return $this->hasMany(HnartnaDengan::class, 'bingeh_id', 'id');
    }

    public function bingehDaxlkrnaDengenKandidas()
    {
        return $this->hasMany(DaxlkrnaDengenKandida::class, 'bingeh_id', 'id');
    }

    public function lijna()
    {
        return $this->belongsTo(Lijna::class, 'lijna_id');
    }

    public function rekxraw()
    {
        return $this->belongsTo(Rekxraw::class, 'rekxraw_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
