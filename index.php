<?php

function loadClass($class)
{
   require 'public/models/' . ucfirst($class) . '.php';
}
spl_autoload_register('loadClass');

$bdd = BDD::dbConnect();

require 'public/views/classed.php';