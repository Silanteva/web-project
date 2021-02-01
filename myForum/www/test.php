<!DOCTYPE html PUBLIC "–//W3C//DTD HTML 4.01//EN">
<html><head>
<meta http–equiv="Content–Type" content="text/html; charset=Windows–1251" /><title>Test about Dusseldorf</title>
</head><body>

<div>

 <style>
 body {
 background: #556B2F url(https://img2.goodfon.ru/original/2048x1365/9/9a/germaniia-zamok-les-derevia-osen.jpg);
 }
 </style>

<table border="3" align="center" rules="rows" style="width:60%">

<tr>

<td>




<table border="1" background="http://images/168.png" bgcolor="#FFDAB9" cellpadding="10" style="width:100%;border-radius:5px">

<tr>

<th>

<h1>Control test on your knowledge about Dusseldorf</h1>
<h3>How much have you learnt about it? Let's check</h3>

</th>
</tr>
</table>

<table border="1" bgcolor="#FFDAB9" cellpadding="10" style="width:100%;border-radius:5px">

<tr>

<td rowspan="2" style="width:80%">

<img class="MMImage-Origin" src="https://sigmacard.ru/upload/resize_cache/iblock/bb5/200_80_1/dusseldor_b.png">

<h3>Test about Dusseldorf</h3>
<?php
 $test = array (
  array ('q'=>'Dusseldorf is located in the lower reaches of the Rhein','t'=>'checkbox','a'=>'1'),
  array ('q'=>'Dusseldorf central street - Heinrich Heine alley','t'=>'checkbox','a'=>'0'),
  array ('q'=>'In 1953, the first fashion fair was held in Dusseldorf','t'=>'checkbox','a'=>'0'),
  array ('q'=>'The most visited attraction of the city is the Film Museum','t'=>'checkbox','a'=>'1'),  
  array ('q'=>'Dusseldorf consists of 10 urban districts','t'=>'checkbox','a'=>'1'), 
  array ('q'=>'Dusseldorf has the largest Japanese community in Europe','t'=>'checkbox','a'=>'1'),
  array ('q'=>'The height of the Rheinturm TV tower - 260 meters','t'=>'checkbox','a'=>'0'),
  array ('q'=>'The original coat of arms of the city is represented by an anchor','t'=>'checkbox','a'=>'1'),
  array ('q'=>'Dusseldorf is one of the most economically developed cities in the Rhine-Ruhr region','t'=>'checkbox','a'=>'1'),  
  array ('q'=>'Choose the correct statements ','t'=>'multiselect',
   'i'=>'The population is almost 600,000 people|Currency - Euro|One-time ticket for 30 minutes costs 3.2 euros','a'=>'1|1|0')
 );
 if (!empty($_POST['action'])) { //считаем правильные и выводим резюме
  $ball = 0;
  foreach ($test as $key=>$val) {
   switch ($val['t']) {
    case 'checkbox':
     if (isset($_POST[$key]) and $val['a']==1 or !isset($_POST[$key]) and $val['a']==0) $ball++;
    break;
    case 'multiselect':
     $i = explode ('|',$val['a']);
     $cnt = 0;
     foreach ($i as $number=>$answer)
      if (isset($_POST[$key.'_'.$number]) and $answer==1 or 
        !isset($_POST[$key.'_'.$number]) and $answer==0) $cnt++;
     if ($cnt==count($i)) $ball++;
    break;
   }
  }
  $p = round ($ball/count($test)*100);
  echo '<p>Right answers: '.$ball.' of '.count($test).', '.$p.'%.</p>';
  echo '<p><a href="'.$_SERVER['PHP_SELF'].'">One more time!</a></p>';
 }
 else { //предложить форму
  echo '<p>Check the correct statements or enter an answer or select the correct option from the list.</p>';
  $counter = 1;
  echo '<form method="post">';
  foreach ($test as $key=>$val) {
   error_check ($val);
   echo ($counter++).'. ';
   switch ($val['t']) {
    case 'checkbox':
     echo $val['q'].' <input type="checkbox" name="'.$key.'" value="1">';
    break;
    case 'multiselect':
     $i = explode ('|',$val['i']);	 
     echo $val['q'].':&nbsp;&nbsp;&nbsp;';
     foreach ($i as $number=>$item)
      echo $item.' <input type="checkbox" name="'.$key.'_'.$number.'" value="1">&nbsp;&nbsp;&nbsp;';
    break;
   }
   echo '<br>';
  }

  echo '<input type="submit" name="action" value="Answer"></form>';
 }

 function error_check ($q) {
  $question_types = array ('checkbox', 'text', 'select', 'multiselect');
  $error = '';
  if (!isset($q['q']) or empty($q['q'])) $error='There is no question text or it is empty';
  else if (!isset($q['t']) or empty($q['t'])) $error='Question type not specified or empty';
  else if (!in_array($q['t'],$question_types)) $error='Invalid question type specified';
  else if (!isset($q['a']) or empty($q['a']) and $q['a']!='0') $error='No response text or it is empty';
  else {
   if ($q['t']=='checkbox' and !($q['a']=='0' or $q['a']=='1')) 
    $error = 'The switch allowed 0 or 1 responses';
   else if ($q['t']=='select' || $q['t']=='multiselect') {
    if (!isset($q['i']) or empty($q['i'])) $error='List items not specified';
    else {
     $i = explode ('|',$q['i']);
     if (count($i)<2) $error='There are no at least 2 items in the delimited choice list |';
     foreach ($i as $s) if (strlen($s)<1) { $error = 'The answer is shorter than 1 character'; break; }
     else {
      if ($q['t']=='multiselect' ) {
       $a = explode ('|',$q['a']);
       if (count($i)!=count($a)) $error='The number of statements and responses does not match';
       foreach ($a as $s) if ($s!='0' and $s!='1') { 
        $error = 'Statement not marked true or false'; break; 
       }
      }
     }
    }
   }
  }
  if (!empty($error)) {
   echo '<p>Found a test error: '.$error.'</p><p>Debug information: </p>';
   print_r ($q);
   exit;
  }
 }
 
 function strlwr_($s){
  $hi = "ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ";
  $lo = "abcdefghijklmnopqrstuvwxyzабвгдеёжзийклмнопрстуфхцчшщъыьэюя";
  $len = strlen ($s);
  $d='';
  for ($i=0; $i<$len; $i++) {
   $c = substr($s,$i,1);
   $n = strpos($c,$hi); 
   if ($n!==FALSE) $c = substr ($lo,$n,1);
   $d .= $c;
  }
  return $d;
 }
?>

<h2>    </h2>

<img src="https://img-fotki.yandex.ru/get/2/109064684.127/0_8b807_c710c254_XL.jpg" alt="https://img-fotki.yandex.ru/get/2/109064684.127/0_8b807_c710c254_XL.jpg" class="shrinkToFit" width="535" height="356">

</td>

<td bgcolor="#FFDAB9" align = "center">
<h3>Emblem of Dusseldorf</h3>
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/DEU_Wuppertal_COA.svg/200px-DEU_Wuppertal_COA.svg.png" alt="https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/DEU_Wuppertal_COA.svg/200px-DEU_Wuppertal_COA.svg.png" class="transparent">
<h2>    </h2>
The original coat of arms of the city, 
containing only an anchor, was created 
simultaneously with the receipt of city 
rights by Dusseldorf. The anchor symbolized 
the connection between the city and its inhabitants 
with the Rhine and Rhine shipping. 
</td>
</tr>

<tr>

<td bgcolor="#FFDAB9" align = "center" >
<img src="https://i.pinimg.com/236x/9b/35/46/9b3546001e5ebc034372ff75fc69447a.jpg" alt="https://i.pinimg.com/236x/9b/35/46/9b3546001e5ebc034372ff75fc69447a.jpg">

<h2>Learn more about Germany</h2>
<div><a href="https://www.dw.com/ru/%D1%82%D0%B5%D0%BC%D1%8B-%D0%B4%D0%BD%D1%8F/s-9119" target="_blank">
<div>Dusseldorf - center of fashion</div>
<div>Situated in Germany</div>
<div>All the traditions</div>
<div>Education abroad and more</div>
<div>Learning Deutsch easily</div>
<div>Listening and reading</div>
</div></div></a></div>

</td>
</tr>
</table>




<table border="2" bgcolor="#FFDAB9" height="100" cellpadding="10" style="width:100%;border-radius:5px">

<tr>

<th>
<h3>Dusseldorf is a giant city, a large industrial, 
transport and cultural center in the west of Germany, 
which is not so often included in guidebooks, and in 
vain! This is where the trendiest boutiques, the most 
luxurious restaurants and the funniest streets are located.</h3>

</th>
</tr>
</table>

</td>
</tr>
</table>
</div>


</body></html>