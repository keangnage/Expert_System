<?php

function syntax_check($filename)
{
	$myfile = fopen($filename, "r");
	while(!feof($myfile))
	{
	  $array = explode("#", fgets($myfile));
	  $line = trim($array[0]);
	  if (strlen($line) == 0)
	  {}
	  elseif (substr($line, 0, 1) == "=")
	  {
		  $test = str_split($line);
		  foreach ($test as $value) {
				if ($value == "=")
				{}
				else if ($value == " ")
				{}
				else if (ctype_upper ($value))
				{}
				else
					return false;
		  }
		  $GLOBALS['ifacts'] = $line;
	  }
	  else if (substr($line, 0, 1) == "?")
	  {
		  $test = str_split($line);
		  foreach ($test as $value) {
				if ($value == "?")
				{}
				else if ($value == " ")
				{}
				else if (ctype_upper ($value))
				{}
				else
					return false;
		  }
		  $GLOBALS['query'] = $line;
	  }
	  else
	  {
		  $test = str_split($line);
		  $ischar = 0;
		  for ($i = 0; $i != count($test); $i++)
		  {
			while ($test[$i] == " " || $test[$i] == "(" && $ischar == 0 || $test[$i] == ")" && $ischar == 1)
			 $i++;
			if ($ischar == 0)
			{
				if ($test[$i] == "!")
					$i++;
				if (ctype_upper ($test[$i]))
					{}
				else {
					return (false);
				}
				$ischar = 1;
			}
			else
			{
				switch ($test[$i])
				{
						case '+':
							break;

						case '|':
							break;

						case '^':
							break;

						case '<':
							$i++;
							if ($test[$i] != "=")
								return false;
						case '=':
							$i++;
							if ($test[$i] != ">")
								return false;
							break;

						default:
							return (false);
							break;
				}
				$ischar = 0;
			}
		  }
		  $GLOBALS['rules'][] = $line;
	  }
	}
	fclose($myfile);
	return (true);
}

?>
