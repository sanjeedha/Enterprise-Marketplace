# service-account.py

import json
from oauth2client.client import SignedJwtAssertionCredentials

# The scope for the OAuth2 request.
SCOPE = 'https://www.googleapis.com/auth/analytics.readonly'

# The location of the key file with the key data.
KEY_FILEPATH = '/Users/haroon/Downloads/login-fdf588762877.json'

# Load the key file's private data.
with open(KEY_FILEPATH) as key_file:
  _key_data = json.load(key_file)

# Construct a credentials objects from the key data and OAuth2 scope.
_credentials = SignedJwtAssertionCredentials(
    _key_data['client_email'], _key_data['private_key'], SCOPE)

# Defines a method to get an access token from the credentials object.
# The access token is automatically refreshed if it has expired.
def get_access_token():
  return _credentials.get_access_token().access_token

print "haroon"
at = get_access_token()
print at

with open('/home2/sanjeedh/public_html/sanjeedhasanofer/marketplace/access_token.txt', 'w') as f:
	f.write(at)

