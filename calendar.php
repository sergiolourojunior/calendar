<?php

define('ANO_ATUAL', isset($_GET['y']) && is_numeric($_GET['y']) ? $_GET['y'] : date('Y'));
define('MES_ATUAL', isset($_GET['m']) && is_numeric($_GET['m']) ? $_GET['m'] : date('m'));
define('DIA_ATUAL', date('d'));

$dias_mes_anterior = date('N',strtotime(ANO_ATUAL.'-'.MES_ATUAL.'-01'));

for($i=0;$i<$dias_mes_anterior;$i++){ $array[]=''; }
for($i=1;$i<=date('t');$i++){ $array[]=$i; }

$array = array_chunk($array,7);

$return['actual']['year'] = date('Y');
$return['actual']['month'] = date('m');
$return['actual']['day'] = date('d');

$return['active']['year'] = ANO_ATUAL;
$return['active']['month'] = MES_ATUAL;

$return['next']['year'] = date('Y', strtotime('+1 months', strtotime(date(ANO_ATUAL.'-'.MES_ATUAL))));
$return['next']['month'] = date('m', strtotime('+1 months', strtotime(date(ANO_ATUAL.'-'.MES_ATUAL))));

$return['prev']['year'] = date('Y', strtotime('-1 months', strtotime(date(ANO_ATUAL.'-'.MES_ATUAL))));
$return['prev']['month'] = date('m', strtotime('-1 months', strtotime(date(ANO_ATUAL.'-'.MES_ATUAL))));

$return['title'] = date('F Y', strtotime(ANO_ATUAL.'-'.MES_ATUAL));
$return['dates'] = $array;

$return['debug']['get'] = $_GET;

echo json_encode($return);

?>