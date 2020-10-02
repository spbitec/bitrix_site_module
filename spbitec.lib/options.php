<?
if(!$USER->IsAdmin())
   return;
   
   /**
    * get Option COption::GetOptionString('spbitec.lib', 'property1');
    * use lib module \Spbitec\Lib\Iblock::iblock_property_translate();
    * */
$module_id = "spbitec.lib";
$RIGHT = $APPLICATION->GetGroupRight($module_id);
if (! ($RIGHT >= "R"))
   $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
ClearVars();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
IncludeModuleLangFile(__FILE__);
CModule::IncludeModule($module_id);

require_once($_SERVER["DOCUMENT_ROOT"].'/local/config/spbitec.lib.cfg.php');

  

$aTabs=$spbitecLibCfg['options']['tabs'];
$tcTabs=[];
$tcTabsIdx=1;
foreach ($spbitecLibCfg['options']['tabs'] as $tabCode=>$tab){
   $tcTabs[]=[
      "DIV" => "tabId_{$tabCode}", 
      "TAB" => $tab['title'], 
      "TITLE" => $tab['header']?$tab['header']:$tab['title'],       
      //"ICON" => $tab, 
   ];
   $aTabsIdx++;
}
$tcTabs[]=["DIV" => "tanId_rights", "TAB" => GetMessage("MAIN_TAB_RIGHTS"), "ICON" => "#MODULE_CODE_LOWER#", "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS")];


$tabControl = new CAdminTabControl("tabControl", $tcTabs);

if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid()){
   if(strlen($RestoreDefaults)>0){
      COption::RemoveOption($module_id);
   }else{      
      foreach($aTabs as $tabCode=>$aTab){
         foreach($aTab['options'] as $arOptionCode=>$arOption){
            $name=$arOptionCode;
            $val=$_REQUEST[$name];
            if($arOption['def'][0]=="checkbox" && $val!="Y")
               $val="N";
            COption::SetOptionString($module_id, $name, $val, $arOption['title']);
         }
      }
      ob_start();
      require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
      ob_end_clean();
   }
   if(strlen($Update)>0 && strlen($_REQUEST["back_url_settings"])>0)
      LocalRedirect($_REQUEST["back_url_settings"]);
   else
      LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
}
?>

<?$tabControl->Begin();?>
<?
/*
$arAllOptions=[];
foreach ($spbitecLibCfg['options']['params'] as $name=>$param){
   $arAllOptions[]=[$name,$param['title'],$param['def'],$param['type']];
}
*/
?>

<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&lang=<?echo LANGUAGE_ID?>">

   <? foreach($aTabs as $tabCode=>$aTab):?>

      <?$tabControl->BeginNextTab();?>

      <?
 
      foreach($aTab['options'] as $arOptionCode=>$arOption):
      $val = COption::GetOptionString($module_id, $arOptionCode, $arOption['def']);
 
      ?>
      <tr>
         <td width="20%" nowrap <?if($arOption['type'][0]=="textarea") echo 'class="adm-detail-valign-top"'?>>
            <label for="<?echo htmlspecialcharsbx($arOptionCode)?>"><?echo $arOption['title']?>:</label>
         <td width="80%">
            <? if($arOption['type'][0]=="checkbox"):?>
            <input type="checkbox" id="<?echo htmlspecialcharsbx($arOptionCode)?>" name="<?echo htmlspecialcharsbx($arOptionCode)?>" value="Y"<?if($val=="Y")echo" checked";?>>
            <? elseif($arOption['type'][0]=="text"):?>
            <input type="text" size="<?echo $arOption['type'][1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($arOptionCode)?>">
            <? elseif($arOption['type'][0]=="textarea"):?>
            <textarea rows="<?echo $arOption['type'][1]?>" cols="<?echo $arOption['type'][2]?>" name="<?echo htmlspecialcharsbx($arOptionCode)?>"><?echo htmlspecialcharsbx($val)?></textarea>
            <? endif?>
         </td>
      </tr>
      <? endforeach?>
   
   <? endforeach?>
   <?$tabControl->BeginNextTab();?>
   
     <? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
     
     
     
   <?$tabControl->Buttons();?>

   <input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
   <input type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
   <?if(strlen($_REQUEST["back_url_settings"])>0):?>
   <input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" on click="window.location='<?echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
   <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
   <?endif?>
   <input type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" On Click="return confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
   <?=bitrix_sessid_post();?>
   <?$tabControl->End();?>
</form>