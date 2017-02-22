<?php 
header("Content-Type: text/plain");
//Set URL to wsdl service, i forget once in awhile to update this so it will turn evil if you dont
$url = '';


if(strlen($url) < 5)
{
	print("I cannot let you do that human...");
    return -1;
}
$client = new SoapClient($url);


$functions = array();
$types = array();
$structs = array();
$params = array();

//Store the functions from the wsdl
foreach($client->__getFunctions() as $function)
{
    $func = array(
        'name'     => null,
        'params'   => null,
        'response' => null
    );
    $f = explode(" ", $function,2);
    $func['response'] = $f[0];
    $func['name']     = substr($f[1], 0, strpos($f[1], "("));
    $functions[$func['name']] = $func;
}

foreach($client->__getTypes() as $type)
{
    //These are actual structures that we want to turn into an array/class or something
    if( substr($type,0,6) === 'struct')
    {
        $struct = substr($type,7,strlen($type)-7);
        $struct = substr($struct, 0,strpos($struct, " {"));
        $e1 = explode("\n", $type);
        $e1 = array_splice($e1,1,-1);
        foreach($e1 as $info)
        {
            list($space, $type, $name) = explode(" ", $info);
            $name = rtrim($name,";");
            $params[$struct][$name] = $type;
        }
        //If this is  FUNCTION we DO NOT want to create another class, 
        //We simpily want to add the correct class parameters to it

        if(in_array($struct,array_keys($functions))){
            $pr = (isset($params[$struct])) ? $params[$struct] : "";
            $functions[$struct]['params'] = $pr;
            //unset($params[$struct]);
        }
    }
    else
    {
        //These are all most likely junk for now, but better keep them around for now
        list($type, $name) = explode(" ", $type);
        $types[$name] = $type; 
    }
}


/*
echo "Types: <br>";
var_dump($types);
echo "<br><br>Params: <br>";
echo "<br><br>Functions: <br>";
var_dump($functions);
*/

foreach($functions as $key => $fun)
{
    if(empty($fun['params'])) {
        continue;
    }
    foreach($fun['params'] as $k => $p)
    {
        if(in_array($p,array_keys($params)))
        {
            $functions[$key]['params'][$k] = array_keys($params[$p]);
            //unset($params[$p]);
        }
    }
}

//Below here is just outputting the code

echo "<?php\n";
echo "class test \n{\n\n";
echo "    protected \$client = null;

    public function __construct(\$url = '{$url}', \$context = array())
    {
        \$this->client = new SoapClient(\$url, \$context);
    }\n\n";

foreach($params as $k => $v)
{
    echo "\tprivate \${$k} = array(\n\t\t'".implode("' => null,\n\t\t'", array_keys($v))."' => null\n\t);\n\n";
}

foreach($params as $k => $v)
{
	echo "\tpublic function set{$k}( \$".implode(", $", array_keys($v)) . " ){\n\n";
	foreach(array_keys($v) as $t)
	{
		echo "\t\t\$this->{$k}['{$t}'] = \${$t};\n";
	}
	echo "\t\treturn \$this->{$k};\n"; 	
		
	echo "\t}\n\n";
}

foreach($functions as $k => $v)
{
    $fParams = $v['params'];
    $paramStr = "";
    $inputStr = "";
    if(!empty($fParams))
    {
        $paramStr = '$'.implode(", $",array_keys($fParams));
        $inputStr = "array( ";
        foreach(array_keys($fParams) as $pk)
        {
            $inputStr .= "'$pk' => \${$pk},";
        }
        $inputStr = rtrim($inputStr, ", ");
        $inputStr .= " )";
    }
    echo "
    public function {$k}( {$paramStr} )
    {
        \$r = \$this->client->{$k}( {$inputStr} );
        return \$r->{$k}Result; 
    }";
}
echo "\n}";
