<?php

if (isset($_POST['day'])) $day = trim($_POST['day']);
else $day = 1;
if (isset($_POST['month'])) $month = trim($_POST['month']);
else $month = 2;
if (isset($_POST['year'])) $year = trim($_POST['year']);
else $year = 7;
if (isset($_POST['hours'])) $hours = trim($_POST['hours']);
else $hours = 1;
if (isset($_POST['mins'])) $mins = trim($_POST['mins']);
else $mins = 1;

echo "<HTML>
<HEAD>
<TITLE>MoBitAir.h15.Ru</TITLE>
<META http-equiv=Content-Type content=\"text/html; charset=windows-1251\">
<LINK href=/style.css type=text/css rel=STYLESHEET>

<script>
function select()
  {
    document.getdate.month[0].text = document.getdate.month[$month].text;
    document.getdate.month[0].value = document.getdate.month[$month].value;
  }
</script>

</HEAD>
<BODY leftMargin=0 topMargin=0 onload=select()>
<CENTER>
<font face=verdana size=3 color=#808080><b>Конвертирование даты в Unix формат.</b><br><br>

<TABLE cellSpacing=0 cellPadding=5 border=1>
  <TR>
    <form action=/getdate.php name=getdate method=POST>
      <TD style=\"color: 808080; font: 10px\">
        <CENTER>
        <B>День:</B> <INPUT type=text name=day maxlength=2 size=2 value='$day'>
        <B>Месяц:</B> <select name='month'>
          <option>Выбирете месяц</option>
          <option value='1'>Январь</option>
          <option value='2'>Февраль</option>
          <option value='3'>Март</option>
          <option value='4'>Апрель</option>
          <option value='5'>Май</option>
          <option value='6'>Июнь</option>
          <option value='7'>Июль</option>
          <option value='8'>Август</option>
          <option value='9'>Сентябрь</option>
          <option value='10'>Октябрь</option>
          <option value='11'>Ноябрь</option>
          <option value='12'>Декабрь</option>
        </select>
        <B>Год:</B> 200<INPUT type=text name=year maxlength=1 size=1 value='$year'><BR>
        <B>Часов:</B> <INPUT type=text name=hours maxlength=2 size=2 value='$hours'>
        <B>Минут:</B> <INPUT type=text name=mins maxlength=2 size=2 value='$mins'><BR><BR>
        <INPUT type=submit value=Сгенерировать>
        </CENTER>
      </TD>
    </form>
  </TR>
</TABLE><br>";

if (!empty($day) AND !empty($month) AND !empty($year)  AND !empty($hours)  AND !empty($mins))
  {
    if (@!checkdate($month, $day, $year)) echo "Вы ввели не верные параметры!<br><br>";
    else echo mktime($hours, $mins, 1, $month, $day, $year).'<br><br>';
  }

echo "
</font>
</CENTER>
</BODY>
</HTML>";

?>
