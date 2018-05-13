<?php
header("Content-type: application/json");
//sleep(3000);
echo json_encode(['content'=>md5(time())]);