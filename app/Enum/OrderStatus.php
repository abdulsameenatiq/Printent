<?php
namespace App\Enum;

class OrderStatus
{
    const PENDING = 0;
    const CANCELLED = 1;
    const CONFIRMED = 2;
    const PROCESSING = 3;
    const COMPLETE = 4;
}