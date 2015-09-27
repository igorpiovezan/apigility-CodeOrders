<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/09/2015
 * Time: 16:56
 */

namespace CodeOrders\src\CodeOrders\V1\Rest\Orders;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OrdersServiceFactory implements FactoryInterface
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

        $orderRepository = $serviceLocator - get('CodeOrders\\V1\\Rest\\Orders\\OrdersRepository');

        return new OrdersService($orderRepository);

    }
}