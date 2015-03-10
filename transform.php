<?
// courtesy http://stackoverflow.com/questions/684587/batch-script-to-replace-php-short-open-tags-with-php/1647429#1647429
// short open above because must have short open on while parsing

/**
 *
 *
 *
 find . -name "*.php" -exec php -d short_open_tag=On "./transform.php" "{}"+
 *
 *
 */

if(php_sapi_name() !== 'cli')
    die('empty');

if(count($argv) < 2)
    die("must provide file arg\n\n");

foreach(array_slice($argv,1) as $file) {
    if(__FILE__ === realpath($file))
        continue;
    
    echo " ... processing $file ... \n";

    $content = file_get_contents($file);
    $tokens = token_get_all($content);
    $output = '';

    foreach($tokens as $token) {
        if(is_array($token)) {
            list($index, $code, $line) = $token;
            switch($index) {
                case T_OPEN_TAG_WITH_ECHO :
                    $output .= '<?= ';
                    break;
                case T_OPEN_TAG :
                    $output .= '<?php ';
                    break;
                default :
                    $output .= $code;
                    break;
            }

        } else {
            $output .= $token;
        }
    }
    file_put_contents($file, $output);
}
?>
