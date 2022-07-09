<?php

namespace Secco2112\LinkedList;

class Node
{

    public $data;
    public $next;

    public function __construct($data = null)
    {
        $this->data = $data? $data: 0;
        $this->next = null;
    }

}