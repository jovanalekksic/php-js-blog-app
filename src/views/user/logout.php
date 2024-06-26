<?php
session_start();
session_unset();
session_destroy();
header("Location: /Blog/src/index.php");
exit();
