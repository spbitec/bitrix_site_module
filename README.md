# 1C-Bitrix Universal site module
Site propertys and common library module. Connfigured for every site 
[Spbitec ltd.](http://spbitec.ru "Spbitec ltd.") 2018

### Install
* Copy Folder to **/local/modules/**
* Add to **/local/modules/php_interface/init.php**
`\Bitrix\Main\Loader::includeModule('spbitec.lib');`

### Use
1. get Option `COption::GetOptionString('spbitec.lib', 'property1');`
2. use lib module `\Spbitec\Lib\Iblock::iblock_property_translate();`

### Classes
- **Iblock** - Bitrix iblock translate functions
- **CRedirector** - Redirect pages by regular expressions list in XML file 
