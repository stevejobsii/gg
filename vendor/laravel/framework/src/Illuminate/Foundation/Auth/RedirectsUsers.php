<?php

namespace Illuminate\Foundation\Auth;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }
        flash()->success('欢迎!', '欢迎您来好去处网!');
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
