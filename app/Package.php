<?php

namespace App;

use App\Interfaces\ModelInterface;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Package extends Model implements ModelInterface, TranslatableContract
{
    use Translatable;

    protected $guarded = ['_token','locale', '_method'];

    public $translatedAttributes = ['title', 'tag_line', 'description'];
    protected $fillable = ['trip_start_date_time', 'trip_end_date_time', 'price_per_head'];

    public function getTripStartDateTimeAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getTripEndDateTimeAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setTripStartDateTimeAttribute($value){
        $this->attributes['trip_start_date_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setTripEndDateTimeAttribute($value){
        $this->attributes['trip_end_date_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * Get all of the images for the package.
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imagable');
    }

    public function features(){
        return $this->belongsToMany(Feature::class, 'feature_package_pivot', 'package_id','feature_id');
    }

    public function package_include(){
        return $this->belongsToMany(PackageInclude::class, 'package_include_pivot', 'package_id','package_include_id');
    }

    public function itineraries(){
        return $this->belongsToMany(Itinerary::class, 'itinerary_package_pivot', 'package_id','itinerary_id');
    }


}
