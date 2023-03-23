<?php
header ('Content-Type: image/png');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo file_get_contents($_REQUEST['img']);