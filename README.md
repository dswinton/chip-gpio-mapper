# chip-gpio-mapper
NTC CHIP GPIO Directory Mapping

Maps your CHIP's GPIO ports to match the names printed on the headers, in the format of...
/gpio/xio-pX/
... where X = the GPIO pin number

For example:
echo 1 > /gpio/xio-p0/value
...will output 3v to the GPIO labelled "XIO-P0"

