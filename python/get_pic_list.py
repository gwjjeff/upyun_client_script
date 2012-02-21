import sys
import pycurl
import hashlib
from time import strftime, gmtime, time
from StringIO import StringIO

def md5(s):
	m = hashlib.md5()
	m.update(s)
	return m.hexdigest()

def gmtnow(offset=0):
	return strftime("%a, %d %b %Y %H:%M:%S GMT", gmtime(time() + offset))

b = StringIO()

clen = 0
date = gmtnow(60)
sign = md5('GET&/jeff-pic-space1/&%s&%s&%s' % (date, clen, md5("xxxxxxxx")))
print(date)

verb=0
try:
	if sys.argv[1] == '-v':
		verb=1
except:
	pass

c = pycurl.Curl()
c.setopt(pycurl.URL, 'http://v1.api.upyun.com/jeff-pic-space1/')
c.setopt(pycurl.HTTPHEADER, ['Expect:', 'Authorization: UpYun oper1:%s' % (sign,), 'Date: %s' % (date,)])
c.setopt(pycurl.HEADER, 0)
c.setopt(pycurl.TIMEOUT, 30)
c.setopt(pycurl.VERBOSE, verb)
c.setopt(pycurl.FOLLOWLOCATION, 1)
c.setopt(pycurl.WRITEFUNCTION, b.write)
c.perform()

print(b.getvalue())
