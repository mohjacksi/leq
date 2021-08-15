<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekxraw extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'rekxraws';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'code_rekxraw',
        'lijna_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lijna()
    {
        return $this->belongsTo(Lijna::class, 'lijna_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
