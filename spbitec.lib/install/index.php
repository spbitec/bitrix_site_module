<?

global $MESS;
$PathInstall = str_replace("\\", "/", __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen("/index.php"));
IncludeModuleLangFile($PathInstall."/install.php");

if(class_exists("spbitec_lib")) return;

Class spbitec_lib extends CModule
{
    var $MODULE_ID = "spbitec.lib";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";

    function spbitec_lib()
    { 
    	//	global $PathInstall;
    //		include($PathInstall."/version.php");
 
        $this->MODULE_VERSION = '1.1.1';
        $this->MODULE_VERSION_DATE = '2011-11-17 14:00:00';
        $this->MODULE_NAME = GetMessage("MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("MODULE_DESCRIPTION");
    }

    function DoInstall()
    {
    
         global $DOCUMENT_ROOT, $APPLICATION;
        RegisterModule("spbitec.lib");
     //   $APPLICATION->IncludeAdminFile("Установка модуля dev_module", $DOCUMENT_ROOT."/bitrix/modules/dev_module/install/step1.php");        

       /* global $DB, $APPLICATION, $step;
        $FORM_RIGHT = $APPLICATION->GetGroupRight("form");
        if ($FORM_RIGHT=="W")
        {
            $step = IntVal($step);
            if($step<2)
                $APPLICATION->IncludeAdminFile(GetMessage("FORM_INSTALL_TITLE"),
                $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/form/install/step1.php");
            elseif($step==2)
                $APPLICATION->IncludeAdminFile(GetMessage("FORM_INSTALL_TITLE"),
                $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/form/install/step2.php");
        }*/
    }

    function DoUninstall()
    {
      UnRegisterModule("spbitec.lib");
    /*    global $DB, $APPLICATION, $step;
        $FORM_RIGHT = $APPLICATION->GetGroupRight("form");
        if ($FORM_RIGHT=="W")
        {
            $step = IntVal($step);
            if($step<2)
                $APPLICATION->IncludeAdminFile(GetMessage("FORM_UNINSTALL_TITLE"),
                $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/form/install/unstep1.php");
            elseif($step==2)
                $APPLICATION->IncludeAdminFile(GetMessage("FORM_UNINSTALL_TITLE"),
                $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/form/install/unstep2.php");
        }*/
    }

    function GetModuleRightList()
    {
        global $MESS;
        $arr = array(
            "reference_id" => array("D","R","W"),
            "reference" => array(
                GetMessage("FORM_DENIED"),
                GetMessage("FORM_OPENED"),
                GetMessage("FORM_FULL"))
            );
        return $arr;
    }
}
