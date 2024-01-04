<?php
$db = \classes\App::get(\classes\Db::class);
$title = title('Задачи');

$page = $_GET['page'] ?? 1;
$perPage = 9;
$totalPage = $db->query("SELECT COUNT(*) FROM `tasks`")->getCount();
$pagination = new \classes\Pagination((int)$page, $perPage, $totalPage);

$start = $pagination->getStart();
$links = $pagination->getLinks();
//print_arr($links);
//die;


$tasks = $db->query("SELECT * FROM `tasks` ORDER BY `date_creating` DESC LIMIT $start, $perPage")->findAll();
require_once VIEWS . '/task/index.tpl.php';