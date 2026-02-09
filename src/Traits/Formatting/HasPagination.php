<?php

namespace Faresnassar09\ApiVault\Traits\Formatting;

trait HasPagination
{

    protected $paginationData = null;

    protected  function preparePaginatedData($result)
    {
        return $this->paginationData = [
            'from' => $result->firstItem(),
            'to' => $result->lastItem(),
            'total'        =>  $result->total() ?? null,
            'count'        => $result->count(),
            'per_page'     => $result->perPage(),
            'current_page' => $result->currentPage(),
            'total_pages'  => $result->lastPage() ?? null,
            'links'        => [
                'next'     => $result->nextPageUrl(),
                'previous' => $result->previousPageUrl(),
            ],
        ];
    }
}
