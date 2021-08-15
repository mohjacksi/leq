<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leq extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'leqs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'layene_siyasi_id',
        'name',
        'leq_code',
        'jimara_dengderan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function layene_siyasi()
    {
        return $this->belongsTo(Layenetsiyasi::class, 'layene_siyasi_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
