<?php

if (!function_exists('isActiveRoute')) {
    function isActiveRoute(string $routeName): string
    {
        $currentRoute = service('router')->getMatchedRouteOptions()['as'] ?? '';

        return $currentRoute === $routeName
            ? 'text-primary font-bold relative after:content-[\'\'] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-primary'
            : 'text-muted-foreground font-medium hover:text-primary transition-colors';
    }
}

if (!function_exists('isActiveSidebarRoute')) {
    function isActiveSidebarRoute(string $routeName): string
    {
        $currentRoute = service('router')->getMatchedRouteOptions()['as'] ?? '';

        return $currentRoute === $routeName
            ? 'font-semibold bg-primary text-primary-foreground '
            : 'text-muted-foreground font-medium hover:text-primary transition-colors';
    }
}
