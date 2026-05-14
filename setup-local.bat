@echo off
setlocal

set "XAMPP_PATH=C:\xampp"
if not exist "%XAMPP_PATH%\htdocs" (
  echo XAMPP not found in %XAMPP_PATH%.
  echo Please install XAMPP and rerun this script.
  pause
  exit /b 1
)

set "TARGET_NAME=JobPortal"
set /p TARGET_NAME=Enter target folder name under htdocs (default JobPortal): 
if "%TARGET_NAME%"=="" set TARGET_NAME=JobPortal

set "SOURCE=%~dp0"
if "%SOURCE:~-1%"=="\" set "SOURCE=%SOURCE:~0,-1%"
set "DEST=%XAMPP_PATH%\htdocs\%TARGET_NAME%"

echo Copying project from "%SOURCE%" to "%DEST%"...
if exist "%DEST%" (
  echo Cleaning existing folder "%DEST%"...
  rmdir /s /q "%DEST%"
)
robocopy "%SOURCE%" "%DEST%" /mir /xd ".git" /xf "setup-local.bat"
if %ERRORLEVEL% GEQ 8 (
  echo Error occurred during file copy.
  pause
  exit /b 1
)
echo.
echo Project copied to %DEST%.
echo.
echo Next steps:
echo 1. Start Apache and MySQL in XAMPP.
echo 2. Import JobPortal.sql in phpMyAdmin.
echo 3. Visit http://localhost/%TARGET_NAME%/index.php
if exist "%XAMPP_PATH%\xampp-control.exe" (
  echo Launching XAMPP Control Panel...
  start "" "%XAMPP_PATH%\xampp-control.exe"
)
pause
