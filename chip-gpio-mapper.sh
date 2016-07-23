#!/bin/sh

# Chip GPIO Mapper

# Basic script to map CHIP GPIO ports to their labelled names
# Based on firmware version 4.4

# (c) 2016 David Swinton
# Licensed under GNU GPL v3

#Export pins 0 -7
echo 1016 > /sys/class/gpio/export
echo 1017 > /sys/class/gpio/export
echo 1018 > /sys/class/gpio/export
echo 1019 > /sys/class/gpio/export
echo 1020 > /sys/class/gpio/export
echo 1021 > /sys/class/gpio/export
echo 1022 > /sys/class/gpio/export
echo 1023 > /sys/class/gpio/export

#Make GPIO dir
mkdir /gpio/

#Make symlinks for GPIOs
ln -s /sys/class/gpio/gpio1016 /gpio/xio-p0
ln -s /sys/class/gpio/gpio1017 /gpio/xio-p1
ln -s /sys/class/gpio/gpio1018 /gpio/xio-p2
ln -s /sys/class/gpio/gpio1019 /gpio/xio-p3
ln -s /sys/class/gpio/gpio1020 /gpio/xio-p4
ln -s /sys/class/gpio/gpio1021 /gpio/xio-p5
ln -s /sys/class/gpio/gpio1022 /gpio/xio-p6
ln -s /sys/class/gpio/gpio1023 /gpio/xio-p7

#Set all directions to out
echo out > /gpio/xio-p0/direction
echo out > /gpio/xio-p1/direction
echo out > /gpio/xio-p2/direction
echo out > /gpio/xio-p3/direction
echo out > /gpio/xio-p4/direction
echo out > /gpio/xio-p5/direction
echo out > /gpio/xio-p6/direction
echo out > /gpio/xio-p7/direction

