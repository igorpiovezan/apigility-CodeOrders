<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/09/2015
 * Time: 10:51
 */

namespace CodeOrders\src\CodeOrders\V1\Rest\Orders;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class OrderItemTableGatewayFactory implements FactoryInterface
{


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // TODO: Implement createService() method.

        $dbAdapter = $serviceLocator->get('DbAdapter');

        $hydrator = new HydratingResultSet(new ClassMethods(), new OrderItemEntity());

        $tableGateway = new TableGateway('order_items', $dbAdapter, null, $hydrator);

        return $tableGateway;

    }
}