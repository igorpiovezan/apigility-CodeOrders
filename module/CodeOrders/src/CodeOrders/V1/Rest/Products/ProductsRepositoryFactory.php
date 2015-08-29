<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 29/08/2015
 * Time: 18:12
 */

namespace CodeOrders\V1\Rest\Products;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ProductsRepositoryFactory implements FactoryInterface
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
        $hydrator = new HydratingResultSet(new ClassMethods(), new ProductsEntity());

        $tableGateway = new TableGateway('products', $dbAdpter, null, $hydrator);

        $productsRepository = new ProductsRepository($tableGateway);

        return $productsRepository;
    }
}