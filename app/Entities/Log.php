<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
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
    protected $table = 'SystemEvents';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'ID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'CustomerID',
                  'ReceivedAt',
                  'DeviceReportedTime',
                  'Facility',
                  'Priority',
                  'FromHost',
                  'Message',
                  'NTSeverity',
                  'Importance',
                  'EventSource',
                  'EventUser',
                  'EventCategory',
                  'EventID',
                  'EventBinaryData',
                  'MaxAvailable',
                  'CurrUsage',
                  'MinUsage',
                  'MaxUsage',
                  'InfoUnitID',
                  'SysLogTag',
                  'EventLogType',
                  'GenericFileName',
                  'SystemID'
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
