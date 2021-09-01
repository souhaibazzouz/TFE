import cv2
import numpy as np

img = cv2.imread("img/parking_vide.jpg")
'''
cv2.circle(img, (185, 7), 5, (255, 0, 0), -1)
cv2.circle(img, (454, 7), 5, (255, 0, 0), -1)
cv2.circle(img, (-10, 390), 5, (255, 0, 0), -1)
cv2.circle(img, (645, 390), 5, (255, 0, 0), -1)
'''
perspective_ancien = np.float32([[185, 7], [454, 7], [-10, 390], [645, 390]])
perspective_nouveau = np.float32([[0, 0], [500, 0], [0, 700], [500, 700]])
matrix = cv2.getPerspectiveTransform(perspective_ancien, perspective_nouveau)

result = cv2.warpPerspective(img, matrix, (500, 700))

cv2.imshow("Img", img)
cv2.imshow("Perspective transformation", result)
cv2.imwrite("img/parking_vide_modif.jpg", result)

cv2.waitKey(0)
cv2.destroyAllWindows()
