import cv2
import numpy as np

img = cv2.imread('img/parking_vide.jpg')  # Recuperer l'image
gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)  # Filtrer en gris pour faciliter le travail
# flouter légèrement l'image pour lisser l'image et avoir moins d'imperfection
blur_gray = cv2.GaussianBlur(gray, (5, 5), 0)
# Detecter les bords et contours de l'image
edges = cv2.Canny(blur_gray, 50, 150, 3)

# Recuperer les lignes de l'image
line_image = np.copy(img) * 0  # dessiner les lignes sur un cadran blanc de meme tailles que l'image
lines = cv2.HoughLinesP(edges, 1, np.pi / 180, 15, np.array([]), 50, 20)

for line in lines:
    for x1, y1, x2, y2 in line:
        cv2.line(line_image, (x1, y1), (x2, y2), (0, 0, 255), 5)

# Dessiner les lignes sur la photo orignale
img = cv2.addWeighted(img, 0.8, line_image, 1, 0)

cv2.imshow("Fenetre", img)
cv2.waitKey(0)
cv2.destroyAllWindows()
