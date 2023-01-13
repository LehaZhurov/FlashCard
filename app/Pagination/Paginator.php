<?php

namespace App\Pagination;

use Illuminate\Database\Eloquent\Builder;

class Paginator
{

    protected $collection;

    public static function create(Builder $queryBuilder, int $limit = 25)
    {
        return (new self())->build($queryBuilder, $limit);
    }

    public function build(Builder $queryBuilder, int $limit)
    {
        $LengthAwarePaginator = $queryBuilder->paginate($limit);
        $buffer = [];

        $buffer['data'] = $LengthAwarePaginator->getCollection();
        $buffer['pagination']['total'] = $LengthAwarePaginator->total();
        $buffer['pagination']['per_page'] = $LengthAwarePaginator->perPage();
        $buffer['pagination']['current_page'] = $LengthAwarePaginator->currentPage();
        $buffer['pagination']['count_item_current_page'] = $LengthAwarePaginator->count();
        $buffer['pagination']['next_page_url'] = $LengthAwarePaginator->nextPageUrl();
        $buffer['pagination']['prev_page_url'] = $LengthAwarePaginator->previousPageUrl();
        $buffer['pagination']['last_page'] = $LengthAwarePaginator->lastPage();
        if ($LengthAwarePaginator->nextPageUrl() != null) {
            $buffer['pagination']['next_page'] = $LengthAwarePaginator->currentPage() + 1;
        } else {
            $buffer['pagination']['next_page'] = null;
        }
        if($LengthAwarePaginator->currentPage() != 1){
            $buffer['pagination']['prev_page'] = $LengthAwarePaginator->currentPage() - 1;
        }else{
            $buffer['pagination']['prev_page'] = null;
        }
        $this->collection = collect($buffer);
        return $this->collection;
    }

}
