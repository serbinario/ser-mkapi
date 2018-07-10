<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'test';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'name',
                  'sports'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    

    /**
     * Set the sports.
     *
     * @param  string  $value
     * @return void
     */
    public function setSportsAttribute($value)
    {
        $this->attributes['sports'] = json_encode($value);
    }

    /**
     * Get sports in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getSportsAttribute($value)
    {
        return json_decode($value) ?: [];
    }

}
