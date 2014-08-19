<?php

$p = printer_open();
printer_set_option($p, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_LETTER);
printer_start_doc($p, "Testpage");
printer_start_page($p);
$pen = printer_create_pen(PRINTER_PEN_SOLID, 3, "000000");
$font = printer_create_font("Courier New", 60, 20, PRINTER_FW_BOLD, false, false, false, 0);

printer_select_pen($p, $pen);
printer_select_font($p, $font);

for ($i = 0; $i < 4600; $i+=100)
{
printer_draw_line($p, $i,0,$i,6700);
printer_draw_text($p,$i/100+1,$i,0);
}
for ($i = 0; $i < 6700; $i+=100)
{
printer_draw_line($p, 0,$i,4600,$i);
printer_draw_text($p,$i/100+1,0,$i);
}

printer_delete_font($font);
printer_delete_pen($pen);
printer_end_page($p);
printer_end_doc($p);
printer_close($p);
?>