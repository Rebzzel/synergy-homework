@ECHO off

:: Easy Laravel Setup Script by Rebzzel (https://github.com/Rebzzel)

ECHO.

IF not EXIST .env (
	ECHO  .env not found. Creating...
	::
	COPY .env.example .env > NUL
	::
	ECHO  Please, fill .env and run script again.
	::
	GOTO exit
)

ECHO  Installing composer dependencies...
::
CALL composer install > install.log
::
ECHO.
ECHO  Installing node.js dependencies...
::
CALL npm install
::
ECHO.
ECHO  Generating app key...
::
CALL php artisan key:generate
::
ECHO.
ECHO  Running migrations...
::
CALL php artisan migrate

:exit

ECHO.
pause