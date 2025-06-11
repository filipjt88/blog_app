<?php

define('BASE_URL', '/blog_app/');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}