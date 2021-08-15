<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RejaBeshdarboyan extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'reja_beshdarboyans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'leq_id',
        'lijna_id',
        'bingeh_id',
        'demjimer',
        'jimara_beshdarboyan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function leq()
    {
        return $this->belongsTo(Leq::class, 'leq_id');
    }

    public function lijna()
    {
        return $this->belongsTo(Lijna::class, 'lijna_id');
    }

    public function bingeh()
    {
        return $this->belongsTo(Bingeh::class, 'bingeh_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
