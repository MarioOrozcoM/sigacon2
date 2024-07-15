<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Models\User; // Asegúrate de importar el modelo User si lo estás utilizando

class UserComposer
{
    public function compose(View $view)
    {
        $user = auth()->user(); // Obtener el usuario autenticado
        $view->with('user', $user);
    }
}
