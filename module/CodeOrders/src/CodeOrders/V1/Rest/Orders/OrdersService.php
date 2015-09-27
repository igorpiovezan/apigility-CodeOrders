<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/09/2015
 * Time: 16:55
 */

namespace CodeOrders\src\CodeOrders\V1\Rest\Orders;


use Zend\Stdlib\Hydrator\ObjectProperty;

class OrdersService
{
    /**
     * @var OrdersRepository
     */
    private $repository;


    /**
     * OrdersService constructor.
     */
    public function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
    }


    public function insert($data)
    {

        $hydrator = new ObjectProperty();
        $data = $hydrator->extract($data);

        $orderData = $data;

        unset($orderData['item']);

        $items = $data['item'];

        $tableGateway = $this->repository->getTableGateway();


        try {

            $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();

            $orderId = $this->repository->insert($orderData);


            foreach ($items as $item) {

                $item['order_id'] = $orderId;
                $this->repository->insertItem($item);

            }

            $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction()->commit();

            return ['order_id' => $orderId];

        } catch (\Exception $e) {

            $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction()->rollback();

            return 'error';
        }
    }

}