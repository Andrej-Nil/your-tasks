<?php

$id = (int)$_GET['id'] ?? 0;



$task = $db->query("SELECT * FROM tasks WHERE id=? LIMIT 1", [$id])->findOrFail();

require_once VIEWS . '/task/show.tpl.php' ;