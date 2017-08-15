<?php

namespace App\Infrastructure\Project\Datatables;

use App\Domain\Project\ProjectRepository;
use App\Domain\ACL\ACLService;
use App\Domain\Core\Model;
use App\Infrastructure\Datatables\AbstractDatatables;

class ProjectCmsDatatable extends AbstractDatatables
{

    protected $repository;

    public function __construct(ACLService $aclService, ProjectRepository $repository)
    {
        parent::__construct($aclService);

        $this->repository = $repository;
    }

    protected $sortMapping = [
        0 => 'p.id',
        1 => 'p.title',
        2 => 'p.createdAt',
        3 => 'p.status'
    ];

    public function getResultPaginator($perPage, $start, array $order = null, array $search = null)
    {
        $qb = $this->repository->createQueryBuilder('p')
            ->select('p')
            ->setFirstResult($start)
            ->setMaxResults($perPage);

        if (! empty($search['value'])) {

            $qb->where($qb->expr()->eq('p.id', ':id'));

            $qb->orWhere($qb->expr()->orX(
                $qb->expr()->like('p.title', ':search')
            ));

            $qb->setParameter('id', $search['value']);
            $qb->setParameter('search', '%' . $search['value'] . '%');
        }

        $this->applyOrder($order, $qb);

        return $this->makePaginator($qb->getQuery());
    }

    public function parseSingleResult($project)
    {
        return [
            $project->getId(),
            $project->getTitle(),
            $project->getCreatedAt()->format('d/m/Y H:i:s'),
            present_status_html($project->getStatus()),
            $this->buildActionsColumn($project)
        ];
    }

    protected function buildActionsColumn(Model $entity, array $params = [])
    {
        $actions = '<div class="btn-group btn-group-xs">';

        if ($this->checkEditPermission(cmsUser())) {
            $actions .= '<a href="' . route($this->getEditRouteName(), [$entity->getId()]) . '" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>';
        }

        if ($this->checkDestroyPermission(cmsUser())) {
            $actions .= '<a href="javascript:void(0);" class="btn btn-danger"
                   data-form-link
                   data-confirm-title="Confirmação de exclusão"
                   data-confirm-text="Deseja realmente excluir esse registro?"
                   data-method="DELETE"
                   data-action="' . route($this->getDestroyRouteName(), [$entity->getId()]) . '"><i class="fa fa-trash"></i> Excluir</a>';
        }

        $actions .= '</div>';

        return $actions;
    }

}