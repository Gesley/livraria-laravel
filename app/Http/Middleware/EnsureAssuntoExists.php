<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Assunto;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EnsureAssuntoExists
{
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        if (!Assunto::find($id)) {
            throw new NotFoundHttpException("Assunto não encontrado.");
        }

        return $next($request);
    }
}
