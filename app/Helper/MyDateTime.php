<?php

namespace App\Helper;


class MyDateTime extends \DateTime
{
    public function __toString()
    {
        return $this->format('U');
    }
}