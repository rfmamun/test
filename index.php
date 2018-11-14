<?php 

/*
17130
26611
*/


$post = [
  'action' =>	'getDrugOthersCompanyDatabaseData',
	'bRegex' =>	false,
	'bRegex_0' =>	false,
	'bRegex_1' =>	false,
	'bRegex_2' =>	false,
	'bRegex_3' =>	false,
	'bRegex_4' =>	false,
	'bRegex_5' =>	false,
	'bSearchable_0' =>	true,
	'bSearchable_1' =>	true,
	'bSearchable_2' =>	true,
	'bSearchable_3' =>	true,
	'bSearchable_4' =>	true,
	'bSearchable_5' =>	true,
	'bSortable_0' =>	false,
	'bSortable_1' =>	true,
	'bSortable_2' =>	true,
	'bSortable_3' =>	true,
	'bSortable_4' =>	true,
	'bSortable_5' =>	false,
	'FilterAll' =>	4,
	'FilterItem' =>	'',
	'iColumns' =>	6,
	'iDisplayLength' =>	10000,
	'iDisplayStart' =>	0,
	'iSortCol_0' =>	2,
	'iSortingCols' =>	1,
	'ManufacturerCategory' =>	'B',
	'mDataProp_0' =>	0,
	'mDataProp_1' =>	1,
	'mDataProp_2' =>	2,
	'mDataProp_3' =>	3,
	'mDataProp_4' =>	4,
	'mDataProp_5' =>	5,
	'sColumns' =>	'',
	'sEcho' =>	3,
	'sSearch' =>	'',
	'sSearch_0' =>	'',
	'sSearch_1' =>	'',
	'sSearch_2' =>	'',
	'sSearch_3' => 	'',
	'sSearch_4' => 	'',
	'sSearch_5' => 	'',
	'sSortDir_0' => 	'asc',
];


$ch = curl_init('http://www.dgda.gov.bd/administrator/components/com_jcode/source/serverProcessing.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
curl_close($ch);

class DBConnection extends PDO {
	public function __construct(){
		$host='localhost';
		$dbname='drag';
		$user='root';
		$pass='';

  parent::__construct("mysql:host=$host;dbname=$dbname", $user, $pass);
  $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 }
}

$conn = new DBConnection();

$response = str_replace("<a href='javascript://' onClick='onClickPriceBtn(", 'yy', $response);
$response = str_replace("'>Price List</a>", '', $response);
$array = json_decode(trim($response), TRUE);
/*
echo "<pre>";
var_dump($array['aaData']);
echo "</pre>";
die();*/
foreach ($array['aaData'] as $key => $value) {
	$value0 = str_replace("'", '&#039;', $value[0]);
	$value1 = str_replace("'", '&#039;', $value[1]);
	$value2 = str_replace("'", '&#039;', $value[2]);
	$value3 = str_replace("'", '&#039;', $value[3]);
	$value4 = str_replace("'", '&#039;', $value[4]);
	$value5 = str_replace("'", '&#039;', $value[5]);

	$sql = "INSERT INTO `homeopathic`( `id`, `manufacturer`, `name`, `type`, `generic_name_strength`, `dar`) VALUES ('".$value0."', '".$value1."', '".$value2."', '".$value3."', '".$value4."', '".$value5."')";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
}

?>

