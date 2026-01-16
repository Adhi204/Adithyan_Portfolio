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

    case AdminCreatedUser = 'ADM_USR_C';
    case AdminUpdatedUser = 'ADM_USR_U';
    case AdminUpdatedUserSettings = 'ADM_USR_US';
    case AdminDeletedUser = 'ADM_USR_D';
    case AdminBannedUser = 'ADM_USR_B';
    case AdminUnbannedUser = 'ADM_USR_UB';

    case AdminCreatedLocation = 'ADM_LOC_C';
    case AdminUpdatedLocation = 'ADM_LOC_U';
    case AdminDeletedLocation = 'ADM_LOC_D';
    case AdminActivatedLocation = 'ADM_LOC_A';
    case AdminDeactivatedLocation = 'ADM_LOC_DE';
    case AdminUpdatedLocationSettings = 'ADM_LOC_SU';
    case AdminUpdatedLocationNotificationSettings = 'ADM_LOC_NU';
    case AdminCreatedLocationUser = 'ADM_LU_ADD';
    case AdminDeletedLocationUser = 'ADM_LU_DEL';

    case AdminCreatedCounter = 'ADM_CTR_C';
    case AdminUpdatedCounter = 'ADM_CTR_U';
    case AdminDeletedCounter = 'ADM_CTR_D';
    case AdminActivatedCounter = 'ADM_CTR_A';
    case AdminDeactivatedCounter = 'ADM_CTR_DE';

    case UserCreatedLocation = 'USR_LOC_C';
    case UserUpdatedLocation = 'USR_LOC_U';
    case UserDeletedLocation = 'USR_LOC_D';
    case UserActivatedLocation = 'USR_LOC_A';
    case UserDeactivatedLocation = 'USR_LOC_DE';
    case UserUpdatedLocationSettings = 'USR_LOC_SU';
    case UserUpdatedLocationNotificationSettings = 'USR_LOC_NU';
    case UserCreatedLocationUser = 'USR_LU_ADD';
    case UserDeletedLocationUser = 'USR_LU_DEL';

    case UserCreatedCounter = 'USR_CTR_C';
    case UserUpdatedCounter = 'USR_CTR_U';
    case UserDeletedCounter = 'USR_CTR_D';
    case UserActivatedCounter = 'USR_CTR_A';
    case UserDeactivatedCounter = 'USR_CTR_DE';

    case UserBookedToken = 'USR_TKN_BK';
    case UserConfirmedToken = 'USR_TKN_CF';
    case UserRejectedToken = 'USR_TKN_RJ';
    case UserCancelledToken = 'USR_TKN_CN';
    case UserCancelledAllPendingBookings = 'USR_TKN_CP';
    case UserUpdatedTokenStatus = 'USR_TKN_US';
    case UserBookedWalkinToken = 'USR_TKN_BW';

    case UserBookedSlot = 'USR_SLT_BK';
    case UserConfirmedSlot = 'USR_SLT_CF';
    case UserRejectedSlot = 'USR_SLT_RJ';
    case UserCancelledSlot = 'USR_SLT_CN';
    case UserBookedWalkinSlot = 'USR_SLT_BW';
    case UserUpdatedSlotBookingStatus = 'USR_SLT_UB';

    case UserVerified = 'USR_VER';
    case UserResentVerification = 'USR_VER_R';

    case UserUpdatedProfile = 'USR_UPD_PR';
    case UserUpdatedEmail = 'USR_UPD_EM';
    case UserUpdatedPhone = 'USR_UPD_PH';
    case UserUpdatedSettings = 'USR_UPD_SE';
    case UserUpdatedPassword = 'USR_UPD_PW';
    case UserResetPassword = 'USR_UPD_RP';

    case AdminCreatedSlot = 'ADM_SLT_C';
    case AdminUpdatedSlot = 'ADM_SLT_U';
    case AdminActivatedSlot = 'ADM_SLT_A';
    case AdminDeactivatedSlot = 'ADM_SLT_DE';

    case UserCreatedSlot = 'USR_SLT_C';
    case UserUpdatedSlot = 'USR_SLT_U';
    case UserActivatedSlot = 'USR_SLT_A';
    case UserDeactivatedSlot = 'USR_SLT_DE';

    case AdminUpdatedWeeklyHolidays = 'ADM_HOL_U';
    case AdminAddedSpecialHoliday = 'ADM_HOL_SP';
    case AdminAddedHolidayException = 'ADM_HOL_EX';
    case AdminRemovedSpecialHoliday = 'ADM_HOL_SR';
    case AdminRemovedHolidayException = 'ADM_HOL_ER';

    case UserUpdatedWeeklyHolidays = 'USR_HOL_U';
    case UserAddedSpecialHoliday = 'USR_HOL_SP';
    case UserAddedHolidayException = 'USR_HOL_EX';
    case UserRemovedSpecialHoliday = 'USR_HOL_SR';
    case UserRemovedHolidayException = 'USR_HOL_ER';

    case AdminCreatedLocationGroup = 'ADM_LG_C';
    case AdminUpdatedLocationGroup = 'ADM_LG_U';
    case AdminDeletedLocationGroup = 'ADM_LG_D';
    case AdminAddedLocationInGroup = 'ADM_LG_AL';
    case AdminRemovedLocationFromGroup = 'ADM_LG_RL';

    case UserCreatedLocationGroup = 'USR_LG_C';
    case UserUpdatedLocationGroup = 'USR_LG_U';
    case UserDeletedLocationGroup = 'USR_LG_D';
    case UserAddedLocationInGroup = 'USR_LG_AL';
    case UserRemovedLocationFromGroup = 'USR_LG_RL';
}
