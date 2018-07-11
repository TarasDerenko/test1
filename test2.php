<?php 

/**
 * 
 */
class Person
{
	public $FirstName;
	public $LastName;
	public $BirthDay;

	public function __construct($f,$l,$d)
	{
		$this->FirstName = $f;
		$this->LastName = $l;
		$this->BirthDay = $d;
	}
}


$arr = array(
	new Person('Jon','Travolta','01.01.1966'),
	new Person('Kip','Travolta','02.01.1975'),
	new Person('Met','Travolta','03.01.1982'),
	new Person('Dub','Travolta','04.01.1990'),
	new Person('Ken','Travolta','05.01.1959'),
	new Person('Pit','Travolta','06.01.1967'),
	new Person('Man','Travolta','07.01.1978'),
	new Person('Kel','Travolta','08.01.1993'),
	new Person('Duk','Travolta','09.01.1948'),
	new Person('Oda','Travolta','10.01.1971'),
	new Person('Yan','Travolta','11.01.1980'),
	new Person('Zek','Travolta','12.01.1984'),
	new Person('Jek','Travolta','13.01.1962'),
	new Person('Let','Travolta','14.01.1976'),
	new Person('Pud','Travolta','15.01.1954'),
	new Person('Was','Travolta','16.01.1991'),
	new Person('Ira','Travolta','17.01.1969'),
	new Person('Kol','Travolta','18.01.1968'),
	new Person('Qar','Travolta','19.01.1982'),
	new Person('Xan','Travolta','20.01.1973'),
);

while (true) {
	echo "Enter age! :";
	$input = trim(fgets(STDIN,1024));

	if(is_numeric($input)){
		foreach ($arr as $i => $person) {
			if( (date('Y') - date('Y',strtotime($person->BirthDay))) > $input )
				echo ($i + 1)." : ".$person->FirstName." : ".$person->BirthDay."\n";
		}
		break;
	}


}
?>
<!--
<script>
   var i = 302;
    var time = setInterval(function () {
        window.open(
            'http://localhost/test1.php?file=' + i,
            '_blank' // <- This is what makes it open in a new window.
        );
        i++;
        if(i > 380)
            clearInterval(time);
    },9000);
</script>-->