# Installing the HumusUser Module for Zend Framework 2
The simplest way to install is to clone the repository into your /vendor directory add the
HumusBase key to your modules array before your Application module key.

  1. cd my/project/folder
  2. git clone git://github.com/prolic/HumusUser.git vendor/HumusUser
  3. open my/project/folder/configs/application.config.php
  4. add 'HumusUser' to your 'modules' parameter AFTER 'HumusBase'