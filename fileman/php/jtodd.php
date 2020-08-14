<?php
logScriptVars();
// ini_set('max_execution_time', 9000);
function logScriptVars(){
    log_rr([
        '##########################@' => '###########################',
        'SCRIPT' => $_SERVER["SCRIPT_FILENAME"],
        'GET' => $_GET,
        'POST' => $_POST,
        'FILES' => $_FILES,
        '@##########################' => '###########################'
    ]);
}

function tsLog($phase)
{
    $ts = time();
    if (!array_key_exists('running_ts', $GLOBALS)) {
        $GLOBALS['running_ts'] = [];
        $passed = 0;
        $total = 0;
    } else {
        $passed = $ts - end($GLOBALS['running_ts'])['ts'];
        $total = $ts - $GLOBALS['running_ts'][0]['ts'];
    }
    $GLOBALS['running_ts'][] =
        [
            'total' => $total,
            'step' => $passed,
            'phase: ' => $phase,
            'ts' => $ts,
        ];

    log_r(end($GLOBALS['running_ts']));
}

log_r('');
log_r('');
tsLog(str_replace('/', '|', $_SERVER['REQUEST_URI']));

/*

    YOU CAN USE THIS HELPER TO PRINT DATA TO THE SCREEN
    COMMENT OUT ANY LOADING OF VIEWS FIRST.

*/

function print_object($data)
{
    if (!empty($data)) :
        echo 'Code: <br />' . "\n";
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        echo '<br />--------------------';
    else :
        echo 'CODE: The object is empty';
    endif;
}

function rrd($data)
{
    print_rr($data);
    die();
}

function print_rr($data)
{
    print_object($data);
}

/*
    CREATE AN ARRAY OF ARRAYS TO LOOP THROUGH AND PRINT TO SCREEN
    SO DATA[ARRAY] => OBJECT , DATA[ARRAY] => OBJECT
*/

function print_multiple_objects($data)
{

    echo 'Code: <br />' . "\n";
    //used for counting
    $i = 1;

    foreach ($data as $array) {
        if (!empty($array)) :
            echo 'Array[' . $i . ']:<br />';
            echo '<pre>';
            print_r($array);
            echo '</pre>';
            echo '===================<br />';
            //increment
            $i = $i + 1;
        else :
            echo 'Array[' . $i . ']: The Object is empty. Moving On';
        endif;
    }
    //ending
    echo '<br />--------------------';
}

/*
    DUMP SINGLE OBJECT TO SCREEN
*/

function dump_object($data)
{
    echo 'Dump Code: <br />' . "\n";
    echo '<pre>';
    if (!empty($data)) :
        var_dump($data);
    else :
        echo 'The Object is empty';
    endif;
    echo '<pre>';
    echo '<br />----------------------';
}

/*
    CREATE AN ARRAY OF OBJECTS TO LOOP THROUGH AND DUMP TO SCREEN
    SO DATA[ARRAY] => OBJECT, DATA[ARRAY] => OBJECT
*/
function dump_multiple_objects($data)
{

    echo 'Code: <br />' . "\n";
    //used for counting
    $i = 1;

    foreach ($data as $array) {
        if (!empty($array)) :
            echo 'Array[' . $i . ']:<br />';
            echo '<pre>';
            var_dump($array);
            echo '<pre>';
            echo '===================<br />';
            //increment
            $i = $i + 1;
        else :
            echo 'Array[' . $i . ']: The Object is empty.';
        endif;
    }
    //ending
    echo '<br />--------------------';
}

function log_path()
{
    return __DIR__ . '/log.txt';
}

function log_rr($obj)
{
    $path = log_path();

    $log = date('Y-m-d H:i:s', time()) . ": " . print_r($obj, true) . "\n";

    file_put_contents($path, $log, FILE_APPEND);
}

function log_r($text)
{
    $path = log_path();

    if (!is_string($text) && !is_numeric($text)) {
        $text = json_encode($text);
    }
    $log = date('Y-m-d H:i:s', time()) . ": " . $text . "\n";

    file_put_contents($path, $log, FILE_APPEND);
}

function sqlTable($sql, $params = [])
{
    selectToTable(jtSelect($sql, $params));
}

function selectToTable($rows)
{
    if ($rows === null || count($rows) == 0) {
        print "no data";
        return;
    }
    print "<table border='1'>";
    print "<tr><td></td>";
    foreach ($rows[0] as $header => $value) {
        print "<th>{$header}</th>";
    }
    print "</tr>";

    $r = 0;
    foreach ($rows as $row) {
        $r++;
        print "<tr>";
        print "<td>{$r}</td>";
        foreach ($row as $value) {
            print "<td>{$value}</td>";
        }
        print "</tr>";
    }

    print "</table>";
}

function collectionToArray($collection)
{
    $collectionArray = [];
    foreach ($collection as $id => $thing) {
        $array = $thing->toArray();
        foreach ($array as $key => $value) {
            if (!in_array($key, ['id', 'name'])) {
                unset($array[$key]);
            }
        }
        $collectionArray[$id] = $array;
    }
    return $collectionArray;
}

if (!function_exists('dd')) {
    function dd($data)
    {
        rrd($data);
    }
}

if (!function_exists('dump')) {
    function dump($data)
    {
        print_rr($data);
    }
}
