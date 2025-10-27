<?php

namespace App;

enum InvoiceStatus: string
{
    case UNPAID = 'UNPAID';
    case PENDING  = 'PENDING';
    case PAID = 'PAID';
}
