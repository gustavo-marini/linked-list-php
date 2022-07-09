<?php

namespace Secco2112\LinkedList;

/**
 * [Description LinkedList]
 * 
 * @author Gustavo Marini <gustavo@usesimio.com>
 */
class LinkedList
{

    const VERSION = '1.0.0';

    const POSITION_AT_HEAD = 0;
    const POSITION_AT_END = 1;

    const SORT_ASC = 2;
    const SORT_DESC = 3;

    private $head;

    public function __construct()
    {
        $this->head = null;
    }

    public function length(): int
    {
        $counter = 0;

        $current = $this->head;

        while($current) {
            $current = $current->next;
            $counter++;
        }

        return $counter;
    }

    public function insert($data, int $position = self::POSITION_AT_END): LinkedList
    {
        $node = new Node($data);

        if($this->head == null) {
            $this->head = $node;
            return $this;
        }

        if($position === self::POSITION_AT_END) {
            $current = $this->head;
            while($current && $current->next != null) {
                $current = $current->next;
            }
            $current->next = $node;
        } else if($position === self::POSITION_AT_HEAD) {
            $temp = $node;
            $temp->next = $this->head;
            $this->head = $temp;
        }

        return $this;
    }

    public function deleteByValue($value): LinkedList
    {
        if($this->head == null) {
            return $this;
        }

        $current = $previous = $this->head;

        while($current->data == $value) {
            $this->head = $current->next;
            $current = $this->head;
        }

        while($current != null) {
            if($current->data == $value) {
                $previous->next = $current->next;
                $current = $previous;
            } else {
                $previous = $current;
                $current = $current->next;
            }
        }

        return $this;
    }

    public function deleteByIndex(int $index)
    {
        if($this->head == null) {
            return $this;
        }

        $current = $previous = $this->head;

        $idx = 0;

        while($idx++ != $index) {
            $previous = $current;
            $current = $current->next;
        }

        if($current == $previous) {
            $this->head = $current->next;
        }

        $previous->next = $current->next;

        return $this;
    }

    public function map(callable $fn): LinkedList
    {
        if($this->head == null) {
            return $this;
        }

        $current = $this->head;

        while($current) {
            $current->data = $fn($current->data);
            $current = $current->next;
        }

        return $this;
    }

    public function filter(callable $fn): LinkedList
    {
        if($this->head == null) {
            return $this;
        }
        
        $current = $previous = $this->head;

        while(!$fn($current->data)) {
            $this->head = $current->next;
            $current = $this->head;
        }

        while($current != null) {
            if(!$fn($current->data)) {
                $previous->next = $current->next;
                $current = $previous;
            } else {
                $previous = $current;
                $current = $current->next;
            }
        }

        return $this;
    }

    public function sort(int $sortDirection = self::SORT_ASC): LinkedList
    {
        if($this->head == null) {
            return $this;
        }

        $current = $this->head;
        $index = null;

        while($current != null) {
            $index = $current->next;

            while($index != null) {
                if($sortDirection == self::SORT_ASC) {
                    if($current->data > $index->data) {
                        $temp = $current->data;
                        $current->data = $index->data;
                        $index->data = $temp;
                    }
                } else if($sortDirection == self::SORT_DESC) {
                    if($current->data < $index->data) {
                        $temp = $current->data;
                        $current->data = $index->data;
                        $index->data = $temp;
                    }
                } else {
                    if($current->data > $index->data) {
                        $temp = $current->data;
                        $current->data = $index->data;
                        $index->data = $temp;
                    }
                }
                $index = $index->next;
            }
            $current = $current->next;
        }

        return $this;
    }

    public function usort(callable $fn): LinkedList
    {
        if($this->head == null) {
            return $this;
        }

        $current = $this->head;
        $index = null;

        while($current != null) {
            $index = $current->next;

            while($index != null) {
                if($fn($current->data, $index->data)) {
                    $temp = $current->data;
                    $current->data = $index->data;
                    $index->data = $temp;
                }
                $index = $index->next;
            }
            $current = $current->next;
        }

        return $this;
    }

    public function print()
    {
        if($this->head == null) {
            echo 'NULL';
            return;
        }

        $current = $this->head;

        while($current != null) {
            echo $current->data . ' -> ';
            $current = $current->next;
        }

        echo '[null]';
    }

}