<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Layenetsiyasi extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;
    use Auditable;

    public $table = 'layenetsiyasis';

    protected $appends = [
        'ala',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'code_siyasi',
        'jimara_kandida',
        'extra',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function layeneSiyasiKandids()
    {
        return $this->hasMany(Kandid::class, 'layene_siyasi_id', 'id');
    }

    public function layeneSiyasiDengenLayenetsiyasis()
    {
        return $this->hasMany(DengenLayenetsiyasi::class, 'layene_siyasi_id', 'id');
    }

    public function layeneSiyasiLeqs()
    {
        return $this->hasMany(Leq::class, 'layene_siyasi_id', 'id');
    }

    public function getAlaAttribute()
    {
        $files = $this->getMedia('ala');
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
