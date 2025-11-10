Spatie\Permission\Models\Role::create(['name' => 'tenant']); <?php

namespace App;

enum UserRole: string
{
    case ADMIN = 'admin';
    case TENANT = 'tenant';
}
