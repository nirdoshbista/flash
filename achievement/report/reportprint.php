<?php
class ReportPrint{
	
	private $template = array();
	private $lines = array();

	private $hardprint;
	
	private $printer_handle;
	
	private $total_rows=64;
	private $total_cols=95;
	
	private $line_count=1;
	
	private $repeat_height=0;
	
	private $page_num = 1;
	
	private $laser = true;
	
	function __construct($template_file, $printer=false){
		
		$this->hardprint = $printer;
		
		$template_content = file_get_contents($template_file);
		$template_lines = explode("\n",$template_content);
		
		$heading='';
		foreach ($template_lines as $line){
			if (preg_match('/[ ]*#/',$line)) continue;
			if (trim($line)=='') continue;

			if (preg_match('/[ ]*\[.*\]/',$line)){
				$heading = trim(preg_replace('/[ ]*\[(.*)\]/','$1',$line));
			}
			else if ($heading!='') $this->template[$heading][]=$line;
		}
		
		if ($this->hardprint) $this->initialize_printer();
		
		// create text buffer
		for ($i=0;$i<$this->total_rows;$i++) $this->lines[$i] = '';
		
	}
	
	function __destruct(){
		
		$this->flush();
		
		if ($this->hardprint) {
			printer_delete_font($this->font);
			
			printer_end_page($this->printer_handle);			
			printer_end_doc($this->printer_handle);			
			
			printer_close($this->printer_handle);
		}
	}
	
	private function initialize_printer(){
		$this->printer_handle = printer_open();
		
		if ($this->laser){
			$this->font = printer_create_font("Courier New", 90, 45, PRINTER_FW_BOLD, false, false, false, 0);
			printer_select_font($this->printer_handle, $this->font);
			
			// start doc n page
			printer_set_option($this->printer_handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_LETTER);
			printer_start_doc($this->printer_handle, "Flash Achievement");
			printer_start_page($this->printer_handle);			
		}
		
		if (count($this->template['printer-option'])>0){
			foreach($this->template['printer-option'] as $l){
				if (substr($l,0,3)=='row') $this->total_rows = (int)(substr($l,4));
				if (substr($l,0,3)=='col') $this->total_cols = (int)(substr($l,4));
			}
		}
	}
	
	
	private function replace_variable($text, $data){
		$data['page_num'] = $this->page_num;
		
		preg_match('/\{\w+\}/',$text,$matches);
		
		foreach ($matches as $m){
			$varname = substr($m,1,strlen($m)-2);
			$text = str_replace($m, $data[$varname],$text);
		}
		return $text;
		
	}
	
	public function add_non_repeat($data){
		
		$data['hr']=str_repeat('-',$this->total_cols);
		
		foreach ($this->template['non-repeat'] as $line){
			$text = substr($line, 0,strpos($line,'~'));
			$options = explode(',',substr($line,strpos($line,'~')+1));
			$r = $options[0];
			$c = $options[1];
			$l = $options[2];
			$a = $options[3];
			
			$text = $this->replace_variable($text, $data);
			
			$this->add_line($text,$r, $c, $l, $a);
			
			if ($r>$this->line_count) $this->line_count = $r;
		}
		$this->line_count++;
	}
	
	public function add_repeat($data){
		
		if (count($this->template['repeat'])==0) return;
		
		if ($this->line_count > ($this->total_rows-$this->repeat_height+1)) {
			$this->page_break();
			$this->add_non_repeat($data);
		}
		
		$data['hr']=str_repeat('-',$this->total_cols);
		$max = 0;
		
		foreach ($this->template['repeat'] as $line){
			$text = substr($line, 0,strpos($line,'~'));
			$options = explode(',',substr($line,strpos($line,'~')+1));
			
			if ($options[0]>$max) $max = $options[0];
			
			$r = $this->line_count+$options[0]-1;
			$c = $options[1];
			$l = $options[2];
			$a = $options[3];
			
			$text = $this->replace_variable($text, $data);
			
			$this->add_line($text,$r, $c, $l, $a);
		}		
		
		$this->line_count += ($max);
		
		$this->repeat_height = $max;
	}
	
	private function add_line($text, $r, $c, $l, $a){
		$r=$r-1;
		
		$text = substr($text,0,$l);
		
		if ($a=='r') $text = str_pad($text,$l,' ', STR_PAD_LEFT);
		elseif  ($a=='c') $text = str_pad($text,$l,' ', STR_PAD_BOTH);
		else $text = str_pad($text,$l,' ');
		
		$this->lines[$r]=str_pad($this->lines[$r],$this->total_cols,' ');
		$this->lines[$r]=substr($this->lines[$r],0,$c-1).$text.substr($this->lines[$r],$c+strlen($text)-1);
		
		if ($this->laser && $this->hardprint)
			printer_draw_text($this->printer_handle, $text, (int)(($c-5)/1.973684+6)*100, $r*100);
			
	}
	
	public function page_break(){
		$this->flush();
		$this->line_count = 1;
		$this->page_num++;
	}
	
	public function reset_page_num(){
		$this->page_num = 1;
	}
	
	public function flush(){
		
		if ($this->line_count==1) return;
		
		for ($i=0;$i<$this->total_rows;$i++) $page .=($this->lines[$i]."\r\n");
		
		if ($this->hardprint){
			
			if ($this->laser){
			
				// end page
				printer_end_page($this->printer_handle);			
			
				// start page again
				printer_start_page($this->printer_handle);
				
			}
			else{
				printer_write($this->printer_handle,$page);
			}
		}
		else{		
			echo $page;
			echo "\n-- End of page --\n\n";
		}
		
		for ($i=0;$i<$this->total_rows;$i++) $this->lines[$i] = '';	
		
		$this->line_count = 1;
	}
	
	
		
}

/*
$test = new ReportPrint('marksheet.txt');
$test->add_non_repeat(array('nm_sch'=>'Test School','sch_num'=>'010010001', 'class'=>'8'));
$test->flush();
*/
