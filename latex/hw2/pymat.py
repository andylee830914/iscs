import sys, os
from numpy import *
import scipy.io as sio

test1=random.rand(3,4)
array=random.rand(3,4)
filename=sys.argv[1]
stdid=sys.argv[2]
sio.savemat(filename+'.mat', {'name':stdid,'test2':test1})