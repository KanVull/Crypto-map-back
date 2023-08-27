import requests
import json
# import CryptoChanger

with open('API_key_google.txt', 'r') as file:
    API = file.read()

def get_json_organizations_response(request_query):
    try:
        response = requests.get(f'https://maps.googleapis.com/maps/api/place/textsearch/json?query={request_query},Batumi&key={API}', auth=('user', 'pass'))
        return response.json()
    except Exception:
        print('bruh')

def get_organizations():    
    requests_list = [
        'crypto%20changer',
        'crypto',
        'крипто',
        'крипто%20обменник'
    ]

    for req in requests_list:
        json_by_query = get_json_organizations_response(req)
 
        # Writing to sample.json
        with open(f'./JSON/g_saample_{req}.json', 'w', encoding='utf-8') as f:
            json.dump(json_by_query, f, ensure_ascii=False, indent=4)
            
           

def main():
    get_organizations()
            

if __name__ == "__main__":
    main()
