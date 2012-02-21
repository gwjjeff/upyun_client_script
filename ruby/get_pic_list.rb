require 'curb'
require 'digest'

def md5(str)
	Digest::MD5.hexdigest(str)
end

def gmtnow(offset)
	# auth time frame testing
	now = Time.now + offset
	now.gmtime().strftime("%a, %d %b %Y %T GMT")
end

clen = 0
date = gmtnow(60)
sign = md5("GET&/jeff-pic-space1/&#{date}&#{clen}&#{md5('xxxxxxxx')}")
puts date

verb = ARGV[0] == '-v'

c = Curl::Easy.perform('http://v1.api.upyun.com/jeff-pic-space1/') do |curl|
	curl.headers['Expect'] = ''
	curl.headers['Authorization'] = "UpYun oper1:#{sign}"
	curl.headers['Date'] = date
	curl.timeout = 30
	curl.follow_location = true
	curl.verbose = verb
end
puts c.body_str
c.close
