<?php

  function conectar()
  {
    return pg_connect("host=localhost user=ricardo password=tortilla
                       dbname=datos");
  }
