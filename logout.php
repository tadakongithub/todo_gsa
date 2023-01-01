<?php

require('./inc/header.php');

session_destroy();

header('Location: ./login.php');