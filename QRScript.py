import qrcode


id = int(input("Enter the ID for the Dee to generate its QR code: "))
img = qrcode.make('https://cms-tfpx-deetabase-44c33b50f049.herokuapp.com/qrcode_read.php?id={}'.format(id))
# type(img)  # qrcode.image.pil.PilImage
img.show()
# img.save("some_file.png")