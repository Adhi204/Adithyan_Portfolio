<?php

namespace App\Enums\Users;

use App\Library\Traits\Enums\GetsValueFromName;

enum Activities: string
{
    use GetsValueFromName;

    case UserRegistered = 'USR_REG';
    case UserRegisteredWithGoogle = 'USR_REG_GL';

    case UserLoggedIn = 'USR_LOGIN';
    case UserLoggedOut = 'USR_LGOUT';
    case UserLoggedOutFromDevice = 'USR_LGOUTD';
    case UserLoggedOutFromOtherDevices = 'USR_LGOUTO';
    case UserLoggedOutFromAllDevices = 'USR_LGOUTA';

    case UserUpdatedPassword = 'ADM_PSW_UP';
}
