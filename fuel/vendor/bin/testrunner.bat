@ECHO OFF
SET BIN_TARGET=%~dp0/../piece/stagehand-testrunner/bin/testrunner
php "%BIN_TARGET%" %*
