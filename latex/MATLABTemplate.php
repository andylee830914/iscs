<?php
/**
 * Class for handling latex templating
 * 
 * @author Michael Billington < michael.billington@gmail.com >
 */
class MATLABTemplate {
	/**
	 * Generate a PDF file using xelatex and pass it to the user
	 */
	public static function download($python,$username,$moodleid) {
		// Pre-flight checks
		if(($f = tempnam(sys_get_temp_dir(), 'mat-')) === false) {
			throw new Exception("Failed to create temporary file");
		}
	
		$mat_f = $f . ".mat";
	
		// Perform substitution of variables
	
		// Run xelatex (Used because of native unicode and TTF font support)
		ob_start();
		$cmd = sprintf("python ".$python." ".$f);
		chdir(sys_get_temp_dir());
		exec($cmd, $foo, $ret);
	
		// Test here
		if(!file_exists($mat_f)) {
			@unlink($f);
			throw new Exception("Output was not generated and latex returned: $ret.");
		}
	
		// Send through output
		$fp = fopen($mat_f, 'rb');
		header('Content-Type: application/x-mat');
		header('Content-Disposition: attachment; filename="' . $username . '_data.mat"' );
		header('Content-Length: ' . filesize($mat_f));
		fpassthru($fp);
	
		// Final cleanup
		@unlink($mat_f);
		@unlink($f);
	}
	
	/**
	 * Series of substitutions to sanitise text for use in LaTeX.
	 *
	 * http://stackoverflow.com/questions/2627135/how-do-i-sanitize-latex-input
	 * Target document should \usepackage{textcomp}
	 */
	public static function escape($text) {
		// Prepare backslash/newline handling
		$text = str_replace("\n", "\\\\", $text); // Rescue newlines
		$text = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $text); // Strip all non-printables
		$text = str_replace("\\\\", "\n", $text); // Re-insert newlines and clear \\
		$text = str_replace("\\", "\\\\", $text); // Use double-backslash to signal a backslash in the input (escaped in the final step).
	
		// Symbols which are used in LaTeX syntax
		$text = str_replace("{", "\\{", $text);
		$text = str_replace("}", "\\}", $text);
		$text = str_replace("$", "\\$", $text);
		$text = str_replace("&", "\\&", $text);
		$text = str_replace("#", "\\#", $text);
		$text = str_replace("^", "\\textasciicircum{}", $text);
		$text = str_replace("_", "\\_", $text);
		$text = str_replace("~", "\\textasciitilde{}", $text);
		$text = str_replace("%", "\\%", $text);
	
		// Brackets & pipes
		$text = str_replace("<", "\\textless{}", $text);
		$text = str_replace(">", "\\textgreater{}", $text);
		$text = str_replace("|", "\\textbar{}", $text);
	
		// Quotes
		$text = str_replace("\"", "\\textquotedbl{}", $text);
		$text = str_replace("'", "\\textquotesingle{}", $text);
		$text = str_replace("`", "\\textasciigrave{}", $text);
	
		// Clean up backslashes from before
		$text = str_replace("\\\\", "\\textbackslash{}", $text); // Substitute backslashes from first step.
		$text = str_replace("\n", "\\\\", trim($text)); // Replace newlines (trim is in case of leading \\)
		return $text;
	}
}
?>
