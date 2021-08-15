<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Westgeh extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'westgehs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'westgeh_code',
        'jimara_dengderan',
        'bingeh_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function wistgehHnartnaDengans()
    {
        return $this->hasMany(HnartnaDengan::class, 'wistgeh_id', 'id');
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
