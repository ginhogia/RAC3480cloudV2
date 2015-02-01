<?
$filePath = dirname(__FILE__);
require_once($filePath . "/../mod/api.php");
require_once($filePath . "/../mod/page-id.php");
require_once($filePath . "/../mod/job.php");

$session = new Session();
$api = new Api($_GET);

$clubID = $api->param("clubID");


// $page = Page::getPageById(PAGE_ID_JOBQUERY, $api->getSession()->getClub()->getId());
// if (!$page->hasOwner($api->getSession()->getUser()))
// 	$api->returnPermissionDenied();

if ($session->getUser()->isDistrictTeam())	
	$careers = career::getCareersByClub($clubID,true);
else 
	$careers = career::getCareersByClub($clubID,false);


$data = array();
foreach ($careers as $career)
{
	//$data[] = $career->getData();
	if ($career != $careers[0])
	$data[] = $career->getData();
}

echo json_encode($data);

?>