<?php

namespace Icinga\Module\Icingadb\Controllers;

use Icinga\Module\Icingadb\Model\User;
use Icinga\Module\Icingadb\Web\Controller;
use Icinga\Module\Icingadb\Widget\ItemList\UserList;

class UsersController extends Controller
{
    public function indexAction()
    {
        $this->setTitle($this->translate('Users'));

        $db = $this->getDb();

        $users = User::on($db);

        $limitControl = $this->createLimitControl();
        $paginationControl = $this->createPaginationControl($users);
        $filterControl = $this->createFilterControl($users);

        $this->filter($users);

        yield $this->export($users);

        $this->addControl($paginationControl);
        $this->addControl($limitControl);
        $this->addControl($filterControl);

        $this->addContent(new UserList($users));
    }
}
