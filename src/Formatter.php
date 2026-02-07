<?php

namespace Faresnassar09\ApiVault;

use Illuminate\Http\JsonResponse;
use Faresnassar09\ApiVault\Traits\Formatting\HasCaching;
use Faresnassar09\ApiVault\Traits\Formatting\HasResponseMetadata;

class Formatter
{

    use HasCaching,HasResponseMetadata;

    private function dataResorver(){

        if ($this->callback && $this->cacheKey !== 'cache_key') {
            return $this->resolveCachedData();
        }
        elseif ($this->callback) {

            return ($this->callback)();
        }

        return $this->data;

        }


    public function respond(): JsonResponse {

        $data = $this->dataResorver();

        return response()->json([

            'success' => $this->success,
            'message' => $this->message,
            'data' => $data,
            'code' => $this->code,

        ], $this->code, $this->headers, $this->options);
    }
    }
