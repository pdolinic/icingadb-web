<?php

namespace Icinga\Module\Icingadb\Model;

use ipl\Orm\Model;
use ipl\Orm\Relations;

class HostCustomvar extends Model
{
    public function getTableName()
    {
        return 'host_customvar';
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getColumns()
    {
        return [
            'host_id',
            'customvar_id',
            'environment_id'
        ];
    }

    public function createRelations(Relations $relations)
    {
        $relations->belongsTo('environment', Environment::class);
        $relations->belongsTo('host', Host::class);
        $relations->belongsTo('customvar', Customvar::class);
        $relations->belongsTo('customvar_flat', CustomvarFlat::class)
            ->setForeignKey('customvar_id')
            ->setCandidateKey('customvar_id');
    }
}
