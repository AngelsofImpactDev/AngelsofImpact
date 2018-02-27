<?php
 include('ue-config/ue-globalconfig.php');if($ue_globvar_https_enabled){$protocol='https';}else{$protocol='http';}$defaultFormat='Sitemap: '.$protocol.'://'.$globvar_address.'/sitemap.xml
User-agent: *
Allow: /';header('Content-type: text/plain');echo $defaultFormat;?>