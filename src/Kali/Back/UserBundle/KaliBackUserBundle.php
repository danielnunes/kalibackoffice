<?php

namespace Kali\Back\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KaliBackUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
