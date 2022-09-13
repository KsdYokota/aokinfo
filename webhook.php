<?php
$SECRET_KEY = 'JaAaQ55VCE';

echo "GET[key] = ".($_GET['key']);
echo "POST[payload] = ".$_POST['payload'];

if ( isset($_GET['key']) && $_GET['key'] === $SECRET_KEY && isset($_POST['payload']) ) {
  $payload = json_decode($_POST['payload'], true);
  if ($payload['ref'] === 'refs/heads/master') {
    `git pull origin master`;
    echo 'run git pull origin master';
  }
}
else {
  echo 'failed git pull';
}
