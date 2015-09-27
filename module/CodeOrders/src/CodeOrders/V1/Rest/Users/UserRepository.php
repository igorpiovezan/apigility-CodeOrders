<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 23/08/2015
 * Time: 13:11
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;

class UserRepository
{

    private $tableGateway;

    /**
     * UserRepository constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {

        $this->tableGateway = $tableGateway;

    }

    public function findAll()
    {
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);

        return new UsersCollection($paginatorAdapter);

        //return $this->tableGateway->select();
    }


    public function find($id)
    {

        $resultSet = $this->tableGateway->select(['id' => (int)$id]);

        return $resultSet->current();
    }


    public function create($data)
    {

        if (is_null($data->role) or !$data->role)
            $data->role = 'salesman'; //É necessário melhorar isso. Mais terde pretendo resolver. Qual seria uma boa forma de resolução?

        $insertData = [

            'username' => $data->username,
            'password' => $data->password,
            'first_name' => $data->first_name,
            'last_name' => $data->username,
            'role' => $data->role

        ];

        return $this->tableGateway->insert($insertData);

    }

    public function delete($id)
    {
        return $this->tableGateway->delete(['id' => (int)$id]);
    }


    public function update($id, $data)
    {

        if (is_null($data->role) or !$data->role)
            $data->role = 'salesman'; //É necessário melhorar isso. Mais terde pretendo resolver. Qual seria uma boa forma de resolução? Algo com ArraySearizable?

        $updateData = [

            'username' => $data->username,
            'password' => $data->password,
            'first_name' => $data->first_name,
            'last_name' => $data->username,
            'role' => $data->role

        ];

        return $this->tableGateway->update($updateData, ['id' => (int)$id]);

    }


    public function patch($id, $data)
    {

        if (is_null($data->role) or !$data->role)
            $data->role = 'salesman'; //É necessário melhorar isso. Mais terde pretendo resolver. Qual seria uma boa forma de resolução?

        $updateData = [

            'username' => $data->username,
            'password' => $data->password,
            'first_name' => $data->first_name,
            'last_name' => $data->username,
            'role' => $data->role

        ];

        return $this->tableGateway->update($updateData, ['id' => (int)$id]);

    }

    public function findByUsername($username)
    {

        return $this->tableGateway->select(['username' => $username])->current();
    }


}