<?php
$cfg = $_GET["cfg"];
if ($_GET["careboot"] == "no") {
	$nocareboot = "true";
}
if ($nocareboot) {
	exec("echo \"VFIO-PCI Config\" >/tmp/reboot_notifications");
}
if ($cfg) {
	exec("cp /boot/config/vfio-pci.cfg /boot/config/vfio-pci.cfg.bak");
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
	exec("cp /boot/config/vfio-pci.cfg /boot/config/vfio-pci.cfg.bak");
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
