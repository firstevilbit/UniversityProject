<?php
  $gallery_include .= "
  <script language=JavaScript><!--
     function show (v)
       {
         if (document.all[v])
           {
             var sh = document.body.clientHeight;
             var sw = document.body.clientWidth;
             var st = document.body.scrollTop;
             var sl = document.body.scrollLeft;
             var dh = document.all[v].clientHeight;
             var dw = document.all[v].clientWidth;
             var cy = self.event.clientY;
             var cx = self.event.clientX;

             if (sh < cy+dh+20) cy=sh-dh-20;
             if (sw < cx+dw+20) cx=sw-dw-20;
             document.all[v].style.top=cy+st+16;
             document.all[v].style.left=cx+sl+10;
             document.all[v].style.visibility='visible';
           }
         return false;
       }

     function hide (v)
       {
         if (document.all[v]) document.all[v].style.visibility='hidden';
       }
  // --></script>";
?>