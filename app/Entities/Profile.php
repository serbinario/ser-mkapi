<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mk_profiles';

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
                  'nome',
                  'local_address',
                  'pool_id',
                  'dns1_server',
                  'dns2_server',
                  'rate_limit_tx_tx',
                  'queue_parent',
                  'queue_type',
                  'script_on_up',
                  'script_on_down',
                  'is_ativo',
        'descricao',
        'valor'

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
     * Get the pool for this model.
     */
    public function pool()
    {
        return $this->belongsTo('Serbinario\Entities\Pool','pool_id');
    }

    /**
     * Get the routers for this model.
     */
    public function routers()
    {
        return $this->belongsToMany('Serbinario\Entities\Router','mk_profiles_mk_routes', 'mk_profile_id', 'mk_router_id');
    }

    public function getRoutersListAttribute($value)
    {
        return $this->routers->pluck('id')->all();
    }

    /**
     * Set the data_final.
     *
     * @param  string  $value
     * @return void
     */
    public function setValorAttribute($value)
    {
        if(!$value == null){
            $value = str_replace(".","",$value);
            $value = str_replace(",",".",$value);
            $this->attributes['valor'] =  $value;
        }
    }

    /**
     * Set the data_final.
     *
     * @param  string  $value
     * @return void
     */
    public function getValorAttribute($value)
    {
        if(!$value == null){
            return str_replace(".",",",$value);


        }
    }




}
