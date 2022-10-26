<?php

define('REGEX_MAIL', '/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/');
define('REGEX_NAME', '/^[a-zA-Z0-9._-]{2,25}$/');
define('REGEX_PHONE', '/^[0-9]{10}$/');
define('REGEX_BIRTHDATE', '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/');
define('REGEX_GENDER', '/^[1-2]{1}$/');
define('REGEX_ID', '/^[0-9]{1,}$/');
define('REGEX_PAGE', '/^[0-9]{1,}$/');
define('REGEX_DATETIME', '/^[0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}$/');
define('DATETIME_FORMAT', 'Y-m-d H:i');