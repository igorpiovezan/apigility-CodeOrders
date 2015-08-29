<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 23/08/2015
 * Time: 13:20
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class UsersRepositoryFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $dbAdpter = $serviceLocator->get('DbAdapter');
        //$usersMapper = new UsersMapper();
        $hydrator = new HydratingResultSet(new ClassMethods(), new UsersEntity());

        $tableGateway = new TableGateway('oauth_users', $dbAdpter, null, $hydrator);

        $userRepository = new UserRepository($tableGateway);

        return $userRepository;

    }
}