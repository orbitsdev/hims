<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Staff = 'staff';
    case Personnel = 'personnel';
    case Student = 'student';
}
