<?
/** 
 * Конфигурация настроек Модуля сайта
 * 
 * @version 1.1
 * 
 * Example: COption::GetOptionString('spbitec.lib', 'property1');
 * 
 * Файл конфигурации опций модуля 
 * При инсталляции копируется в /local/config/ для модификаций
 * 
 * Example:
 * 
 * */

$spbitecLibCfg=[
   'options'=>[
      'tabs'=>[
         "vote"=>[
            "title" => 'Голосование',  
            "options"=>[
               'vote'=>[
                  'title'=>'Режим голосования',
                  'def'=>'',
                  'type'=>array("checkbox", "Y"),             
               ]             
            ]
         ],
         "stat"=>[
            "title" => 'Статистика',  
            "options"=>[
               'count_nomts'=>[
                  'title'=>'Номинантов',
                  'def'=>'123',
                  'type'=>array("text", "5"),                
               ], 
               'count_citys'=>[
                  'title'=>'Городов',
                  'def'=>'28',
                  'type'=>array("text", "5"),                 
               ],
               'count_noms'=>[
                  'title'=>'Номинаций',
                  'def'=>'7',
                  'type'=>array("text", "5"),            
               ]
            ]
         ]
      ]         
   ]
];

