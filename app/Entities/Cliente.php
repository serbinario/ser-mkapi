<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
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
    protected $table = 'mk_clientes';

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
        'login',
        'senha',
        'email',
        'tipo',
        'cpf',
        'rg',
        'cnpj',
        'ins_estadual',
        'cliente_id',
        'cliente_type',
        'data_nascimento',
        'phone01',
        'phone02',
        'cep',
        'logradouro',
        'complemanto',
        'bairro',
        'cidade',
        'data_instalacao',
        'grupo_id',
        'router_id',
        'profile_id',
        'tipo_autenticacao',
        'ip_pppoe',
        'ip_hotspot',
        'mac',
        'vencimento_dia_id',
        'dias_bloqueio',
        'dias_msg_pendencia',
        'inseto_mensalidade',
        'mensalidade_automatica',
        'msg_bloqueio_automatica',
        'msg_pendencia_automatica',
        'perm_alter_senha',
        'desconto_mensalidade',
        'desconto_mensali_ate_venci',
        'is_ativo',
        'obs',
        'clienteable_id',
        'clienteable_type'
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
    public function mkRouter()
    {
        return $this->belongsTo('Serbinario\Entities\Router','router_id','id');
    }

    /**
     * Get the mkProfile for this model.
     */
    public function mkProfile()
    {
        return $this->belongsTo('Serbinario\Entities\Profile','profile_id','id');
    }

    /**
     * Get the mkVencimentoDium for this model.
     */
    public function mkVencimentoDium()
    {
        return $this->belongsTo('Serbinario\Entities\VencimentoDia','vencimento_dia_id','id');
    }

    /**
     * Get the mkProfile for this model.
     */
    public function mkGrupo()
    {
        return $this->belongsTo('Serbinario\Entities\Grupo','grupo_id','id');
    }


    /*public function getDataInstalacaoAttribute($value)
    {
        return date("d/m/Y", strtotime($value));
    }


    public function setDataInstalacaoAttribute($value)
    {
        if($value){
            return $this->attributes['data_instalacao'] = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }*/

    public function getDataNascimentoAttribute($value)
    {
        return date("d/m/Y", strtotime($value));
    }

    public function setDataNascimentoAttribute($value)
    {
        if($value){
            return $this->attributes['data_nascimento'] = substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }

    public function clienteable()
    {
        return $this->morphTo('','');
    }



}
