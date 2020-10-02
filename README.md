# 1C-Bitrix Universal site module
Site propertys and common library module. Connfigured for every site 
[Spbitec ltd.](http://spbitec.ru "Spbitec ltd.") 2018

### Install
* Copy Folder **spbitec.lib** to **/local/modules/**
* Go ro `/bitrix/admin/partner_modules.php?lang=ru` and install **spbitec.lib** module
* Find settings in `/bitrix/admin/settings.php?lang=ru&mid=spbitec.lib&mid_menu=1`

For use lib Classes
* Add to **/local/php_interface/init.php**
`\Bitrix\Main\Loader::includeModule('spbitec.lib');`

### Configure
* Copy /config/spbitec.lib.cfg.php to /local/config/spbitec.lib.cfg.php
* Use php array $spbitecLibCfg=[] to configure tabs and ooptions

### Using
1. get Option `COption::GetOptionString('spbitec.lib', 'property1');`
2. use lib module `\Spbitec\Lib\Iblock::iblock_property_translate();`

### Classes
- **Iblock** - Bitrix iblock translate functions
- **CRedirector** - Redirect pages by regular expressions list in XML file 
