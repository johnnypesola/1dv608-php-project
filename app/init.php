<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 13:21
 */

session_start();

require_once 'settings.php';

// Core files
require_once 'core/Controller.php';
require_once 'core/View.php';
require_once 'core/ModelBLL.php';
require_once 'core/ModelDAL.php';

// Model
require_once 'model/ValidationService.php';
require_once 'model/FlashMessageService.php';
require_once 'model/BLL/AppSettings.php';
require_once 'model/CtrlHelperService.php';

// View
require_once 'view/HtmlView.php';

// Controller
require_once 'core/AppCtrl.php';