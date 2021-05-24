import cv2 as cv
import numpy as np

img = cv.imread('img/parking_vide.jpg')
gray = cv.cvtColor(img, cv.COLOR_BGR2GRAY)
blur_gray = cv.GaussianBlur(gray, (5, 5), 0)
blur_gray = np.float32(blur_gray)
dst = cv.cornerHarris(blur_gray, 2, 3, 0.04)
dst = cv.dilate(dst, None)
dst = cv.dilate(dst, None)
img[dst > 0.15 * dst.max()] = [255, 0, 255]

cv.imshow('img', img)
cv.imshow('dst', dst)
cv.waitKey(0)
cv.destroyAllWindows()
