<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/09/2015
 * Time: 11:00
 */

namespace CodeOrders\src\CodeOrders\V1\Rest\Orders;


use CodeOrders\V1\Rest\Orders\OrdersCollection;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty;

class OrdersRepository
{
    /**
     * @var AbstractTableGateway
     */
    private $orderItemTableGateway;
    /**
     * @var AbstractTableGateway
     */
    private $tableGateway;


    /**
     * OrdersRepository constructor.
     */
    public function __construct(AbstractTableGateway $tableGateway, AbstractTableGateway $orderItemTableGateway)
    {

        $this->orderItemTableGateway = $orderItemTableGateway;
        $this->tableGateway = $tableGateway;
    }


    public function findAll()
    {

        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));

        $user = $this->findByUsername($this->getIdentity()->getRoleId());

        if ($user->getRole() == "salesman") {

            $orders = $this->tableGateway->select(['id' => $user->getId()]);
        } elseif ($user->getRole() == "admin") {

            $orders = $this->tableGateway->select();

        } else {

            $orders = $this->tableGateway->select();
        }


        $res = [];

        foreach ($orders as $order) {
            $items = $this->orderItemTableGateway->select(['order_id' => $order->getId()]);

            foreach ($items as $item) {

                $order->addItem($item);

            }


            $data = $hydrator->extract($order);

            $res = $data;

        }

        $arrayAdpter = new ArrayAdapter($res);
        $ordersCollection = new OrdersCollection($arrayAdpter);

        return $ordersCollection;
    }

    public function findByUsername($username)
    {

        return $this->tableGateway->select(['username' => $username])->current();
    }

    public function insert(array $data)
    {


        $this->tableGateway->insert($data);

        $id = $this->tableGateway->getLastInsertValue();

        return $id;

    }

    public function insertItem(array $data)
    {
        $this->orderItemTableGateway->insert($data);

        return $this->orderItemTableGateway->getLastInsertValue();

    }

    public function getTableGateway()
    {
        return $this->tableGateway;

    }


}