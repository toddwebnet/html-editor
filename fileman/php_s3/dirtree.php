<?php
require "new_functions.php";

$obj = new \App\Services\Api\S3ApiService();
print $obj->dirtree();