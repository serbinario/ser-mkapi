<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Debitos extends Model
{
    

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
                  'numero_cobranca',
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
                  'status'
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
     * Get the mkCliente for this model.
     */
    public function mkCliente()
    {
        return $this->belongsTo('Serbinario\Entities\Cliente','mk_cliente_id','id');
    }

    /**
     * Get the finContasBancaria for this model.
     */
    public function finContasBancaria()
    {
        return $this->belongsTo('Serbinario\Entities\FinContasBancaria','conta_bancaria_id','id');
    }

    /**
     * Get the finFormasPagamento for this model.
     */
    public function finFormasPagamento()
    {
        return $this->belongsTo('Serbinario\Entities\FinFormasPagamento','forma_pagamento_id','id');
    }

    /**
     * Get the finCarne for this model.
     */
    public function finCarne()
    {
        return $this->belongsTo('Serbinario\Entities\FinCarne','carne_id','id');
    }

    /**
     * Get the finLocaisPagamento for this model.
     */
    public function finLocaisPagamento()
    {
        return $this->belongsTo('Serbinario\Entities\FinLocaisPagamento','local_pagamento_id','id');
    }

    /**
     * Get the finBoleto for this model.
     */
    public function finBoleto()
    {
        return $this->hasOne('Serbinario\Entities\FinBoleto','debito_id','id');
    }

    /**
     * Get the finExtrato for this model.
     */
    public function finExtrato()
    {
        return $this->hasOne('Serbinario\Entities\FinExtrato','debito_id','id');
    }

    /**
     * Set the data_vencimento.
     *
     * @param  string  $value
     * @return void
     */
    public function setDataVencimentoAttribute($value)
    {
        $this->attributes['data_vencimento'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Set the data_pagamento.
     *
     * @param  string  $value
     * @return void
     */
    public function setDataPagamentoAttribute($value)
    {
        $this->attributes['data_pagamento'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get data_vencimento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataVencimentoAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get data_pagamento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDataPagamentoAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

}
