#!/bin/sh
md5() {
	echo -n $1 | md5sum -t | cut -c-32
}

gmtnow() {
	offset=$1
	if test "x$1" != "x" && test "$1" -le 0; then
		offset=$1
	else
		offset=0
	fi
	date -u --date="-$offset sec" +'%a, %d %b %Y %T GMT'
}
clen=0
date=`gmtnow 60`
sign=`md5 "GET&/jeff-pic-space1/&${date}&${clen}&$(md5 'xxxxxxxx')"`
echo $date

verb=$1

curl $verb -L --connect-timeout 30 \
	-H 'Expect' \
	-H "Authorization: UpYun oper1:${sign}" \
	-H "Date: $date" \
	'http://v1.api.upyun.com/jeff-pic-space1/'
