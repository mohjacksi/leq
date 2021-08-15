<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class HnartnaDengan extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'hnartna_dengans';

    protected $appends = [
        'wene',
    ];

    protected $dates = [
        'dem',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'dem',
        'leq_id',
        'lijna_id',
        'bingeh_id',
        'wistgeh_id',
        'hejmar',
        'tebini',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getDemAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDemAttribute($value)
    {
        $this->attributes['dem'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
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

    public function wistgeh()
    {
        return $this->belongsTo(Westgeh::class, 'wistgeh_id');
    }

    public function getWeneAttribute()
    {
        $files = $this->getMedia('wene');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
