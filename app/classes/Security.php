<?php

namespace app\classes;

class security
{
    /**
     * Verifica se o usuário está autenticado
     *
     * @return void
     */
    public static function protect()
    {
        $logged = \app\classes\Session::getValue('logged');

        if (!$logged || $logged == null)
            redirect(SECURITY_REDIRECT);

        if ($_SERVER['REMOTE_ADDR'] != \app\classes\Session::getValue('ip'))
            redirect(SECURITY_REDIRECT);
    }
}
