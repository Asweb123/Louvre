<?php

namespace App\Service;


class CodeGenerator
{
    public function codeGenerator()
    {
        $alfa='ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        return substr(str_shuffle($alfa),0,12);
    }
}
