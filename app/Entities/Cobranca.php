<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Cobranca extends Model
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
    protected $table = 'cobrancas';

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
                  'numero_cobranca',
                  'valor',
                  'status',
                  'identificador',
                  'nome',
                  'data_vencimento',
                  'valor_pago',
                  'data_pagamento',
                  'login',
                  'link_pagamento',
        'obs',
        'data_envio'
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
     * Set the data_vencimento.
     *
     * @param  string  $value
     * @return void
     */
    public function setDataVencimentoAttribute($value)
    {
        if($value){
            return $this->attributes['data_vencimento'] = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }

    /**
     * Set the data_pagamento.
     *
     * @param  string  $value
     * @return void
     */
    public function setDataPagamentoAttribute($value)
    {
        if($value){
            return $this->attributes['data_pagamento'] = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataVencimentoAttribute($value)
    {
        return date('j/n/Y', strtotime($value));
    }

    /**
     * Get data_pagamento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataPagamentoAttribute($value)
    {
        return date('j/n/Y', strtotime($value));
    }

}
