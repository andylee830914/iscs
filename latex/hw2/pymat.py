import sys, os
import numpy as np
import scipy.io as sio


filename=sys.argv[1]
stdid=sys.argv[2]

version='v'+str(int(stdid[5:9]) % 2)
q2a={
    'v0':np.matrix([[1.0,2,0],[0,3,0],[2,-4,2]]),
    'v1':np.matrix([[3.0,1,1],[2,4,2],[-1,-1,1]])
    }
q2q={
    'v0':np.matrix([[0,-1.0,-1],[0,0,-1],[1,2,2]]),
    'v1':np.matrix([[-1.0,0,-1],[-2,-1,0],[1,1,1]])    
    }

sio.savemat(filename+'.mat', {'name':stdid,'A':q2a[version],'Q':q2q[version]})