<?php
require_once 'PHPExcel\Classes\PHPExcel.php';
require_once 'PHPExcel\Classes\PHPExcel\IOFactory.php';

define("DB_SERVER", "localhost");
define("DB_USER", "admin");
define("DB_PASS", "password");
define("DB_NAME", "cpwd");

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

if(mysqli_connect_errno())
{
	die("Database connection failed: " .
	mysqli_connect_error() .
	"(" . mysqli_connect_errno() . ")"
	);
}

if(isset($_POST['submit'])&&!empty($_FILES['fileToUpload']['name']))
{
$invalid = 0;
$namearr = explode(".",$_FILES['fileToUpload']['name']);
if(end($namearr) != 'xls' && end($namearr) != 'xlsx')
{
echo '<p> Invalid File </p>';
$invalid = 1;
}

if($invalid != 1)
{
// Upload the file to the current folder
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$response = move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_file); 


//$rowvalue=$_POST['row'];

if($response)
{

try {
$inputFileType = PHPExcel_IOFactory::identify($target_file);

$sheetname = 'Abstract';

/**  Create a new Reader of the type defined in $inputFileType  **/ 

$objReader = PHPExcel_IOFactory::createReader($inputFileType); 
$objReader->setReadDataOnly(true);

/**  Load $target_file to a PHPExcel Object  **/ 

$objPHPExcel = $objReader->load($target_file);

} catch(Exception $e) {
die('Error : Unable to load the file : "'.pathinfo($_FILES['fileToUpload']['name'],PATHINFO_BASENAME).'": '.$e->getMessage());
}
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(8);
    $worksheetTitle     = $objWorksheet->getTitle();
    $highestRow         = $objWorksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $objWorksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    //echo "<br>The worksheet ".$worksheetTitle." has ";
    //echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
    //echo ' and ' . $highestRow . ' row.';
	
	
	$recovobjWorksheet = $objPHPExcel->setActiveSheetIndex(9);
    $recovworksheetTitle     = $recovobjWorksheet->getTitle();
    $recovhighestRow         = $recovobjWorksheet->getHighestRow(); // e.g. 10
    $recovhighestColumn      = $recovobjWorksheet->getHighestColumn(); // e.g 'F'
    $recovhighestColumnIndex = PHPExcel_Cell::columnIndexFromString($recovhighestColumn);
    $recovnrColumns = ord($recovhighestColumn) - 64;
    //echo "<br>The worksheet ".$recovworksheetTitle." has ";
    //echo $recovnrColumns . ' columns (A-' . $recovhighestColumn . ') ';
    //echo ' and ' . $recovhighestRow . ' row.';
 
 
 //declaring variables 
 $val1=array();
 $val2=array();
 $valreal1 = array();
 $valreal2 = array();
 $recovval1=array();
 $recovval2=array();
 $highestnonzeroRow = $highestRow-1;
 $recovhighestnonzeroRow = $recovhighestRow-1;
 
    for ($row = 1; $row <= $highestRow; ++$row) {
		echo '<tr>';
         
		 //for reading values of the second column
		$cellclm2 = $objWorksheet->getCellByColumnAndRow(1,$row);
			$val1[$row][0] = $cellclm2->getFormattedValue();
			//echo $column1[$row-300][0];
		
		// for reading values of all columns
		for ($col = 2; $col <= $highestColumnIndex-5; ++$col) {
            $cell = $objWorksheet->getCellByColumnAndRow($col,$row);
			$val2[$row][$col] = $cell->getFormattedValue();
		}
        echo '</tr>';	
	}
	
	for ($recovrow = 1; $recovrow <= $recovhighestRow; ++$recovrow) {
		echo '<tr>';
         
		 //for reading values of the second column
		$recovcell = $recovobjWorksheet->getCellByColumnAndRow(1,$recovrow);
			$recovval1[$recovrow][0] = $recovcell->getFormattedValue();
		
		// for reading values of all columns
		for ($recovcol = 2; $recovcol <= $recovhighestColumnIndex; ++$recovcol) {
            $recovcell1 = $recovobjWorksheet->getCellByColumnAndRow($recovcol,$recovrow);	
			$recovval2[$recovrow][$recovcol] = $recovcell1->getFormattedValue();	
        }
        echo '</tr>';	
	} 
}   
   //for converting two dimensional array $val1 into one dimensional array $valreal1 
	$j= 1;
    for ($j =1;$j<=$highestRow;++$j){
	      $valreal1[$j] = $val1[$j][0];
	}
	//for converting two dimensional array $val2 into one dimensional array $valreal2
	$k= 1;
    for ($i =1;$i<=$highestRow;++$i){
       for($a = 2;$a<=8;++$a){
	      $valreal2[$k] = $val2[$i][$a];
		  ++ $k;
	}
	}
	
	//for converting two dimensional array $recovval1 into one dimensional array $recovvalreal1
	$m= 1;
    for ($m =1;$m<=$recovhighestRow;++$m){
	      $recovvalreal1[$m] = $recovval1[$m][0];
	}
	
	//for converting two dimensional array $recovval2 into one dimensional array $recovvalreal2
	$n= 1;
    for ($g =1;$g<=$recovhighestRow;++$g){
       for($f = 2;$f<=8;++$f){
	      $recovvalreal2[$n] = $recovval2[$g][$f];
		  ++ $n;
	}
	}
	//print_r($recovvalreal1);
	
	//print_r($recovvalreal2);
     
	//empty the table sheet and create a new one
	 $sql = "TRUNCATE TABLE sheet";
	 $result = mysqli_query($connection,$sql);
	 if(!$result){
				     echo 'error Truncating'.mysqli_error($connection);
				 }
	
	
	//empty the table recovsheet and create a new one				  
	$sql = "TRUNCATE TABLE recovsheet";
	 $result = mysqli_query($connection,$sql);
	 if(!$result){
				   echo 'error Truncating'.mysqli_error($connection);
			     }				  
	//inserting values into table sheet						  	
	for($i= 1;$i <=$highestnonzeroRow; ++$i){
		 $b=(7*$i)-2;
		 $c=(7*$i)-1;
		 $d=(7*$i);
		$sql = "INSERT INTO sheet (description,amount,aopb,sp) VALUES ('$valreal1[$i]','$valreal2[$b]','$valreal2[$c]','$valreal2[$d]')";
	    $result = mysqli_query($connection,$sql);
	}
	if(!$result){
			      echo 'failure in inserting values in table sheet'.mysqli_error($connection);
				}
	//inserting values into table recovsheet		
	for($i= 1;$i <=$recovhighestnonzeroRow; ++$i){
		 $b=(7*$i)-5;
		 $c=(7*$i)-3;
		 $d=(7*$i)-1;
		$sql = "INSERT INTO recovsheet (recovtype,nowtoberecov,totalrecov,netpay) VALUES ('$recovvalreal1[$i]','$recovvalreal2[$b]','$recovvalreal2[$c]','$recovvalreal2[$d]')";
	    $result = mysqli_query($connection,$sql);
	}
	if(!$result){
				   echo 'failure in inserting values in table recovsheet'.mysqli_error($connection);
				}
    //extracting values from worksheet Abstract				
    
	
	//Less amount of previous bill
	//$rowla[amount]
    $sql = "SELECT * FROM sheet WHERE MATCH(description) AGAINST ('Less Amount of')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowla = mysqli_fetch_array($result);
			   } else{
					   echo 'extraction of Less amount of previous bill failed '.mysqli_error($connection);
				}
	//print_r($rowla);
	
	//work done in this bill
	//$rowwd[amount]
	$sql = "SELECT * FROM sheet WHERE MATCH(description) AGAINST ('Work Done in this bill')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowwd = mysqli_fetch_array($result);
			   } else{
					   echo 'extraction of work done in this bill failed'.mysqli_error($connection);
				}
	//print_r($rowwd);
	
	//secured advance
	//$rowsa[amount]
	$sql = "SELECT * FROM sheet WHERE MATCH(description) AGAINST ('Amount of Secured Advance in this Bill')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowsa = mysqli_fetch_array($result);
			   } else{
					   echo 'extraction of secured advance failed'.mysqli_error($connection);
				}
	//print_r($rowsa);
	
	//extracting values from worksheet recovery
	
	//security deposit
	//$rowsd[nowtoberecov]
	$sql = "SELECT * FROM recovsheet WHERE MATCH(recovtype) AGAINST ('Now to be recovered')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowsd = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of security deposit failed'.mysqli_error($connection);
				}
	//print_r($rowsd);
	
	//income tax
	//$rowit[nowtoberecov]
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE MATCH(recovtype) AGAINST ('Income Tax')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowit = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of income tax failed'.mysqli_error($connection);
				}
	//print_r($rowit);
	
	//income tax final
	//$rowitf[nowtoberecov]
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE recovid = $rowit[0]+2";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowitf = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of income tax final failed'.mysqli_error($connection);
				}
	//print_r($rowitf);
	
	//education cess
	//$rowecess[nowtoberecov]
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE MATCH(recovtype) AGAINST ('Education Cess')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowecess = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of education cess failed'.mysqli_error($connection);
				}
	//print_r($rowecess);

	//cess for intermediate and higher
	//$rowecessh[nowtoberecov]
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE MATCH(recovtype) AGAINST ('Cess for intermediate and higher edu')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowecessh = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of cess for intermediate and higher failed'.mysqli_error($connection);
				}			
	//print_r($rowecessh);
	
	//sales tax
	//$rowst[nowtoberecov]
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE MATCH(recovtype) AGAINST ('Sales Tax')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowst = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of sales tax failed'.mysqli_error($connection);
				}
	//print_r($rowst);			
	

    //sales tax final
	//$rowstf[nowtoberecov]	
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE recovid = $rowst[0]+2";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowstf = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of sales tax final failed'.mysqli_error($connection);
				}			
	//print_r($rowstf);	
	
	
	//contractor labour welfare fund
	//$rowclwf[nowtoberecov]	
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE MATCH(recovtype) AGAINST ('Contractor labour welfare fund')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowclwf = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of contractor labour welfare fund failed'.mysqli_error($connection);
				}
	//print_r($rowclwf);	
	
	
	//withheld for mile
	//$rowwms[nowtoberecov]
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE MATCH(recovtype) AGAINST ('Withheld for Mile stone')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowwms = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of withheld for mile failed'.mysqli_error($connection);
				}
	//print_r($rowwms);		
	
    
    //withheld for mile final
	//$rowwmsf[nowtoberecov]	
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE recovid = $rowwms[0]+2";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowwmsf = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of withheld for mile final failed'.mysqli_error($connection);
				}	
    //print_r($rowwmsf);

	
	//withheld for SE's inspection
	//$rowwsi[nowtoberecov]
	$sql = "SELECT recovid,nowtoberecov FROM recovsheet WHERE recovid = $rowwms[0]+5";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rowwsi = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of withheld for SEs inspection failed'.mysqli_error($connection);
				}	
    //print_r($rowwsi);
     

	//netpayble
	//$rownp[nowtoberecov],$rownp[totalrecov],$rownp[netpay]
	 $sql = "SELECT recovid,nowtoberecov,totalrecov,netpay FROM recovsheet WHERE MATCH(recovtype) AGAINST ('Net Payable')";
	$result = mysqli_query($connection,$sql);
	if($result){
				 $rownp = mysqli_fetch_array($result);
				} else{
					   echo 'extraction of netpayble failed'.mysqli_error($connection);
				}
    //print_r($rownp);				

	
	echo "<table border='1'>
<tr>
<th>id</th>
<th>Less amount from previous Bill</th>
<th>Gross Amount</th>
<th>Secured Advance</th>
<th>Adv. Pmt.</th>
<th>Total Amount On which TDS Deducted</th>
<th>Security Deposit</th>
<th>Income Tax</th>
<th>Edu. Cess</th>
<th>Edu. Cess for higher and intm</th>
<th>Sales tax</th>
<th>Contractor labour welfare fund</th>
<th>Withheld for Mile stone</th>
<th>Total Recoveries</th>
<th>Net Payable</th>
</tr>";

	
  echo "<tr>";
  echo "<td>" . 1 . "</td>";
  echo "<td>" . $rowla[amount] . "</td>";
  echo "<td>" . $rowwd[amount] . "</td>";
  echo "<td>" . $rowsa[amount] . "</td>";
  echo "<td>" . 0 . "</td>";
  echo "<td>" . $rownp[nowtoberecov] . "</td>";
  echo "<td>" . $rowsd[nowtoberecov] . "</td>";
  echo "<td>" . $rowitf[nowtoberecov] . "</td>";
  echo "<td>" . $rowecess[nowtoberecov] . "</td>";
  echo "<td>" . $rowecessh[nowtoberecov] . "</td>";
  echo "<td>" . $rowstf[nowtoberecov] . "</td>";
  echo "<td>" . $rowclwf[nowtoberecov] . "</td>";
  echo "<td>" . $rowwmsf[nowtoberecov] . "</td>";
  echo "<td>" . $rownp[totalrecov] . "</td>";
  echo "<td>" . $rownp[netpay] . "</td>";
  echo "</tr>";
 
}
}
mysqli_close($connection);
?>