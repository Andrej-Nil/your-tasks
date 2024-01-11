<?php
$db = \classes\App::get(\classes\Db::class);
$auth = \classes\App::get(\classes\Auth::class);
$title = "Your Tasks";
$page = $_GET['page'] ?? 1;
$perPage =9;

$user = $auth->get();
$values = [$user['id'], 'completed', 'cancelled'];
$totalPage = $db->query("SELECT COUNT(*) FROM `tasks` WHERE `user_id`=? AND `status` NOT IN (?, ?)", $values)->getColumn();
$pagination = new \classes\Pagination((int)$page, $perPage, $totalPage);

$start = $pagination->getStart();
$links = $pagination->getLinks();

$tasks = $db->query("SELECT * FROM `tasks` WHERE `user_id`=? AND `status` NOT IN (?, ?) ORDER BY `id` DESC LIMIT $start, $perPage", $values)->findAll();
$notes = $db->query("SELECT * FROM `notes` WHERE `user_id`=? ORDER BY `id` DESC", [$user['id']])->findAll();

require_once VIEWS . '/home.tpl.php';

