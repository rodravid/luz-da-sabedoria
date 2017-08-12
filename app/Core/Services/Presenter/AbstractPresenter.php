<?php

namespace App\Core\Services\Presenter;

use Carbon\Carbon;
use Robbo\Presenter\Presenter as BasePresenter;

abstract class AbstractPresenter extends BasePresenter
{

    protected function toAffirmative($expression)
    {
        return $expression ? 'Sim' : 'Não';
    }

    protected function toDefaultDateTime($date)
    {
        if (! empty($date) && $date instanceof Carbon) {
            return  $date->format('d/m/Y \à\s H:i\h');
        }
    }

    protected function toDefaultDate($date)
    {
        if (! empty($date) && $date instanceof Carbon) {
            return  $date->format('d/m/Y');
        }
    }

    public function presentCreatedAt()
    {
        return $this->toDefaultDateTime($this->getCreatedAt());
    }

    public function presentUpdatedAt()
    {
        return $this->toDefaultDateTime($this->getUpdatedAt());
    }

    public function presentStartsAt()
    {
        return $this->toDefaultDateTime($this->getStartsAt());
    }

    public function presentExpirationAt()
    {
        $date = $this->toDefaultDateTime($this->getExpirationAt());

        if (! $date) {
            return 'Nunca expira';
        }

        return $date;
    }

    public function presentStatus()
    {
        switch ($this->getStatus()) {
            case 0:
                return 'Rascunho';
            break;
            case 1:
                return 'Publicado';
            break;
            case 2:
                return 'Desativado';
            break;
        }
    }

    public function presentStatusHtml()
    {
        return present_status_html($this->getStatus());
    }

    public function presentUserName()
    {
        if ($user = $this->getUser()) {
            return $user->getName();
        }
    }

    public function presentWebPath()
    {
        return $this->getWebPath();
    }

    public function getCacheKey()
    {
        return $this->object->getCacheKey();
    }

}