<?php

namespace core;

interface ORMInterface {
    /**
     *@return array Property names of the model
     */
    function loadProps(): array;
}