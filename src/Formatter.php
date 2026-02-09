<?php

namespace FaresNassar\ApiVault;

use Illuminate\Http\JsonResponse;
use FaresNassar\ApiVault\Traits\Formatting\HasCaching;
use FaresNassar\ApiVault\Traits\Formatting\HasResponseMetadata;
use FaresNassar\ApiVault\Traits\Formatting\HasPagination;


class Formatter
{

    use HasCaching,
        HasResponseMetadata,
        HasPagination;



    private function dataResorver()
    {

        $result = null;

        if ($this->callback && $this->cacheKey !== 'cache_key') {
            $result = $this->resolveCachedData();
        } elseif ($this->callback) {

            $result = ($this->callback)();
        } else {


            $result = $this->data;
        }

        if ($result instanceof \Illuminate\Contracts\Pagination\Paginator) {

            $this->preparePaginatedData($result);

            $result = $result->items();
        }

        return $result;
    }


    public function respond(): JsonResponse
    {

        $data = $this->dataResorver();

        $finalResponse = [

            'success' => $this->success,
            'message' => $this->message,
            'data' => $data,
            'code' => $this->code,


        ];

        if ($this->paginationData) {
            $finalResponse['pagination'] = $this->paginationData;
        }

        return response()->json($finalResponse, $this->code, $this->headers, $this->options);
    }
}
