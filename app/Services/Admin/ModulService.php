<?php   

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class ModulService
{
    public function __construct(
        public User $user
    ) {
    }
    
}