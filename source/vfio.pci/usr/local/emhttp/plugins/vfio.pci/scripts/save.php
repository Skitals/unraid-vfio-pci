<?php
$cfg = $_GET["cfg"];
if ($cfg) {
	exec("echo \"$cfg\" >/boot/config/vfio-pci.cfg", $output, $myreturn );
	if ($myreturn !== "0") {
		echo "vfio-pci.cfg created succesfully.\n\n";
		echo "You must reboot for changes to take effect!";
	} else {
		echo "FAILED\n";
		echo "Return: $myreturn\n";
		print_r($output);
	}
} else {
	echo "No devices selected.\n\n";
	echo "Removing vfio-pci.cfg\n\n";
	exec("rm /boot/config/vfio-pci.cfg", $output, $myreturn );
	if ($myreturn !== "0") {
		echo "vfio-pci.cfg removed succesfully.\n\n";
		echo "You must reboot for changes to take effect!";
	} else {
		echo "FAILED\n";
		echo "Return: $myreturn\n";
		print_r($output);
	}
}
?>
