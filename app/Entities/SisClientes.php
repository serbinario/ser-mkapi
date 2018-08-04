<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class SisClientes extends Model
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
    protected $table = 'sis_cliente';

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
        'endereco',
        'bairro',
        'cidade',
        'cep',
        'fone',
        'login',
        'celular',
        'senha',
        'data_ins',
        'cpf_cnpj'
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




}
