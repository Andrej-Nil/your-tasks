<?php
$db = \classes\App::get(\classes\Db::class);
$title = "Your Tasks";

$page = $_GET['page'] ?? 1;
$perPage =9;
$totalPage = $db->query("SELECT COUNT(*) FROM `tasks` WHERE `status` NOT IN ('completed', 'cancelled')")->getCount();
$pagination = new \classes\Pagination((int)$page, $perPage, $totalPage);

$start = $pagination->getStart();
$links = $pagination->getLinks();

$tasks = $db->query("SELECT * FROM `tasks` WHERE `status` NOT IN ('completed', 'cancelled') ORDER BY `date_creating` DESC LIMIT $start, $perPage")->findAll();

require_once VIEWS . '/home.tpl.php';

