<?
/** 
 * Конфигурация настроек Модуля сайта
 * 
 * @version 1.2
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
         "common"=>[
            "title" => 'Общие',  
            "options"=>[
               'count_nomts'=>[
                  'title'=>'Номинантов',
                  'def'=>'123',
                  'type'=>array("text", "5"),                
                  'comment'=>'Text comment under input 1',        
               ], 
               'count_citys'=>[
                  'title'=>'Городов',
                  'def'=>'28',
                  'type'=>array("text", "5"),    
                  'comment'=>'Text comment under input 2',
               ],
               'info1'=>[
                  'type'=>['info'],
                  'html'=>'Text on the alert block'
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

