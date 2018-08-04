<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Debito extends Model
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
    protected $table = 'fin_debitos';

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
        'mk_cliente_id',
        'conta_bancaria_id',
        'valor_debito',
        'valor_pago',
        'valor_desconto',
        'data_vencimento',
        'data_pagamento',
        'pago',
        'forma_pagamento_id',
        'carne_id',
        'local_pagamento_id',
        'numero_cobranca',
        'status',
        'paymentToken'
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


    public function setDataPagamentoAttribute($value)
    {
        if($value){
            return $this->attributes['data_pagamento'] = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }



    public function setDataVencimentoAttribute($value)
    {
        if($value){
            return $this->attributes['data_vencimento'] = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }

    public function setValorDebitoAttribute($value)
    {
        if(!$value == null){
            $value = str_replace(".","",$value);
            $value = str_replace(",",".",$value);
            $this->attributes['valor_debito'] =  $value;
        }
    }

    public function setValorPagoAttribute($value)
    {
        if(!$value == null){
            $value = str_replace(",",".",$value);
            $this->attributes['valor_pago'] =  $value;
        }
    }







}
