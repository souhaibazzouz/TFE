import sys
import cv2
import numpy as np

img = cv2.imread('img/parking.jpg')
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
blur_gray = cv2.GaussianBlur(gray, (5, 5), 0)
blur_gray2 = np.float32(blur_gray)
edges = cv2.Canny(blur_gray, 50, 150, 3)

dst = cv2.cornerHarris(blur_gray2, 2, 3, 0.04)
# dst = cv2.bitwise_not(dst)

# Slot Parking 1
arr1 = [[38, 23], [38, 200], [120, 200], [120, 23]]

# Slot Parking 2
arr2 = [[38, 225], [38, 395], [120, 395], [120, 225]]

# SLot Parking 3
arr3 = [[120, 23], [120, 200], [202, 200], [202, 23]]

# Slot Parking 4
arr4 = [[120, 225], [120, 395], [202, 395], [202, 225]]

# Slot Parking 5
arr5 = [[202, 23], [202, 200], [284, 200], [284, 23]]

# Slot Parking 6
arr6 = [[202, 225], [202, 395], [284, 395], [284, 225]]

# Slot Parking 7
arr7 = [[284, 23], [284, 200], [366, 200], [366, 23]]

# Slot Parking 8
arr8 = [[284, 225], [284, 395], [366, 395], [366, 225]]

# Slot Parking 9
arr9 = [[366, 23], [366, 200], [448, 200], [448, 23]]

# Slot Parking 10
arr10 = [[366, 225], [366, 395], [448, 395], [448, 225]]

# Slot Parking 11
arr11 = [[448, 23], [448, 200], [530, 200], [530, 23]]

# Slot Parking 12
arr12 = [[448, 225], [448, 395], [530, 395], [530, 225]]

# Slot Parking 13
arr13 = [[530, 23], [530, 200], [612, 200], [612, 23]]

# Slot Parking 14
arr14 = [[530, 225], [530, 395], [612, 395], [612, 225]]
rows, cols = dst.shape
pb = 0
pn = 0
for i in range(rows):
    for k in range(cols):
        aa = img[i, k]
        if aa[0] > 200:
            pb = pb + 1
            print("Ce pixel est blanc")
        else:
            pn = pn + 1
            print("Ce pixel est noir")

if pb > pn:
    print(pb, pn)
    print('Cette image est majoritairment blanche')
elif pn > pb:
    print(pb, pn)
    print('Cette image est majoritairment noir')
else:
    print(pb, pn)
    print('Cette image est aussi blanche que noir')

g = globals()
for i in np.arange(0, 16):
    x = 'arr{}'.format(i)
    print(x)
    if x in globals():
        print(g[x])
        print(f"Rectangle numéro {i}")
        for s in g[x]:
            cv2.circle(img, (s[0], s[1]), 5, (0, 0, 255), -1)

        a = (g[x][0][0] + g[x][2][0]) / 2
        b = (g[x][0][1] + g[x][2][1]) / 2

        cv2.circle(img, (int(a), int(b)), 5, (255, 0, 0), -1)

    else:
        print("Le rectangle n'existe pas")

cv2.imshow("Entre", img)
cv2.imshow("Canny", edges)
cv2.imshow("Corner", dst)
cv2.waitKey(0)
cv2.destroyAllWindows()
sys.exit()
