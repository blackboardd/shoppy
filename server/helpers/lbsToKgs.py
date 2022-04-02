# convert pounds to kilograms
def lbsToKgs(pounds):
    # keep last two digits of return
    return round(float(pounds) * 0.453592, 2)

import sys
print(lbsToKgs(sys.argv[1]))
