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



    private function dataResolver()
    {

       try {
             
            $result = null;

        if ($this->callback && $this->cacheKey) {
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

        } catch (\Throwable $th) {

         \Log::error('An error occurred while resolving data ',[$th]);

         $this->success = false;
         $this->code = 500;
         $this->message = 'An error occurred while processing data.';
         
         return null;

        }


    }


    public function send(): JsonResponse
    {

        $data = $this->dataResolver();

        $finalResponse = [

            'success' => $this->success,
            'message' => $this->message,
            'data' => $data,
            'code' => $this->code,

        ];

        if(!empty($this->additional)){

            $finalResponse ['additional'] = $this->additional;
        }

        if ($this->paginationData) {
            $finalResponse['pagination'] = $this->paginationData;
        }



        return response()->json($finalResponse, $this->code, $this->headers, $this->jsonOptions);
    }
}
