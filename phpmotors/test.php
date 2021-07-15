<?php
// $myArray = array('1 Nephi', new DateTime('600-01-01'), 14, 'Jerusalem', 70);
// $myArray["test"] = 6;
// echo "\n\n$myArray[0]";
// echo $myArray["test"];
$myArray0 = array('1 Nephi', '2021-05-15', 14, 'Jerusalem', 70);
$myArray1 = array('2 Nephi', True, '2021-07-04', 1024, 'Pizza');
$my2DArray = array($myArray0, $myArray1);


// var_dump($my2DArray);
echo "<table style='border: 1px solid black;'>";
for ($i=0; $i < 2; $i++) {
   echo "<tr style='border: 1px solid black;'>";
   for ($j=0; $j < 5; $j++) {
      echo "<td style='border: 1px solid black;'>";
      echo $my2DArray[$i][$j];      
      echo "</td>";
   }
   echo "</tr>";
}
echo "</table>";
?>