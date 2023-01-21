<?php

namespace App\Traits;

trait PaginationMeta
{
    public function unset($response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset(
            $jsonResponse['links'],
            $jsonResponse['current_page'],
            $jsonResponse['from'],
            $jsonResponse['last_page'],
            $jsonResponse['links'],
            $jsonResponse['path'],
            $jsonResponse['per_page'],
            $jsonResponse['to'],
            $jsonResponse['first_page_url'],
            $jsonResponse['last_page_url'],
            $jsonResponse['next_page_url'],
            $jsonResponse['prev_page_url'],
            $jsonResponse['total'],


        );
        $response->setContent(json_encode($jsonResponse));
    }

    public function set()
    {
        return [
            'page' => $this->currentPage(),
            'pages' => $this->lastPage(),
            'perpage' => $this->perPage(),
            'total' => $this->total(),
        ];
    }
}
