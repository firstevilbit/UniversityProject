<?php
/* Скин. Версия 1.0
                               EvilBit(C)
*/
##############################################
##  Статические части сайта                 ##
##############################################

  if ($content == '') $content.='Страница была удалена или не существовала!!!';

echo '
<HTML>
<HEAD>
<TITLE>АГТА.RU - Ангарская Государственная Техническая Академия</TITLE>
<META http-equiv=Content-Type content=\"text/html; charset=utf-8\">
<LINK href='.$sub_directory.'/style.css type=text/css rel=STYLESHEET>';

if ($menu_style == 'js')
  {
    echo "<script language=\"JavaScript\">
    <!--

    var TIMER_SLIDE = null;
    var OBJ_SLIDE;
    var OBJ_VIEW;
    var PIX_SLIDE = 10; //this is the amount of slide/DELAY_SLIDE
    var NEW_PIX_VAL;
    var DELAY_SLIDE = 15; //this is the time between each call to slide
    var DIV_HEIGHT = 22; //value irrelevant
    var SUB_MENU_NUM =0;
    var RE_INIT_OBJ = null;
    var bMenu = document.getElementById(\"curMenu\");
    var MainDiv,SubDiv

    //DD added code
    document.write('<font class=MenuButtonU2><div id=\"tempcontainer\" class=\"MenuWidth\" style=\"visibility: hidden; position: absolute\"></div></font>')

    function Init(objDiv)
    {
        if (TIMER_SLIDE == null)
        {
            SUB_MENU_NUM = 0;
            MainDiv = objDiv.parentNode;
            SubDiv =  MainDiv.getElementsByTagName(\"DIV\").item(0);
            SubDiv.onclick = SetSlide;

            OBJ_SLIDE = MainDiv.getElementsByTagName(\"DIV\").item(1)
            OBJ_VIEW = OBJ_SLIDE.getElementsByTagName(\"DIV\").item(0);

                                    document.getElementById(\"tempcontainer\").innerHTML=MainDiv.getElementsByTagName(\"DIV\").item(2).innerHTML //DD added code
                                    DIV_HEIGHT=document.getElementById(\"tempcontainer\").offsetHeight //DD added code

            for (i=0;i<OBJ_VIEW.childNodes.length;i++)
            {
                if (OBJ_VIEW.childNodes.item(i).tagName == \"SPAN\")
                {
                    SUB_MENU_NUM ++;
                    OBJ_VIEW.childNodes.item(i).onmouseover= ChangeStyle;
                    OBJ_VIEW.childNodes.item(i).onmouseout= ChangeStyle;
                }
            }

                  NEW_PIX_VAL = parseInt(MainDiv.getAttribute(\"state\"));
        }

    }
    function SetSlide()
    {
                            if (window.TIMER_SLIDE) clearInterval(TIMER_SLIDE) //DD added code
          if (TIMER_SLIDE == null && this.parentNode == MainDiv)
                TIMER_SLIDE = setInterval('RunSlide()', DELAY_SLIDE);
          else
          {
              RE_INIT_OBJ = this;
              setTimeout('ReInit()', 200);
          }
    }

    function ReInit(obj)
    {
        Init(RE_INIT_OBJ);
        TIMER_SLIDE = setInterval('RunSlide()', DELAY_SLIDE);
        RE_INIT_OBJ = null;
    }

    function RunSlide()
    {

        if (OBJ_VIEW.getAttribute(\"state\") == 0)
        {

            NEW_PIX_VAL += PIX_SLIDE;
            OBJ_SLIDE.style.height = NEW_PIX_VAL;

            if (NEW_PIX_VAL >= DIV_HEIGHT) //DD modified code
            {
                clearInterval(TIMER_SLIDE);
                TIMER_SLIDE = null;
                OBJ_VIEW.style.display = 'inline';
                OBJ_VIEW.setAttribute(\"state\",\"1\")
                MainDiv.setAttribute(\"state\",NEW_PIX_VAL);
            }
        } else
        {
            OBJ_VIEW.style.display = 'none';
            NEW_PIX_VAL -= PIX_SLIDE;
            if(NEW_PIX_VAL > 0)OBJ_SLIDE.style.height = NEW_PIX_VAL;
            if (NEW_PIX_VAL <= 0)
            {
                NEW_PIX_VAL = 0;
                OBJ_SLIDE.style.height = NEW_PIX_VAL
                clearInterval(TIMER_SLIDE);
                TIMER_SLIDE = null;
                OBJ_VIEW.setAttribute(\"state\",\"0\")
                MainDiv.setAttribute(\"state\",NEW_PIX_VAL);
            }
        }
    }

    function ChangeStyle()
    {
        if (this.className == this.getAttribute(\"classOut\"))
            this.className = this.getAttribute(\"classOver\");
        else
            this.className = this.getAttribute(\"classOut\");
    }

    //-->
    </script>";
  }

echo "
</HEAD>

<body leftMargin=0 topMargin=0>
   
<center>
<TABLE cellSpacing=0 cellPadding=0 height=100% border=0>
  <TR>
    <TD bgcolor=#000000 width=1></TD><TD>

<TABLE cellSpacing=0 cellPadding=0 width=999 height=100% border=0>
  <TR>
    <TD colSpan=3>
      <IMG src=".$sub_directory."/image/skin_head.jpg width=999 height=119></TD>
    </TD>
  </TR>
  <TR>
    <TD width=210></TD>
    <TD width=3 background=".$sub_directory."/image/skin_20.gif valign=top></TD>
    <TD>&nbsp;&nbsp;$addres</TD>
  </TR>
  <TR>
    <TD background=".$sub_directory."/image/skin_10.gif></TD>
    <TD background=".$sub_directory."/image/skin_20.gif valign=top></TD>
    <TD background=".$sub_directory."/image/skin_10.gif height=3></TD>
  </TR>
  <TR>
    <TD width=210>
      <TABLE cellSpacing=0 cellPadding=10 border=0>
        <TR>
          <td>
            $menu_include
          </td>
        </tr>
        <TR>
          <td align=center><br><br><br>

          ";
            include("inc_counter.js");
     echo  "
          </td>
        </tr>
        <TR>
          <td align=center><br><br><br>
            <a href=http://fcior.edu.ru/ target=_blank><img src=".$sub_directory."/image/banner_fcior.gif width=170 height=65 border=0></a><br><br>
            <a href=http://katalog.iot.ru/ target=_blank><img src=".$sub_directory."/image/banner_kat.gif width=170 height=60 border=0></a><br><br>
            <a href=http://school-collection.edu.ru/ target=_blank><img src=".$sub_directory."/image/banner_sch-coll.gif width=170 height=33 border=0></a>
          </td>
        </tr>
      </TABLE>
    </TD>
    <TD width=3 background=".$sub_directory."/image/skin_20.gif valign=top></TD>
    <TD width=786 vAlign=top height=100%>
      <TABLE cellSpacing=10 cellPadding=0 border=0 width=100%>
        <TR>
          <TD vAlign=top><br>$content</TD>
        </TR>
      </TABLE>
    </TD>
  </TR>
  <TR>
    <TD></TD>
    <TD width=3 background=".$sub_directory."/image/skin_20.gif>
    <TD align=right><IMG src=".$sub_directory."/image/skin_27.gif width=66 height=66></TD>
  </TR>
  <TR>
    <TD height=24 background=".$sub_directory."/image/skin_21.gif></TD>
    <TD><IMG src=".$sub_directory."/image/skin_22.gif width=5 height=24></TD>
    <TD>
      <TABLE width=100% cellSpacing=0 cellPadding=0 border=0>
        <tr>
          <td background=".$sub_directory."/image/skin_21.gif width=100%></td>
          <td><IMG src=".$sub_directory."/image/skin_23.gif width=270 height=24></td>
          <td><a href=#><IMG src=".$sub_directory."/image/skin_24.gif width=21 height=24 border=0></a></td>
          <td><IMG src=".$sub_directory."/image/skin_25.gif width=99 height=24></td>
        </TR>
      </table>
    </TD>
  </TR>
  <TR>
    <TD colspan=3 align=right><IMG src=".$sub_directory."/image/skin_26.gif width=390 height=22></TD>
  </TR>
</TABLE>

</TD><TD bgcolor=#000000 width=1></TD>
  </TR>
</TABLE>

</center>

</BODY>

</HTML>";

?>
