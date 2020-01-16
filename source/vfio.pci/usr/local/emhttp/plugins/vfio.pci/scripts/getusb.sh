#bin/bash
pciaddress=$1
for usb_ctrl in $(find /sys/bus/usb/devices/usb* -maxdepth 0 -type l); do
	path="$(realpath "${usb_ctrl}")"
	if [[ $path == *$pciaddress* ]]; then
		bus="$(cat "${usb_ctrl}/busnum")"
		lsusb -s $bus:
	fi
done