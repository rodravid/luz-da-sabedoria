<?php

namespace App\Core\Contracts;

interface Datatables
{

    public function getForDatatables($perPage, $start, array $order, array $search = null);

}