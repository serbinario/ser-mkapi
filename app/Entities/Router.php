<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
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
    protected $table = 'mk_routers';

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
                  'ip_address',
                  'port',
                  'username',
                  'password',
                  'descricao',
                  'is_ativo'
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
     * Get the mkProfilesMkRoute for this model.
     */
    public function mkProfilesMkRoute()
    {
        return $this->hasOne('Serbinario\Entities\MkProfilesMkRoute','mk_router_id','id');
    }




}
