<?php

class Relatable_Condition_Args {

    public $visible;
    public $query_args;

    public function __construct($args) {
        $this->visible = $args['visible'] ?? true;
        $this->query_args = $args['query_args'] ?? [];
    }

}
