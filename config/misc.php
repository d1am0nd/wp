<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Order by prettified
    |--------------------------------------------------------------------------
    |
    */

    'orderBy' => [
        'newest' => ['created_at', 'DESC'],
        'top' => ['vote_sum', 'DESC'],
        'most commented' => ['comment_count', 'DESC']
    ],
    'orderByJson' => [
        'top' => [
            'queryArray' => ['vote_sum', 'DESC'],
            'pretty' => 'Top'
        ],
        'newest' => [
            'queryArray' => ['created_at', 'DESC'],
            'pretty' => 'New'
        ],
        'most commented' => [
            'queryArray' => ['comment_count', 'DESC'],
            'pretty' => 'Comments'
        ]
    ]
];
