<?
if(!$USER->IsAdmin())
   return;
$module_id = "spbitec.lib";
$RIGHT = $APPLICATION->GetGroupRight($module_id);
if (! ($RIGHT >= "R"))
   $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
ClearVars();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
IncludeModuleLangFile(__FILE__);
CModule::IncludeModule($module_id);

$arAllOptions = array(
   array("parameter1", GetMessage("PARAMETR1"), "default", array("checkbox", "Y")),
   array("parameter2", GetMessage("PARAMETR2"), "default", array("text", "5")),

);
$aTabs = array(
   array("DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => "#MODULE_CODE_LOWER#", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
   array("DIV" => "edit2", "TAB" => GetMessage("MAIN_TAB_RIGHTS"), "ICON" => "#MODULE_CODE_LOWER#", "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS")),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);

if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid())
{
   if(strlen($RestoreDefaults)>0)
   {
      COption::RemoveOption($module_id);
   }
   else
   {
      foreach($arAllOptions as $arOption)
      {
         $name=$arOption[0];
         $val=$_REQUEST[$name];
         if($arOption[2][0]=="checkbox" && $val!="Y")
            $val="N";
         COption::SetOptionString($module_id, $name, $val, $arOption[1]);
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
$tabControl->Begin();
?>



<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&lang=<?echo LANGUAGE_ID?>">
   <?$tabControl->BeginNextTab();?>
   <?
   foreach($arAllOptions as $arOption):
   $val = COption::GetOptionString($module_id, $arOption[0], $arOption[2]);
   $type = $arOption[3];
   ?>
   <tr>
      <td width="40%" nowrap <?if($type[0]=="textarea") echo 'class="adm-detail-valign-top"'?>>
         <label for="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo $arOption[1]?>:</label>
      <td width="60%">
         <?if($type[0]=="checkbox"):?>
         <input type="checkbox" id="<?echo htmlspecialcharsbx($arOption[0])?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
         <?elseif($type[0]=="text"):?>
         <input type="text" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($arOption[0])?>">
         <?elseif($type[0]=="textarea"):?>
         <textarea rows="<?echo $type[1]?>" cols="<?echo $type[2]?>" name="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo htmlspecialcharsbx($val)?></textarea>
         <?endif?>
      </td>
   </tr>
   <?endforeach?>
   <?$tabControl->BeginNextTab();
                   require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
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