<?php

namespace App;

enum UserRole: string
{
    case ADMIN = 'ADMIN';
    case TENAT = 'TENANT';
}
