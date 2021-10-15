# 1C-Bitrix Universal site module
Site propertys and common library module. Connfigured for every site 
[Spbitec ltd.](http://spbitec.ru "Spbitec ltd.") 2018

### Install
* git clone https://github.com/spbitec/bitrix_site_module.git
* Copy Folder **spbitec.lib** to **/local/modules/**
* Copy Folder **spbitec.lib/config** to **/local/**
* Go to `/bitrix/admin/partner_modules.php?lang=ru` and install **spbitec.lib** module
* Find settings in `/bitrix/admin/settings.php?lang=ru&mid=spbitec.lib&mid_menu=1`
* Add to **/local/php_interface/init.php**
`\Bitrix\Main\Loader::includeModule('spbitec.lib');`

### Configure
* Check or copy **/config/spbitec.lib.cfg.php** to **/local/config/spbitec.lib.cfg.php**
* Use php array **$spbitecLibCfg=[]** to configure tabs and ooptions
 
### Using
1. get Option `COption::GetOptionString('spbitec.lib', 'property1');`
2. use lib module `\Spbitec\Lib\Iblock::iblock_property_translate();`

### Classes
- **Iblock** - Bitrix iblock translate functions
- **CRedirector** - Redirect pages by regular expressions list in XML file 

## Configure options
`
$spbitecLibCfg=[
   'options'=>[
      'tabs'=>[
         "vote"=>[
            "title" => 'Tab title 1',  
            "options"=>[
               'vote'=>[
                  'title'=>'Setting title 1.1',
                  'def'=>'',
                  'type'=>array("checkbox", "Y"),             
               ]             
            ]
         ],
         "stat"=>[
            "title" => 'Tab title 2',  
            "options"=>[
               'count_nomts'=>[
                  'title'=>'Setting title 2.1',
                  'def'=>'123',
                  'type'=>array("text", "5"),                
               ]
            ]
         ]
      ]         
   ]
];

`



