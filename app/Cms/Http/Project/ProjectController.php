<?php

namespace App\Cms\Http\Project;

use App\Cms\Http\Controller;
use App\Domain\Project\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $repository;

    public function __construct(ProjectRepository $repository)
    {

        $this->repository = $repository;
    }

    public function index()
    {
        return $this->view('projects.list');
    }

    public function create()
    {
        return $this->view('projects.create');
    }

    public function edit($id)
    {
        $project = $this->repository->findOrFail($id);

        return $this->view('projects.edit', compact('project'));
    }

    public function show($id)
    {
        $customer = $this->repository->findOrFail($id);
        $customer = $this->presenter->model($customer, CustomerPresenter::class);

        $addresses = $this->addressRepository->getAllByCustomer($id);

        $orders = $this->orderRepository->getByCustomer($id, 10);
        $orders = $this->presenter->paginator($orders, OrderPresenter::class);

        $integrationLogs = IntegrationLogger::type('customer')->getByResourceId($id);

        $carts = $this->presenter->collection($this->cartRepository->getLastCustomerCarts($customer->getObject()), ShoppingCartPresenter::class);

        return $this->view('projects.show', compact('customer', 'addresses', 'orders', 'carts', 'integrationLogs'));
    }

    public function showCart($id, $cartId)
    {
        $customer = $this->repository->findOrFail($id);
        $customer = $this->presenter->model($customer, CustomerPresenter::class);

        $cart = $this->cartRepository->find($cartId);
        $cart = $this->presenter->model($cart, ShoppingCartPresenter::class);

        return $this->view('projects.show-cart', compact('customer', 'cart'));
    }

    public function store(Request $request)
    {
        try {

            $data = $request->all();

            $customer = $this->service->create($data);

            Flash::success("Cliente {$customer->getName()} criado com sucesso!");

            return Redirect::route($this->getEditRouteName(), $customer->getId());

        } catch (ValidationException $e) {

            return Redirect::back()->withErrors($e->getErrors())->withInput();

        } catch (Exception $e) {

            Flash::error($e->getMessage());

            return Redirect::back()->withInput();
        }
    }

    public function update(Request $request, $customerId)
    {
        try {

            $data = $request->all();

            $customer = $this->service->update($data, $customerId);

            Flash::success("Cliente {$customer->getName()} atualizado com sucesso!");

            return Redirect::route($this->getEditRouteName(), $customer->getId())
                ->withInput(['current-tab' => $request->get('current-tab')]);

        } catch (ValidationException $e) {

            return Redirect::back()->withErrors($e->getErrors())->withInput();

        } catch (Exception $e) {

            Flash::error($e->getMessage());

            return Redirect::back()->withInput();
        }

    }

    public function destroy($customerId)
    {
        $customer = $this->repository->find($customerId);

        try {

            $this->repository->delete($customer);

            Flash::success("Cliente {$customer->getName()} excluído com sucesso!");

            return Redirect::route($this->getListRouteName());

        } catch (Exception $e) {

            Flash::error($e->getMessage());
            return Redirect::back();
        }
    }

}