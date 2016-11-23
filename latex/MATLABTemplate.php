<?php
/**
 * Class for handling numpy2mat
 * 
 * @author Michael Billington < michael.billington@gmail.com >
 */
class MATLABTemplate {
	/**
	 * Generate a .mat file using python and pass it to the user
	 */
	public static function download($python,$username,$moodleid) {
		// Pre-flight checks
		if(($f = tempnam(sys_get_temp_dir(), 'mat-')) === false) {
			throw new Exception("Failed to create temporary file");
		}
	
		$mat_f = $f . ".mat";
	
		// Perform substitution of variables
	
		// Run python
		ob_start();
		$cmd = sprintf("python ".$python." ".$f." ".$username." ".$moodleid);
		chdir(sys_get_temp_dir());
		exec($cmd, $foo, $ret);
	
		// Test here
		if(!file_exists($mat_f)) {
			@unlink($f);
			throw new Exception("Output was not generated and python returned: $ret.");
		}
	
		// Send through output
		$fp = fopen($mat_f, 'rb');
		header('Content-Type: application/x-mat');
		header('Content-Disposition: attachment; filename="data.mat"' );
		header('Content-Length: ' . filesize($mat_f));
		fpassthru($fp);
	
		// Final cleanup
		@unlink($mat_f);
		@unlink($f);
	}
	public static function download1($python,$username,$moodleid) {
		// Pre-flight checks
		if(($f = tempnam(sys_get_temp_dir(), 'zip-')) === false) {
			throw new Exception("Failed to create temporary file");
		}
	
		$mat_f = $f . ".mat";
		$zip_f = $f . ".zip";
		
	
		// Perform substitution of variables
	
		// Run python
		ob_start();
		$cmd = sprintf("python ".$python." ".$f." ".$username." ".$moodleid);
		chdir(sys_get_temp_dir());
		exec($cmd, $foo, $ret);
		print_r($cmd);
	
		// Test here
		if(!file_exists($zip_f)) {
			@unlink($f);
			throw new Exception("Output was not generated and python returned: $ret.");
		}
	
		// Send through output
		// $fp = fopen($zip_f, 'rb');
		// header('Content-Type: application/zip');
		// header('Content-Disposition: attachment; filename="data.zip"' );
		// header('Content-Length: ' . filesize($zip_f));
		// fpassthru($fp);
		
	
		// Final cleanup
		@unlink($mat_f);
		@unlink($zip_f);		
		@unlink($f);
	}
}
?>
