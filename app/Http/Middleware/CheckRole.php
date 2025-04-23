public function handle($request, Closure $next, $role)
{
    if (Auth::check() && Auth::user()->role === $role) {
        return $next($request);
    }
    
    return redirect('/')->with('error', 'Accès non autorisé');
}

