import qrcode
import sys

id = int(sys.argv[1])
# id = int(input("Enter the ID for the Dee to generate its QR code: "))
img = qrcode.make('https:website-link-'.format(id))
# type(img)  # qrcode.image.pil.PilImage
img.show()
# img.save("some_file.png")
