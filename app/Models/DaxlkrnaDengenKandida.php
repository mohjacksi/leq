<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class DaxlkrnaDengenKandida extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'daxlkrna_dengen_kandidas';

    protected $appends = [
        'weene',
        'file',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'leq_id',
        'lijna_id',
        'bingeh_id',
        'westgeh_id',
        'layenesiyasi_id',
        'jimara_kandidi_id',
        'jimara_dengan',
        'extra_1',
        'extra_2',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

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

    public function westgeh()
    {
        return $this->belongsTo(Westgeh::class, 'westgeh_id');
    }

    public function layenesiyasi()
    {
        return $this->belongsTo(Layenetsiyasi::class, 'layenesiyasi_id');
    }

    public function jimara_kandidi()
    {
        return $this->belongsTo(Kandid::class, 'jimara_kandidi_id');
    }

    public function getWeeneAttribute()
    {
        $files = $this->getMedia('weene');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
