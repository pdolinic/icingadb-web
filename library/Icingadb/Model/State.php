<?php

namespace Icinga\Module\Icingadb\Model;

use Icinga\Module\Icingadb\Model\Behavior\BoolCast;
use Icinga\Module\Icingadb\Model\Behavior\Timestamp;
use Icinga\Module\Icingadb\Model\Behavior\VolatileState;
use ipl\Orm\Behaviors;
use ipl\Orm\Model;

/**
 * Base class for the {@link HostState} and {@link ServiceState} models providing common columns.
 */
abstract class State extends Model
{
    protected $accessorsAndMutatorsEnabled = true;

    public function getColumns()
    {
        return [
            'environment_id',
            'state_type',
            'soft_state',
            'hard_state',
            'attempt',
            'severity',
            'output',
            'long_output',
            'performance_data',
            'check_commandline',
            'is_problem',
            'is_handled',
            'is_reachable',
            'is_flapping',
            'is_acknowledged',
            'acknowledgement_comment_id',
            'in_downtime',
            'execution_time',
            'latency',
            'timeout',
            'last_update',
            'last_state_change',
            'last_soft_state',
            'last_hard_state',
            'next_check',
            'next_update'
        ];
    }

    public function createBehaviors(Behaviors $behaviors)
    {
        $behaviors->add(new VolatileState());
        $behaviors->add(new BoolCast([
            'is_problem',
            'is_handled',
            'is_reachable',
            'is_flapping',
            'is_acknowledged',
            'in_downtime'
        ]));
        $behaviors->add(new Timestamp([
            'last_update',
            'last_state_change',
            'last_soft_state',
            'last_hard_state',
            'next_check',
            'next_update'
        ]));
    }

    public function mutateIsOverdueProperty()
    {
        return $this->properties['next_update'] < time();
    }
}
