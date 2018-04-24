# bitrix site_module
===========================================
Site propertys module. Connfigured for every site 

### Install
* Copy Folder to /local/modules/
* Add to /local/modules/php_interface/init.php 
\Bitrix\Main\Loader::includeModule('spbitec.lib');

### Use
1. get Option
`    COption::GetOptionString('spbitec.lib', 'property1');`
2. use lib module
`    \Spbitec\Lib\Iblock::iblock_property_translate();`
