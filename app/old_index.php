<?php

// Include files

# Settings
require_once('settings.php');

# Views
require_once('view/HTMLView.php');
require_once('view/FormView.php');
require_once('view/NavigationView.php');
require_once('view/RegistrationView.php');

# Controllers
require_once('controller/AppBaseController.php');
require_once('controller/App.php');
require_once('controller/LoginController.php');
require_once('controller/RegistrationController.php');

# Model BLL
require_once('model/BLL/ModelBLL.php');
require_once('model/BLL/User.php');
require_once('model/BLL/UserRegistration.php');

# Model DAL
require_once('model/DAL/ModelDAL.php');
require_once('model/DAL/UsersDAL.php');

# Model services
require_once('model/ExceptionsService.php');
require_once('model/FlashMessageService.php');
require_once('model/ValidationService.php');
require_once('model/AuthService.php');
require_once('model/UserClientService.php');

# Create Application controller object
$app = new \controller\AppController();




