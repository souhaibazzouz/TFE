import sys
import cv2
import numpy as np
import time
import mysql.connector

drone_image = input("Image à travailler ?")
img = cv2.imread(f'correct_image/parking_{drone_image}.jpg')
test_image = np.copy(img)
cv2.imshow("Original", img)


def increase_contrast(img):
    lab = cv2.cvtColor(img, cv2.COLOR_BGR2LAB)
    l, a, b = cv2.split(lab)
    clahe = cv2.createCLAHE(clipLimit=3.0, tileGridSize=(8, 8))
    cl = clahe.apply(l)
    limg = cv2.merge((cl, a, b))
    final = cv2.cvtColor(limg, cv2.COLOR_LAB2BGR)
    return final


contrast = increase_contrast(test_image)


def increase_brightness(img, value=30):
    hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
    h, s, v = cv2.split(hsv)

    lim = 255 - value
    v[v > lim] = 255
    v[v <= lim] += value

    final_hsv = cv2.merge((h, s, v))
    img = cv2.cvtColor(final_hsv, cv2.COLOR_HSV2BGR)
    return img


brightness = increase_brightness(contrast)


def select_rgb_white_yellow(image):
    # white color mask
    lower = np.uint8([120, 120, 120])
    upper = np.uint8([255, 255, 255])
    white_mask = cv2.inRange(image, lower, upper)
    # yellow color mask
    lower = np.uint8([190, 190, 0])
    upper = np.uint8([255, 255, 255])
    yellow_mask = cv2.inRange(image, lower, upper)
    # combine the mask
    mask = cv2.bitwise_or(white_mask, yellow_mask)
    masked = cv2.bitwise_and(image, image, mask=mask)
    return masked


white_yellow_image = select_rgb_white_yellow(test_image)
white_yellow_image2 = select_rgb_white_yellow(brightness)


# convert_gray_scale
def convert_gray_scale(image):
    return cv2.cvtColor(image, cv2.COLOR_RGB2GRAY)


gray_images = convert_gray_scale(white_yellow_image)
gray_images2 = convert_gray_scale(white_yellow_image2)


# detect_edges
def detect_edges(image, low_threshold=50, high_threshold=200):
    return cv2.Canny(image, low_threshold, high_threshold)


edge_images = detect_edges(white_yellow_image)
edge_images2 = detect_edges(white_yellow_image2)


# Choose the all parking
# filter
def filter_region(image, vertices):
    mask = np.zeros_like(image)
    if len(mask.shape) == 2:
        cv2.fillPoly(mask, vertices, 255)
    else:
        cv2.fillPoly(mask, vertices, (255,) * mask.shape[2])  # in case, the input image has a channel dimension
    return cv2.bitwise_and(image, mask)


def select_region(image):
    # first, define the polygon by vertices
    rows, cols = image.shape[:2]
    pt_1 = [cols * 0.05, rows * 0.95]
    pt_2 = [cols * 0.05, rows * 0.05]
    pt_3 = [cols * 0.98, rows * 0.05]
    pt_4 = [cols * 0.98, rows * 0.95]
    # the vertices are an array of polygons (i.e array of arrays) and the data type must be integer
    vertices = np.array([[pt_1, pt_2, pt_3, pt_4]], dtype=np.int32)
    return filter_region(image, vertices)


roi_image = select_region(edge_images)
roi_image2 = select_region(edge_images2)


def hough_lines(image):
    return cv2.HoughLinesP(image, rho=0.1, theta=np.pi / 10, threshold=15, minLineLength=9, maxLineGap=4)


line_image = np.copy(img) * 0  # dessiner les lignes sur un cadran blanc de meme tailles que l'image
list_of_lines = hough_lines(roi_image2)
for line in list_of_lines:
    for x1, y1, x2, y2 in line:
        cv2.line(line_image, (x1, y1), (x2, y2), (255, 255, 255), 5)

list_of_lines = hough_lines(roi_image)
for line in list_of_lines:
    for x1, y1, x2, y2 in line:
        cv2.line(line_image, (x1, y1), (x2, y2), (0, 255, 0), 5)

# Dessiner les lignes sur la photo orignale
hough = cv2.addWeighted(img, 0.8, line_image, 1, 0)

arr1 = [[38, 23], [38, 200], [120, 200], [120, 23]]
arr2 = [[38, 225], [38, 395], [120, 395], [120, 225]]
arr3 = [[120, 23], [120, 200], [202, 200], [202, 23]]
arr4 = [[120, 225], [120, 395], [202, 395], [202, 225]]
arr5 = [[202, 23], [202, 200], [284, 200], [284, 23]]
arr6 = [[202, 225], [202, 395], [284, 395], [284, 225]]
arr7 = [[284, 23], [284, 200], [366, 200], [366, 23]]
arr8 = [[284, 225], [284, 395], [366, 395], [366, 225]]
arr9 = [[366, 23], [366, 200], [448, 200], [448, 23]]
arr10 = [[366, 225], [366, 395], [448, 395], [448, 225]]
arr11 = [[448, 23], [448, 200], [530, 200], [530, 23]]
arr12 = [[448, 225], [448, 395], [530, 395], [530, 225]]
arr13 = [[530, 23], [530, 200], [612, 200], [612, 23]]
arr14 = [[530, 225], [530, 395], [612, 395], [612, 225]]

test_hough = hough.copy

g = globals()
nombre_place_libre = 0
nombre_place_totale = 0
for i in np.arange(0, 15):
    x = 'arr{}'.format(i)
    print(x)
    if x in globals():
        print(g[x])
        print(f"Rectangle numéro {i}")
        for s in g[x]:
            cv2.circle(hough, (s[0], s[1]), 3, (255, 0, 255), -1)

        a = (g[x][0][0] + g[x][2][0]) / 2
        b = (g[x][0][1] + g[x][2][1]) / 2

        color_middle = hough[int(b), int(a)]  # row major, like in opencv
        moyenne = [0, 0, 0]
        diviseur = 0
        for i in range(g[x][0][0], g[x][2][0]):
            for j in range(g[x][0][1], g[x][2][1]):
                color = hough[int(j), int(i)]
                moyenne[0] = moyenne[0] + color[0]
                moyenne[1] = moyenne[1] + color[1]
                moyenne[2] = moyenne[2] + color[2]
                diviseur = diviseur + 1
        print(color_middle[0])
        moyenne[0] = moyenne[0] / diviseur
        moyenne[1] = moyenne[1] / diviseur
        moyenne[2] = moyenne[2] / diviseur
        print(moyenne)

        if moyenne[0] > 180 and moyenne[1] > 180 and moyenne[2] > 180:
            cv2.circle(img, (int(a), int(b)), 5, (0, 255, 0), -1)
            nombre_place_libre = nombre_place_libre + 1
            nombre_place_totale = nombre_place_totale + 1
        else:
            cv2.circle(img, (int(a), int(b)), 5, (0, 0, 255), -1)
            nombre_place_totale = nombre_place_totale + 1

    else:
        print("Le rectangle n'existe pas")

time = time.strftime('%Y-%m-%d %H:%M:%S')
nom_parking = "EPHEC"
adresse_parking = "LLN"

try:
    mydb = mysql.connector.connect(
        host="*******",
        user="*******",
        password="*******",
        database="*******"
    )

    sql_table = "CREATE TABLE IF NOT EXISTS `*******`.`parking` (`id` INT NOT NULL AUTO_INCREMENT," \
                "`name` VARCHAR(45) NULL DEFAULT 'sans nom'," \
                "`adress` VARCHAR(45) NOT NULL," \
                "`tot_slot` INT NOT NULL," \
                "`empty_slot` INT NULL DEFAULT NULL," \
                "`date` DATETIME NULL DEFAULT NULL," \
                "PRIMARY KEY (`id`));"

    sql = f"INSERT INTO parking (name, adress, tot_slot, empty_slot, date) " \
          f"VALUES ('{nom_parking}','{adresse_parking}','{nombre_place_totale}','{nombre_place_libre}', '{time}')"

    cursor = mydb.cursor()
    cursor.execute(sql_table)
    cursor.execute(sql)
    mydb.commit()
    print(cursor.rowcount, "La ligne a correctectement été ajouté")
    cursor.close()

except mysql.connector.Error as error:
    print("Erreur lors de l'insertion de la ligne; ".format(error))

mydb.commit()

if nombre_place_libre == 1:
    print(f"{time}:Il y a une place libre seulement!")
elif nombre_place_libre == 0:
    print(f"{time}:Il n'y a pas de place libre sur le parking")
else:
    print(f"{time}:Il y a {nombre_place_libre} places libres sur {nombre_place_totale}")

cv2.imshow("Image Contrasté", contrast)
cv2.imshow("Image plus lumineuse", brightness)
cv2.imshow("Filtre Jaune-Blanc", white_yellow_image)
cv2.imshow("Filtre Jaune-Blanc bis", white_yellow_image2)
cv2.imshow("Niveau de Gris", gray_images)
cv2.imshow("Niveau de Gris bis", gray_images2)
cv2.imshow("Détection de bords", edge_images)
cv2.imshow("Détection de bords bis", edge_images2)
cv2.imshow("Roi", roi_image)
cv2.imshow("Roi bis", roi_image2)
cv2.imshow("Ligne", hough)
cv2.imshow("Final", img)
cv2.waitKey(0)
cv2.destroyAllWindows()
sys.exit()
