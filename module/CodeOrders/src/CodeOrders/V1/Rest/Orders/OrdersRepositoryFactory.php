<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/09/2015
 * Time: 11:01
 */

namespace CodeOrders\src\CodeOrders\V1\Rest\Orders;


use CodeOrders\V1\Rest\Orders\OrdersEntity;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class OrdersRepositoryFactory implements FactoryInterface
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
        $hydrator = new HydratingResultSet(new ClassMethods(), new OrdersEntity());

        $tableGateway = new TableGateway('orders', $dbAdpter, null, $hydrator);

        $orderItemTableGateway = $serviceLocator->get('CodeOrders\\V1\\Rest\\Orders\\OrderItemTableGateway');

        $ordersRepository = new OrdersRepository($tableGateway, $orderItemTableGateway);

        return $ordersRepository;
    }

}