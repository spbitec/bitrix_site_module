<?

namespace Spbitec\Lib;

/*
if(\Bitrix\Main\Loader::includeModule('spbitec.lib')) {
\Spbitec\Lib\Iblock::iblock_property_translate();
\Spbitec\Lib\Iblock::getPropertyEnums();
\Spbitec\Lib\Iblock::getSection(); 
}
*/

class Iblock{
static function item_translate($arItem){ //1.1 Òðàíñëèðóåò ìåðîïðèÿòèå äëÿ âûâîäà

$arItem['DETAIL_PAGE_URL']='/'.trim($arItem['DETAIL_PAGE_URL'],'/').'/';
return $arItem;
}


static function iblock_property_translate($property){ //1.1 Òðàíñëèðóåò ìíîæåñòâåííîå ñâîéñòâî ïðèâÿçêè ê ýëåìåíòàì èôíîáëîêà
$ret=array();
foreach ($property['VALUE'] as $valid){
 $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
 $arFilter = Array("IBLOCK_ID"=>$property['LINK_IBLOCK_ID'],"ID"=>$valid); 
 $res = \CIBlockElement::GetList(Array(), $arFilter, false,   $arSelect); 
 while($ob = $res->GetNextElement()){  
    $arFields = $ob->GetFields();   
    $arProps = $ob->GetProperties();            
    $arFields['PROPERTIES']=$arProps;            
    $ret[]=$arFields; 
 }
}        
return $ret;
}

static function iblock_get($iblock_id,$item_id){ //1.1 Транслирует множественное свойство привязки к элементам ифноблока
$ret=array();

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>$iblock_id,"ID"=>$item_id); 
$res = \CIBlockElement::GetList(Array(), $arFilter, false,   $arSelect); 
while($ob = $res->GetNextElement()){  
 $arFields = $ob->GetFields();   
 $arProps = $ob->GetProperties();            
 $arFields['PROPERTIES']=$arProps;            
 $ret=$arFields; 
}

return $ret;
}

/*
* Âîçâðàùàåò ìàññèâ èäåíòèôèêàòîðîâ è çíà÷åíèé ñïèñêîâûõ ñâîéñòâ èíôîáëîêà.
* [:prop_code][:enum_xmlid]=:enum_id
* Íàïðèìåð:
* [prop_accepted][yes]=10
* [prop_accepted][no]=11
* [prop_color][green]=25
* [prop_color][red]=26
*
* Ïàðàìåòðû: $ibId - èäåíòèôèêàòîð èíôîáëîêà (IBLOCK_ID)
*/

static function getPropertyEnums($ibId){
$properties = \CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "PROPERTY_TYPE"=>"L","IBLOCK_ID"=>$ibId));
while ($prop_fields = $properties->GetNext()) {
 $property_enums = \CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$ibId, "CODE"=>$prop_fields['CODE']));
 while($enum_fields = $property_enums->GetNext()){
    $prop[$prop_fields['CODE']][$enum_fields["XML_ID"]]=$enum_fields["ID"];
 } 
}
return $prop;
}

/*
* Âîçâðàùàåò èíôîðìàöèþ î ðàçäåëå èíôîáëîêîâ ñ ïåðåìåííûìè âêëàäêè SEO   
* Ïàðàìåòðû: $sectionId - èäåíòèôèêàòîð ñåêöèè
*/

static function getSectionById($sectionId){
if (!$sectionId) return false;

$section=array();
$res = \CIBlockSection::GetByID($sectionId);

if($section = $res->GetNext()){

 $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
    $section["IBLOCK_ID"],
    $section["ID"]
 );
 $section['IPROPERTY_VALUES']=$ipropValues->getValues();

 return $section;
}  
return false;
}


/*
* Âîçâðàùàåò èíôîðìàöèþ î ðàçäåëå èíôîáëîêîâ ñ ïåðåìåííûìè âêëàäêè SEO   
* Ïàðàìåòðû: $sectionCode - êîä ñåêöèè
*/  

static function getSectionByCode($sectionCode){
if (!$sectionCode) return false;
$res =\CIBlockSection::GetList(false,array('CODE'=>$sectionCode), false,array('UF_*'));
$ar_res = $res->GetNext();
return self::getSectionById($ar_res['ID']);  
}


}

