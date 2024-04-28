<?php
$time = time(); // le timestamp de la date du jour
$formateur = new IntlDateFormatter('fr_FR',IntlDateFormatter::FULL, IntlDateFormatter::SHORT, 'Europe/Paris');

$date = (new \DateTime('2020-08-24', new \DateTimeZone('Europe/Paris')))->format('Y-m-d H:i:s');

echo $formateur->format($time);
echo '<br>';
echo $date;