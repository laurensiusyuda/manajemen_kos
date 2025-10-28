<?php

namespace App;

enum InvoiceStatus: string
{
    case UNPAID = 'unpaid';
    case PENDING  = 'pending';
    case PAID = 'paid';
}
