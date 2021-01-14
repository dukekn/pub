<?php



abstract class ObjectFactory_URI
{

    /**
     * @return object website base path
     * example http://localhost/subfolder
     */

    public static function getBasePath($path = null)
    {

        $currentPath  = $_SERVER['PHP_SELF'];
        $pathInfo     = pathinfo($currentPath);
        $hostName     = $_SERVER['HTTP_HOST'];
        $protocol     = 'http';

        if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {

            $protocol = 'https';
        }

        // returns: http://example.com
        if($path != ''){return $protocol.'://'.$hostName.rtrim($pathInfo['dirname'],'/')."/".$path;}
        else {
            return $protocol.'://'.$hostName.rtrim($pathInfo['dirname'],'//');
        }
    }
    /**
     * @return object website root
     * example http://localhost
     */
    public static function getRootUrl($pth = ''){
        $domain = $_SERVER['HTTP_HOST'];
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
        $path = str_replace( basename($_SERVER['SCRIPT_FILENAME']), '', $_SERVER['PHP_SELF'] );
        $url = $protocol.'://'.$domain;
        if(mb_substr($url, -1, 1) == '/' || mb_substr($url, -1, 1) == '\\'){
            $url = mb_substr($url, 0, -1);
        }
        if($pth != ''){
            return $url.'/'.$pth;
        }
        else {
            return $url;
        }

    }

    public function getCurrentUrl($currentDir)
    {
        return rtrim($currentDir, '.php');
    }

    public static function uri_segment($n)
    {
        $segs = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        return count($segs)>0&&count($segs)>=($n-1)?$segs[$n]:'';
    }

    public static function uri_segment_last($url)
    {
        $path = parse_url($url, PHP_URL_PATH); // to get the path from a whole URL
        $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
        $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

        return end($pathTokens); // get the last segment
    }

}