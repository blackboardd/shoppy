# generate SKUs based on a product name and type, and hashed with a uuid
import uuid
import hashlib

def generateSku(name, type):
    sku = name + type + str(uuid.uuid4())
    hashedValue = hashlib.sha256(sku.encode('utf-8')).hexdigest()
    # return the last 16 characters of the hashed value all uppercased
    return hashedValue[-16:].upper()

import sys
print(generateSku(sys.argv[1], sys.argv[2]))
