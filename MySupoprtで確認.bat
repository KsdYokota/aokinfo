set mysupport="%PROGRAMFILES(x86)%\MySupport\MySupport3.exe"
set url="https://aok-net.jp/mysupport/app_info_center/public/channels/feed?draft=1"
REM set url="https://aok-net.jp/mysupport/app_info_center/public/channels/yosakoi"  root版

%mysupport% selxml=%url%
