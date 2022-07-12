<?php

function render($archivo, $arrVars = [])
{
    extract($arrVars);
    include $archivo;
}