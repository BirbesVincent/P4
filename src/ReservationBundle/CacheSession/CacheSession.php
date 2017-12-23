<?php

namespace LO\UserBundle\CacheSession;

use Symfony\Component\HttpFoundation\Session\Session;


class CacheSession {

    public function setCommandCache($request, $command)
    {
        $session = $request->getSession();
        $session->set('command', $command);
        return $session;
    }

}