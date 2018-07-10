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
        'nome',
        'numero_cobranca',
        'valor',
        'status',
        'identificador',
        'data_vencimento',
        'valor_pago',
        'data_pagamento'
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
     * Get the mkRouter for this model.
     */

    /**


    /**
     * Get the mkProfile for this model.
     */



    public function getDataInstalacaoAttribute($value)
    {
        return date("d/m/Y", strtotime($value));
    }
    public function setDataPagamentoAttribute($value)
    {
        if($value){
            return $this->attributes['data_pagamento'] = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }

    public function getDataNascimentoAttribute($value)
    {
        return date("d/m/Y", strtotime($value));
    }

    public function setDataVencimentoAttribute($value)
    {
        if($value){
            return $this->attributes['data_vencimento'] = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }





}
