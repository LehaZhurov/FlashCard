<?php

namespace App\Pagination;

use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Support\Collection;

class Paginator
{


    public static function build(Builder $queryBuilder, int $limit): Collection
    {
        $LengthAwarePaginator = $queryBuilder->paginate($limit);

        $data = $LengthAwarePaginator->getCollection();
        $pagination = [];

        $pagination['total'] = $LengthAwarePaginator->total();
        $pagination['per_page'] = $LengthAwarePaginator->perPage();
        $pagination['current_page'] = $LengthAwarePaginator->currentPage();
        $pagination['count_item_current_page'] = $LengthAwarePaginator->count();
        $pagination['next_page_url'] = $LengthAwarePaginator->nextPageUrl();
        $pagination['prev_page_url'] = $LengthAwarePaginator->previousPageUrl();
        $pagination['last_page'] = $LengthAwarePaginator->lastPage();

        if ($LengthAwarePaginator->nextPageUrl() != null) {
            $pagination['next_page'] = $LengthAwarePaginator->currentPage() + 1;
        } else {
            $pagination['next_page'] = null;
        }
        if ($LengthAwarePaginator->currentPage() != 1) {
            $pagination['prev_page'] = $LengthAwarePaginator->currentPage() - 1;
        } else {
            $pagination['prev_page'] = null;
        }
        
        $result = collect(
            ['data' => $data, 'pagination' => $pagination]
        );
        return $result;
    }

}
