#bin/bash
declare -a iommu
for d in /sys/kernel/iommu_groups/* ; do
	var1=${d##*/}
	if [ ${#var1} -eq 1 ]
	then
		var1="0$var1"
	fi
	iommu+=( "$var1" )
done
iommu=( $( printf "%s\n" "${iommu[@]}" | sort -n ) )
for d in "${iommu[@]}" ; do
	for e in /sys/kernel/iommu_groups/${d#0}/devices/* ; do
		basename=$( basename "$e" | sed 's/:/\:/g' )
		group=${d}
		if [[ -e /sys/kernel/iommu_groups/${group#0}/devices/${basename}/reset ]]
		then
			reset=1
		else
			reset=0
		fi
		pcie=${e:(-7)}
		f=$(lspci -s $pcie)
		desc=${f:(+8)}
		echo $group $reset $pcie $desc
	done
done
