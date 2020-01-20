<?php
if (is_file("/boot/config/vfio-pci.cfg.bak")) {
	exec("cp /boot/config/vfio-pci.cfg.bak /boot/config/vfio-pci.cfg");
} else {
	exec("rm /boot/config/vfio-pci.cfg");
}
if ($_GET["sed"] == "true") {
	if (is_file("/tmp/reboot_notifications")) {
		exec("sed -i '/VFIO-PCI Config/d' /tmp/reboot_notifications");
	}
}
?>
