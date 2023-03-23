<?php

require_once '../../Libs/php/Conect.class.php';
$db = new Conect;

$joson = $db->Sql("SELECT
* 
FROM 
cipm9206_patrulharural.trackingvtr 
WHERE
id in (SELECT max(id) from cipm9206_patrulharural.trackingvtr where DATE_FORMAT(trackingvtr.dth,'%d/%m/%y') = DATE_FORMAT(CURRENT_DATE(),'%d/%m/%y') GROUP BY prefixo,nrfone)
ORDER BY id DESC");
//SELECT * FROM servico WHERE DATE(entrada) = CURRENT_DATE 
//[{"prefixo":"vtr 1590","dth":"2021-01-12 18:55:24","latitude":"37.4219983","longitude":"-122.084","nrfone":" 15555215556"},{"prefixo":"vtr 1590","dth":"2021-01-12 18:55:24","latitude":"37.4219983","longitude":"-122.084","nrfone":" 15555215556"},{"prefixo":null,"dth":null,"latitude":null,"longitude":null,"nrfone":null}]


echo json_encode($joson, JSON_UNESCAPED_UNICODE);
