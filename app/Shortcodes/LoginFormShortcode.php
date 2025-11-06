<?php

namespace App\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class LoginFormShortcode
{
    public function __invoke(ShortcodeInterface $shortcode)
    {
        // Check if user is already logged in
        if (auth()->guard('teacher')->check()) {
            return '<script>window.location.href = "/teacher/dashboard";</script>';
        }
        
        if (auth()->guard('student')->check()) {
            return '<script>window.location.href = "/student/dashboard";</script>';
        }
        
        if (auth()->check()) {
            return '<script>window.location.href = "/account/dashboard";</script>';
        }

        // You can pass attributes like [login_form redirect="/home"]
        $redirect = $shortcode->getParameter('redirect', '/dashboard');

        // Return rendered HTML for guests only
        return view('shortcodes.login_form', compact('redirect'))->render();
    }
}
