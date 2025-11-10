<?php

namespace App;

enum InvoiceStatus: string
{
    case UNPAID = 'unpaid';
    case PENDING  = 'pending';
    case PAID = 'paid';

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            self::PAID => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            self::UNPAID => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
        };
    }
}
