<?php    
namespace App\Lib;

require_once __DIR__.'\..\..\uranik\Tools\lib.php';
//require __DIR__.'\..\Lib\lib.php';

class LibWrapper {
    public function getGuid() {
    	return guidv4();
    }
}