<?php

namespace App\Filters;

use Illuminate\Http\Request;

class  ApiFilter
{

    protected $safeParams = [];

    protected $coulmnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request)
    {

        $eloQuery = [];

        foreach ($this->safeParams as $params => $operators) {
            $query = $request->query($params);

            if (!isset($query)) {
                continue;
            }

            $column = $this->coulmnMap[$params] ?? $params;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[($operator)], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
