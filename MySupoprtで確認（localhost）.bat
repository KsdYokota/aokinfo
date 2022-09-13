set mysupport="%PROGRAMFILES(x86)%\MySupport\MySupport3.exe"
rem ngrokをつかって、8000ポートをHTTP化しておく必要があります。
set url="http://afe5e072.ngrok.io/channels/feed?draft=1"
%mysupport% selxml=%url%
