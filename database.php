<?php

try {
  $Oracle = oci_connect("system", "Oscar1432!", "localhost/ORCL");
} catch (PDOException $e) {
  die('Connected failed:' . $e->getMessage());
}
