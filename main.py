import requests
import json

with open('API_key.txt', 'r') as file:
    API = file.read()

def get_json_organizations_response(request_query):
    try:
        response = requests.get(f'https://search-maps.yandex.ru/v1/?text={request_query},Батуми&type=biz&lang=ru_RU&apikey={API}', auth=('user', 'pass'))
        return response.text
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
        json_object = json.dumps(json_by_query, indent=4)
 
        # Writing to sample.json
        with open(f"./JSON/sample_{req}.json", "w") as outfile:
            outfile.write(json_object, ensure_ascii=False)
        

def main():
    get_organizations()
            

if __name__ == "__main__":
    main()
