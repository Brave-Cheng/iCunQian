<?php
class message
{
    /*---------------system--------------------*/
    const SYSTEM_ERROR                     = 'There is an error in the process, please contact system admin.';
    const DATA_IS_NULL                     = 'There is no data.';
    const USER_IS_NOT_EXIST                = 'User is not exist';
    /*---------------Login--------------------*/
    const LOGIN_EXPIRED                    = 'Login expired.';
    const LOGIN_SUCCESSFULLY               = 'Login successfully.';
    const LOGIN_FAILED                     = 'Login failed.';
    /*---------------Forgot Password--------------------*/  
    const GET_NEW_PASSWORD_SUCCESSFULLY    = 'Get new password successfully.';
    const GET_NEW_PASSWORD_FAILED          = 'Get new password failed.';
    const USER_OR_NAME_IS_NOT_EXIST        = 'User or Name is not exist.';
    const NEW_PASSWORD                     = '您的新密码是';
    const HAS_SEND                         = 'You have send.';
    const CHANGE_PASSWORD_SUCCESSFULLY     = 'Change password successfully';
    const CHANGE_PASSWORD_FAILED           = 'Change password failed';
    /*---------------Update UseInfo--------------------*/
    const UPDATE_USER_SUCCESSFULLY         = 'Update user successfully.';
    const NAME_IS_NOT_BLANK                = 'Name is not blank.';
    const TEL_IS_NOT_BLANK                 = 'Tel is not blank.';
    const EMAIL_IS_NOT_BLANK               = 'Email is not blank.';
    const UPLOAD_PICTURES_IS_NOT_BLANK     = 'Upload pictures is not blank.';
    const TEL_ALREADY_EXISTS               = 'Tel already exists';
    const NAME_ALREADY_EXISTS              = 'Name already exists';
    const EMAIL_ALREADY_EXISTS             = 'Email already exists';
    const TEL_FORMAT_ERROR                 = 'Tel format is error.';
    const EMAIL_FORMAT_ERROR               = 'Email format is error.'; 
    const PICTURES_IS_TOO_LARGRE           = 'This file is too large. Maximum size is 2M.';
    const PICTURES_FORMAT_ERROR            = 'This file type is not allowed. Allowed types are .jpg, .jpeg, .png, .gif.';
    const UPLOAD_FILED                     = 'Upload filed.';
    const UPLOAD_SUCCESSFULLY              = 'Upload successfully.';
    /*---------------Sign In-------------------------------*/
    const PROJECT_NOT_EXIST                = 'Project is not exist.';
    const SIGN_IN_FAILED                   = 'SignIn fail.You hava signin.';
    const SIGN_IN_SUCCESSFULLY             = 'SingIn successfully.';
    /*----------------Sign Image---------------------------------*/
    const UPLOAD_FILE_SUCCESSFULLY         = 'upload image successfully';
    const UPLOAD_FILE_FAILED               = 'upload image failed';
    const IMAGE_TYPE_IS_ERROR              = 'Image type is error';
    /*----------------ReadingHistory--------------------------------*/
    const MARKED_SUCCESSFULLY              = 'marked successfully';
    const MARKED_FAILED                    = 'marked failed'; 
    /*----------------approval--------------------------------*/
    const APPROVAL_SUCCESSFULLY            = 'approval successfully';
    const APPROVAL_FAILED                  = 'approval failed';
    const NOT_FOUND_APPLICATION            = 'not fount application';
}

?>