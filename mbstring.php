<?php

namespace PMVC\PlugIn\mbstring;

use PMVC\PlugIn;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\mbstring';

class mbstring extends PlugIn
{
    public function __call($method, $args)
    {
      $mbFunc = 'mb_'.\PMVC\camelCase($method, '_');
      if (function_exists($mbFunc)) {
        return call_user_func_array($mbFunc, $args);
      } else {
        return parent::__call($method, $args);
      }
    }
}
