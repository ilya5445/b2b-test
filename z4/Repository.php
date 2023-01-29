<?php

namespace z4;

class Repository {

    protected $source;

    function __construct(PDOSource $source) {
        $this->source = $source::connToDB();
    }

}
