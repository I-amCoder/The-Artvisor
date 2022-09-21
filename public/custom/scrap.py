from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from bs4 import BeautifulSoup
import json

options = Options()
# options.headless = True


# Instantiate a webdriver
driver = webdriver.Chrome(options=options)

# Load the HTML page
html = driver.get("https://art.co")

# Parse processed webpage with BeautifulSoup
soup = BeautifulSoup(driver.page_source)
driver.quit()
json = soup.find('script',{'id':'__NEXT_DATA__','type':'application/json'}).text



print(json)
