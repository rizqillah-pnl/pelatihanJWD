<?php

function getData($url, $token)
{
    // $url = "https://api.github.com/search/users?q=rizqillah-pnl";
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: PHP',
                // 'Authorization: Bearer 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'
                "Authorization: Bearer " . $token
            ]
        ]
    ];

    $json = file_get_contents($url, false, stream_context_create($opts));
    $obj = json_decode($json, 1);
    return $obj;
}
