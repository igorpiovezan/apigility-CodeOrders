<?php
namespace CodeOrders\V1\Rest\Products;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ProductsResource extends AbstractResourceListener
{


    private $repository;


    /**
     * ProductsResource constructor.
     * @param ProductsRepository $repository
     */
    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {

        $user = $this->repository->findByUsername($this->getIdentity()->getRoleId());

        if ($user->getRole() == "salesman") {

            return new ApiProblem(403, "The user has not access to this info");
        }

        return $this->repository->create($data);

        //return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {


        $user = $this->repository->findByUsername($this->getIdentity()->getRoleId());

        if ($user->getRole() == "salesman") {

            return new ApiProblem(403, "The user has not access to this info");
        }

        return $this->repository->delete($id);
        //return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {

        $user = $this->repository->findByUsername($this->getIdentity()->getRoleId());

        if ($user->getRole() == "salesman") {

            return new ApiProblem(403, "The user has not access to this info");
        }

        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {

        return $this->repository->find($id);

        //return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {

        return $this->repository->findAll();
        //return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {

        $user = $this->repository->findByUsername($this->getIdentity()->getRoleId());

        if ($user->getRole() == "salesman") {

            return new ApiProblem(403, "The user has not access to this info");
        }

        return $this->repository->patch($id, $data);
        //return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {

        $user = $this->repository->findByUsername($this->getIdentity()->getRoleId());

        if ($user->getRole() == "salesman") {

            return new ApiProblem(403, "The user has not access to this info");
        }

        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {

        $user = $this->repository->findByUsername($this->getIdentity()->getRoleId());

        if ($user->getRole() == "salesman") {

            return new ApiProblem(403, "The user has not access to this info");
        }

        return $this->repository->update($id, $data);
        //return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
